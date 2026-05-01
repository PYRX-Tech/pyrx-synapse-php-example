<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$slug = 'tpl-update-' . time();

// Create first
$client->templates->create([
    'slug' => $slug,
    'name' => 'Update Test',
    'subject' => 'Original subject',
    'body_html' => '<h1>Hi</h1>',
    'sender_name' => 'Synapse',
    'from_email' => 'noreply@example.com',
]);

$updated = $client->templates->update($slug, [
    'subject' => 'Your order is confirmed!',
    'body_html' => '<h1>Updated!</h1>',
]);
echo "Updated: " . json_encode($updated) . "\n";

// Cleanup
try {
    $client->templates->delete($slug);
} catch (PyrxSynapse\Errors\SynapseError $e) {
    // ignore cleanup errors
}
