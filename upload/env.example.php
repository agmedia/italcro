<?php
// Copy to upload/env.php (ignored by Git) and fill locally/deployment-side.
// Never commit real credentials.

define('QIQO_USERNAME', '');
define('QIQO_PASSWORD', '');
define('QIQO_SOAP_URL', '');
// Keep at 0 for HTTPS. Set to integer 1 only when the HTTP endpoint is
// protected by an explicitly approved private VPN/tunnel and IP allowlist.
define('QIQO_ALLOW_INSECURE_HTTP', 0);

// NarudzbaSend uses separate credentials and is disabled in the database by default.
define('QIQO_ORDER_USERNAME', '');
define('QIQO_ORDER_PASSWORD', '');
// Optional override; otherwise the qiqo_order_endpoint OpenCart setting is used.
define('QIQO_ORDER_ENDPOINT', '');
