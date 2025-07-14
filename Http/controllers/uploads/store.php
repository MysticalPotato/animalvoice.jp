<?php

use Core\Response;
use Core\Validator;

header('Content-Type: application/json');

$errors = [];

// abort if no image
if(!isset($_FILES['file']) || $_FILES['file']['size'] == 0) {
    echo json_encode(['success' => false, 'errors' => 'Required fields: file.']);
	die();
}

$file = $_FILES['file'];

// clean input
$_POST = cleanInput($_POST);

// do file validation
$max_size_in_kb = 2000;
$max_size_in_mb = 2;

if(!Validator::fileType($file, ['jpg', 'jpeg', 'png', 'gif'])) {
    $errors['image'] = insertVars(__('response.file_type_2'), ['.jpg', '.png', 'gif']);
}

elseif(!Validator::fileSize($file, $max_size_in_kb)) {
    $errors['image'] = insertVars(__('response.file_size'), $max_size_in_mb . ' MB');
}

// abort if any errors
if(!empty($errors)) {
    echo json_encode(['success' => false, 'error' => $errors['image']]);
    die();
}

// upload image
$rel_file_path = uploadFile($file, 'img_' . time(), 'temp');
$file_path = public_path($rel_file_path);

// resize image if width is above 624 px
$max_width = 624;
$dim = getimagesize($file_path);

$width = $dim[0];
$height = $dim[1];

if($width > $max_width) {
    $new_height = (int)(($max_width * $height) / $width);
    resizeImage($file_path, $max_width, $new_height);
}

// return uploaded file url
echo json_encode(['success' => true, 'url' => url($rel_file_path)]);