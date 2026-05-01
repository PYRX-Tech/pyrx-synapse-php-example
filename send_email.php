<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

try {
    $result = $client->sendEmail(
        templateSlug: 'welcome-email',
        to: ['user_id' => 'user_123', 'email' => 'jane@example.com'],
        attributes: ['first_name' => 'Jane']
    );
    echo "Email sent: " . json_encode($result) . "\n";
} catch (PyrxSynapse\Errors\SynapseError $e) {
    echo "Send failed (expected if template doesn't exist): " . $e->getMessage() . "\n";
}
