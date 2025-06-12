<?php
declare(strict_types=1);

// 1) Composer’s autoloader
require __DIR__ . '/vendor/autoload.php';

// 2) Your config
require __DIR__ . '/config.php';

use WlSdkExample\ExampleConfig;

// 3) DEBUG: show config constants
echo '<pre>';
echo 'Authorize Code: ' . ExampleConfig::AUTHORIZE_CODE . PHP_EOL;
echo 'Authorize ID:   ' . ExampleConfig::AUTHORIZE_ID   . PHP_EOL;
echo '</pre>';

// 🔥 STOP.  If you see your real codes above, config is loaded correctly.
exit;

// ————————————————————————————————————————————————————————————————
// Once you’ve verified, replace everything *after* the `require __DIR__ . '/config.php';`
// with your original SDK logic (the NotepadModel / EnterModel / DataModel calls).