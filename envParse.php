<?php

function parseEnv($filePath)
{
    $env = [];
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1]);
            $env[$key] = $value;
        }
    }

    return $env;
}

// Path to your .env file
$envFilePath = __DIR__ . '/.env';

// Parse the .env file
$env = parseEnv($envFilePath);

?>