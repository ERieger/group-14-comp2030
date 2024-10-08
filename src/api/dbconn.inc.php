<?php
function loadEnv($filePath) {
    if (file_exists($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            list($key, $value) = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

loadEnv('../../.env');

define("DB_HOST", getenv("DB_HOSTNAME"));
define("DB_NAME", getenv("DB_DATABASE"));
define("DB_USER", getenv("DB_USERNAME"));
define("DB_PASS", getenv("DB_PASSWORD"));

$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    // Something went wrong...
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}
