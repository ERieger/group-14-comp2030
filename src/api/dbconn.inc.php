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

loadEnv('../.env');

// Use constants to define your connection parameters
define("DB_HOST", getenv("DB_HOSTNAME"));
define("DB_NAME", getenv("DB_DATABASE"));
define("DB_USER", getenv("DB_USERNAME"));
define("DB_PASS", getenv("DB_PASSWORD"));

// error_log("DB HOST: " . DB_HOST);
// error_log("DB NAME: " . DB_NAME);
// error_log("DB USER: " . DB_USER);
// error_log("DB PASS: " . DB_PASS);


// Establish connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    echo "Error: Unable to connect to database.<br>";
    echo "Debugging errno: " . mysqli_connect_errno() . "<br>";
    echo "Debugging error: " . mysqli_connect_error() . "<br>";
    exit;
}
