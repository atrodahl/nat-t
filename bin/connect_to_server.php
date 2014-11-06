#!/usr/bin/env php
<?php
require implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'src', 'initialize.php'));

$service_directory_host = gethostbyname(gethostname());
$service_directory_port = 1100;

$server = json_decode(file_get_contents("http://$service_directory_host:$service_directory_port/?request=ncat"));

$cmd = sprintf('%s %s %s < /dev/null',
    'ncat',
    $server->ip,
    $server->port
);

echo "Running [$cmd]..." . PHP_EOL;
passthru($cmd, $exit_code);