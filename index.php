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
    echo "\033[41mMissing required PHP extensions: " . implode(', ', $missingExtensions) . PHP_EOL . "\033[0m";
    exit(1);
}
echo "All required PHP extensions are loaded." . PHP_EOL;
echo "---------------------------------" . PHP_EOL;
echo "Checking PHP version..." . PHP_EOL;
if (version_compare(PHP_VERSION, '8.0.0', '<')) {
    echo "\033[41mPHP 8.0.0 or higher is required. Current version: " . PHP_VERSION . PHP_EOL . "\033[0m";
    exit(1);
}
echo "PHP version is sufficient: " . PHP_VERSION . PHP_EOL;
echo "---------------------------------" . PHP_EOL;

use DBCompare\Infrastructure\Output\Terminal\OutPutTerminal;

try {
    
    /** Run the DB Compare Task */
    DBCompare\Task\Task::run();

    /** Output the results to terminal */
    (new OutPutTerminal())->print();
    echo PHP_EOL . "\033[42mDB Compare completed. " . PHP_EOL . "\033[0m";
} catch (Exception $e) {
    echo "\033[41mError: " . $e->getMessage() . PHP_EOL . "\033[0m";
    exit(1);
}