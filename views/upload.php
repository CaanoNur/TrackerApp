<?php
require "common.php";
$title = 'Upload';

ob_start();
require 'nav.php';
?>

<!DOCTYPE html>
<html>
<body>
<h1><?php echo $title ?></h1>

<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
<li><a href="https://www.cc.puv.fi/~e2101714/php/proman/views/uploads/">Uploaded Files</a></li>

</body>
</html>

<?php
$content = ob_get_clean();
include 'layout.php'
?>