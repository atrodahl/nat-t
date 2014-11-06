<?php
require implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'src', 'initialize.php'));

function ensure_service_dir_exists($service_dir) {
    if (!file_exists($service_dir)) {
        mkdir($service_dir, 0755, true);
    }
}

function save_service(array $service) {
    $service_dir = to_path(__DIR__, '..', 'services');
    ensure_service_dir_exists($service_dir);
    file_put_contents(to_path($service_dir, $service['name']), json_encode($service));
}

function register_service($service_name) {
    $service = array(
        'ip' => get_param($_SERVER, 'REMOTE_ADDR'),
        'port' => get_param($_SERVER, 'REMOTE_PORT'),
        'name' => $service_name
    );

    save_service($service);
    return json_encode($service);
}

function get_service($service_name) {
    $service_file = to_path(__DIR__, '..', 'services', $service_name);
    return file_exists($service_file) ? file_get_contents($service_file) : '';
}

function get_param($bag, $name) {
    return isset($bag[$name]) ? $bag[$name] : null;
}

function bad_request() {
    header("HTTP/1.0 400 Bad Request");
}
function not_found() {
    header("HTTP/1.0 404 Not Found");
}

if ($service_name = get_param($_GET, 'register')) {
    register_service($service_name);
}
else if ($service_name = get_param($_GET, 'request')) {
    if (!get_service($service_name)) {
        not_found();
    }
}
else {
    bad_request();
}
