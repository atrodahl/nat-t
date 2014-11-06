#!/usr/local/xait/php/bin/php
<?php
require implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'src', 'initialize.php'));

$echoer_host = '10.10.10.46';
$echoer_port = 1100;

$server = json_decode(file_get_contents("http://$echoer_host:$echoer_port/?request=ssh"));

$cmd = sprintf('%s %s %s < /dev/null',
    'ncat',
    $server->ip,
    $server->port
);

echo "Running [$cmd]..." . PHP_EOL;
passthru($cmd, $exit_code);