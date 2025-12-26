<?php

require __DIR__ . '/vendor/autoload.php';

echo "DB Compare Tool" . PHP_EOL;
echo "================" . PHP_EOL;
echo "Checking PHP extensions..." . PHP_EOL;
$requiredExtensions = ['pdo', 'pdo_mysql', 'openssl'];
$missingExtensions = [];
foreach ($requiredExtensions as $ext) {
    if (!extension_loaded($ext)) {
        $missingExtensions[] = $ext;
    }
}
if (!empty($missingExtensions)) {
    echo "Missing required PHP extensions: " . implode(', ', $missingExtensions) . PHP_EOL;
    exit(1);
}
echo "All required PHP extensions are loaded." . PHP_EOL;
echo "---------------------------------" . PHP_EOL;
echo "Checking PHP version..." . PHP_EOL;
if (version_compare(PHP_VERSION, '8.0.0', '<')) {
    echo "PHP 8.0.0 or higher is required. Current version: " . PHP_VERSION . PHP_EOL;
    exit(1);
}
echo "PHP version is sufficient: " . PHP_VERSION . PHP_EOL;
echo "---------------------------------" . PHP_EOL;


use DBCompare\Infrastructure\Output\Renderer;
use DBCompare\Infrastructure\Output\Terminal\OutPutTerminal;

(new DBCompare\Task\Task())->run();
(new OutPutTerminal())->print();