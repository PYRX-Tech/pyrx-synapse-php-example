<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

// First identify to ensure contact exists
$client->identify(externalId: 'sdk_update_test', email: 'update@example.com');

$updated = $client->contacts->update('sdk_update_test', ['properties' => ['plan' => 'growth']]);
echo "Updated: " . json_encode($updated) . "\n";
