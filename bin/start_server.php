#!/usr/local/xait/php/bin/php
<?php
require implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'src', 'initialize.php'));

$echoer_host = '10.10.10.46';
$echoer_port = 1100;

$request = json_decode(file_get_contents("http://$echoer_host:$echoer_port/?register"));

$ip = gethostbyname(gethostname());
$port = $request->port;

$message = "Hi, from the server";

$cmd = sprintf('echo %s | %s -4 -l -p %s',
    $message,
    'ncat',
    $port
);

echo "Running [$cmd]..." . PHP_EOL;
passthru($cmd, $exit_code);
