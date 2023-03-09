<?php
$title = 'Gallery';

ob_start();
require 'nav.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Gallery</title>
</head>  
<body>
<style>
    .gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  grid-gap: 10px;
}

.gallery img {
  width: 100%;
  height: auto;
  object-fit: cover;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

</style>

<h1>My Gallery</h1>
 <div class="gallery">
 <?php
 $folder = "../views/uploads/"; // replace "uploads" with the name of your folder        
 $filetype = array("jpg", "jpeg", "png", "gif"); // list of file types to display

 $files = scandir($folder);
 foreach ($files as $file)
  { $path = $folder . "/" . $file;
     $ext = pathinfo($path, PATHINFO_EXTENSION);
     if (in_array($ext, $filetype)) {
         echo '<img src="' . $path . '">';
     }
    }
    ?>
    </div>
</body>
</html>

<?php
$content = ob_get_clean();
include 'layout.php'
?>