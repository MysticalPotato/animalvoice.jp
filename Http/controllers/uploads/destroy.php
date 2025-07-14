<?php

header('Content-Type: application/json');

function rel_path($url) {
    $base_url = url('/assets/uploads/');
    $base_len = strlen($base_url);

    // ensure it's a valid upload path
    if (str_starts_with($url, $base_url)) {
        return substr($url, $base_len);
    }

    return false;
}

// abort if no url
if(empty($_POST['url'])) {
    echo json_encode(['success' => false, 'errors' => array('Required fields: url.')]);
	die();
}

// sanitize input
$url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

// get relative upload url
$rel_path = rel_path($url);

if(!$rel_path) {
    echo json_encode(['success' => false, 'errors' => array('Invalid image URL.')]);
	die();
}

// delete file
deleteFile($rel_path);

// set response code and return success
echo json_encode(['success' => true]);