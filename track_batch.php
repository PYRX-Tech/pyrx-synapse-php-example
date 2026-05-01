<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$result = $client->trackBatch(events: [
    ['external_id' => 'user_1', 'event_name' => 'page_viewed', 'attributes' => ['page' => '/pricing']],
    ['external_id' => 'user_2', 'event_name' => 'feature_used', 'attributes' => ['feature' => 'export']],
]);
echo "Batch tracked: " . json_encode($result) . "\n";
