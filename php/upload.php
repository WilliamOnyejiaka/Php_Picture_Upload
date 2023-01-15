<?php

function upload_image($image_file){
    $extension = pathinfo($image_file['name'], PATHINFO_EXTENSION);
    $new_name = time() . '.' . $extension;
    $image_source = '../images/' . $new_name;
    return move_uploaded_file($image_file['tmp_name'], $image_source) ? $image_source : false;

}


if (isset($_FILES['image_file'])) {
    $image_source = upload_image($_FILES['image_file']);
    if ($image_source) {
        http_response_code(200);
        echo json_encode([
            'error' => false,
            'image_source' => $image_source
        ]);
    }else {
        http_response_code(500);
        echo json_encode([
            'error' => true,
            'message' => "Something went wrong"
        ]);
    }

} else {
    http_response_code(400);
    echo json_encode([
        'error' => true,
        'message' => "image file missing"
    ]);
}