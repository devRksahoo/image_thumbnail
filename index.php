<?php
ini_set('error_reporting', E_ALL);
ini_set('display_error', 1);
if (isset($_POST['submit'])) {
    $img_name = $_FILES['file']['tmp_name'];
    $img = $_FILES['file']['name'];

    $file = file_get_contents("$img_name");
    move_uploaded_file($_FILES['file']['tmp_name'], "uploads/$img");
    $originalpic = imagecreatefromstring($file);

    $width = imagesx($originalpic);
    $height = imagesy($originalpic);
    
    // Set a  fixed height and width
    $thumwidth = 150;
    $thumheight = 100;

    $thumbnail = imagecreatetruecolor($thumwidth, $thumheight);
    imagecopyresampled($thumbnail, $originalpic, 0, 0, 0, 0, $thumwidth, $thumheight, $width, $height);
    imagejpeg($thumbnail, "uploads/thumb.jpg");
}
?>

<form method="post" enctype="multipart/form-data" action="">
    <input type="file" name="file">
    <input type="submit" name="submit">
</form>