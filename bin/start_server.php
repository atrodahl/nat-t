#!/usr/bin/env php
<?php
require implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'src', 'initialize.php'));

$service_directory_host = gethostbyname(gethostname());
$service_directory_port = 1100;

$request = json_decode(file_get_contents("http://$service_directory_host:$service_directory_port/?register=ncat"));

$server_ip = gethostbyname(gethostname());
$server_port = $request->port;

$message = "Hi, from the server";

$cmd = sprintf('echo %s | %s -4 -l -p %s',
    $message,
    'ncat',
    $server_port
);

echo "Running [$cmd]..." . PHP_EOL;
passthru($cmd, $exit_code);
