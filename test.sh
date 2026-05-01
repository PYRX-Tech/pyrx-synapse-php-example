#!/usr/bin/env bash
set -uo pipefail
RED='\033[0;31m'; GREEN='\033[0;32m'; NC='\033[0m'
PASS=0; FAIL=0

[[ -z "${SYNAPSE_API_KEY:-}" ]] && echo "Set SYNAPSE_API_KEY" && exit 1

cd "$(dirname "$0")"

echo "Installing..."
composer install --quiet > /dev/null 2>&1

run_script() {
  local name="$1" cmd="$2"
  if eval "$cmd" > /dev/null 2>&1; then
    echo -e "  ${GREEN}✓${NC} $name"
    ((PASS++)) || true
  else
    echo -e "  ${RED}✗${NC} $name"
    ((FAIL++)) || true
  fi
}

echo "Running all scripts..."

echo "── Core ──"
run_script "track_event" "php track_event.php"
run_script "track_batch" "php track_batch.php"
run_script "identify_contact" "php identify_contact.php"
run_script "identify_batch" "php identify_batch.php"
run_script "send_email" "php send_email.php"

echo "── Contacts ──"
run_script "contacts_list" "php contacts_list.php"
run_script "contacts_get" "php contacts_get.php"
run_script "contacts_update" "php contacts_update.php"
run_script "contacts_delete" "php contacts_delete.php"

echo "── Templates ──"
run_script "templates_list" "php templates_list.php"
run_script "templates_get" "php templates_get.php"
run_script "templates_create" "php templates_create.php"
run_script "templates_update" "php templates_update.php"
run_script "templates_preview" "php templates_preview.php"
run_script "templates_delete" "php templates_delete.php"

echo ""
echo "Results: $PASS passed, $FAIL failed"
[[ $FAIL -eq 0 ]] && echo -e "${GREEN}All passed!${NC}" || echo -e "${RED}$FAIL failed${NC}"
exit $FAIL
