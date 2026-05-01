<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$slug = 'tpl-create-' . time();

$template = $client->templates->create([
    'slug' => $slug,
    'name' => 'Create Test',
    'subject' => 'Order confirmed',
    'body_html' => '<h1>Hi</h1><p>Your order is confirmed.</p>',
    'sender_name' => 'Synapse',
    'from_email' => 'noreply@example.com',
]);
echo "Created: " . json_encode($template) . "\n";

// Cleanup
try {
    $client->templates->delete($slug);
} catch (PyrxSynapse\Errors\SynapseError $e) {
    // ignore cleanup errors
}
