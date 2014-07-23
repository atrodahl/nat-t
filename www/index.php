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
    file_put_contents(to_path($service_dir, 'ssh'), json_encode($service));
}

function register_service() {
    $service = array(
        'ip' => $_SERVER['REMOTE_ADDR'],
        'port' => $_SERVER['REMOTE_PORT']
    );

    save_service($service);
    return json_encode($service);
}

function get_service() {
    $service_file = to_path(__DIR__, '..', 'services', 'ssh');
    if (file_exists($service_file)) {
        return file_get_contents($service_file);
    }
    return array();
}

if (isset($_GET['register'])) {
    die(register_service());
}
else if (isset($_GET['request'])) {
    die(get_service());
}
