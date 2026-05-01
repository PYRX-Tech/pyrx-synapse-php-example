<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$client = new PyrxSynapse\Client(
    apiKey: getenv('SYNAPSE_API_KEY'),
    workspaceId: getenv('SYNAPSE_WORKSPACE_ID'),
    baseUrl: getenv('SYNAPSE_API_URL') ?: 'https://synapse-api.pyrx.tech'
);

$slug = 'sdk-preview-test-' . time();

// Create a template to preview
$client->templates->create([
    'slug' => $slug,
    'name' => 'Preview Test',
    'subject' => 'Hi {{first_name}}',
    'body_html' => '<p>Hello {{first_name}}</p>',
    'sender_name' => 'Test',
    'from_email' => 'test@example.com',
]);

$preview = $client->templates->preview($slug, [
    'contact' => ['email' => 'jane@example.com', 'first_name' => 'Jane'],
]);
echo "Subject: " . ($preview['subject'] ?? '') . "\n";

// Cleanup
try {
    $client->templates->delete($slug);
} catch (PyrxSynapse\Errors\SynapseError $e) {
    // ignore cleanup errors
}
