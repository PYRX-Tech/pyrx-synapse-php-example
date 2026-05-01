<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$result = $client->identify(
    externalId: 'user_123',
    email: 'jane@example.com',
    properties: ['plan' => 'pro', 'signup_source' => 'website']
);
echo "Contact identified: " . json_encode($result) . "\n";
