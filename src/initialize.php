<?php
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});


function to_path() {
    return implode(DIRECTORY_SEPARATOR, func_get_args());
}