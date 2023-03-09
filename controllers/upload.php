<?php
require_once "../model/model.php";

require "../views/upload.php";

$target_dir = "../views/uploads/";
$target_file = '';

if (isset($_FILES["fileToUpload"])) {
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
}

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



if(isset($_POST["submit"]) && isset($_FILES['fileToUpload']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
  $allowedTypes = array('image/jpeg', 'image/png', 'image/gif', 'text/plain');
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if(in_array($check['mime'], $allowedTypes)) {
    $uploadOk = 1;
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
  } else {
    echo "Only JPG, PNG, GIF and txt files are allowed.";
    $uploadOk = 0;
  }
} else {
  $uploadOk = 0;
}

if ($uploadOk == 0) {
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

  
?>