<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$slug = 'sdk-del-test-' . time();

// Create then delete
$client->templates->create([
    'slug' => $slug,
    'name' => 'Del Test',
    'subject' => 'Test',
    'body_html' => '<p>Hi</p>',
    'sender_name' => 'Test',
    'from_email' => 'test@example.com',
]);

$client->templates->delete($slug);
echo "Template deleted\n";
