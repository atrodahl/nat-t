#!/usr/local/xait/php/bin/php
<?php

function topath() {
    return implode(DIRECTORY_SEPARATOR, func_get_args());
}

$tty = system('tty');
$cmd = sprintf('%s -t %s -S %s:%s 1>%s 2>%s &',
    PHP_BINARY,
    realpath(topath(__DIR__, '..', 'www')),
    '10.10.10.46',
    '1100',
    $tty,
    $tty
);

echo "Running [$cmd]..." . PHP_EOL;
passthru($cmd, $exit_code);