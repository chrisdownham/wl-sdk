<?php
declare(strict_types=1);

// 1) Load Composer’s autoloader
require __DIR__ . '/vendor/autoload.php';

// 2) Load your config
require __DIR__ . '/config.php';

use WlSdkExample\ExampleConfig;

// 3) VERIFY that config.php is being loaded:
echo '<pre>';
echo 'Authorize Code: ' . ExampleConfig::AUTHORIZE_CODE . PHP_EOL;
echo 'Authorize ID:   ' . ExampleConfig::AUTHORIZE_ID   . PHP_EOL;
echo '</pre>';

// Stop here — once you see your real codes on-screen, config is loading correctly.
exit;