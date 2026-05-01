<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$result = $client->track(
    externalId: 'user_123',
    eventName: 'user_signed_up',
    attributes: ['plan' => 'starter', 'source' => 'landing_page']
);
echo "Event tracked: " . json_encode($result) . "\n";
