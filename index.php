<?php
declare(strict_types=1);

// 1) Load Composer’s autoloader (will register PSR-4 for your own App\ and any packages that declare autoload)
require __DIR__ . '/vendor/autoload.php';

// 2) Load the SDK’s custom autoloader
require __DIR__ . '/vendor/wellnessliving/wl-sdk/wl-autoloader.php';

// 3) Load your config subclass
require __DIR__ . '/config.php';

use WlSdkExample\ExampleConfig;

// 4) VERIFY that your config.php is actually being loaded:
echo '<pre>';
echo 'Authorize Code: ' . ExampleConfig::AUTHORIZE_CODE . PHP_EOL;
echo 'Authorize ID:   ' . ExampleConfig::AUTHORIZE_ID   . PHP_EOL;
echo '</pre>';

// 5) Stop here – once you see your real values printed, you know Stage 1 is done.
exit;