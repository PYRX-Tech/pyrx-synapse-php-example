<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$result = $client->identifyBatch(contacts: [
    ['external_id' => 'user_1', 'email' => 'alice@example.com', 'properties' => ['plan' => 'starter']],
    ['external_id' => 'user_2', 'email' => 'bob@example.com', 'properties' => ['plan' => 'growth']],
]);
echo "Batch identified: " . json_encode($result) . "\n";
