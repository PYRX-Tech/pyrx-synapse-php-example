<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$slug = 'sdk-get-test-' . time();

// Create a template first to ensure it exists
$client->templates->create([
    'slug' => $slug,
    'name' => 'Get Test',
    'subject' => 'Test',
    'body_html' => '<p>Hi</p>',
    'sender_name' => 'Test',
    'from_email' => 'test@example.com',
]);

$template = $client->templates->get($slug);
echo "Template: " . json_encode($template) . "\n";

// Cleanup
try {
    $client->templates->delete($slug);
} catch (PyrxSynapse\Errors\SynapseError $e) {
    // ignore cleanup errors
}
