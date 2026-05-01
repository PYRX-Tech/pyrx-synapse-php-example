<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$contacts = $client->contacts->list(page: 1, perPage: 1);
$data = $contacts['data'] ?? [];

if (!empty($data)) {
    $cid = $data[0]['id'];
    $contact = $client->contacts->get($cid);
    echo "Contact: " . json_encode($contact) . "\n";
} else {
    echo "No contacts found\n";
}
