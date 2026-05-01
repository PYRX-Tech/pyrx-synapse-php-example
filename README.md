# Synapse PHP Example

All 15 SDK endpoints with [pyrx/synapse](https://synapse.pyrx.tech/developers/sdks/php).

## Setup

1. `composer install`
2. Copy `.env.example` to `.env`

## Examples

### Core
```bash
php track_event.php        # Track event
php track_batch.php        # Batch track
php identify_contact.php   # Identify contact
php identify_batch.php     # Batch identify
php send_email.php         # Send email
```

### Contacts
```bash
php contacts_list.php      php contacts_get.php
php contacts_update.php    php contacts_delete.php
```

### Templates
```bash
php templates_list.php     php templates_get.php
php templates_create.php   php templates_update.php
php templates_delete.php   php templates_preview.php
```

- [Synapse Docs](https://synapse.pyrx.tech/developers)
- [PHP SDK](https://synapse.pyrx.tech/developers/sdks/php)
