#!/usr/local/xait/php/bin/php
<?php
require implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'src', 'initialize.php'));

$tty = system('tty');
$host = '10.10.10.46';
$port = 1100;

$cmd = sprintf('%s -t %s -S %s:%s 1>%s 2>%s &',
    PHP_BINARY,
    realpath(to_path(__DIR__, '..', 'www')),
    $host,
    $port,
    $tty,
    $tty
);

echo "Running [$cmd]..." . PHP_EOL;
passthru($cmd, $exit_code);