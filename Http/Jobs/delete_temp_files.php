<?php

/*

Delete temporarily files older than a week
Job should run every day

*/

const PUBLIC_PATH = __DIR__ . '/../../public_html/';

$directory = PUBLIC_PATH . 'assets/uploads/temp/';
$files = scandir($directory);

// set the default timezone to use.
date_default_timezone_set('Asia/Tokyo');

$now = time();
$oneWeekAgo = $now - (7 * 24 * 60 * 60); // 7 days in seconds

foreach ($files as $file) {
    // Skip special directories
    if ($file === '.' || $file === '..') {
        continue;
    }

    $filePath = $directory . DIRECTORY_SEPARATOR . $file;

    // Match filenames like: filetype_timestamp.*
    if (preg_match('/^[a-zA-Z]+_(\d+)\..+$/', $file, $matches)) {
        $timestamp = (int) $matches[1];

        if ($timestamp < $oneWeekAgo) {
            // Delete the file
            if (file_exists($filePath)) {
                unlink($filePath);
                echo "Deleted: $file\n";
            }
        }
    }
}
