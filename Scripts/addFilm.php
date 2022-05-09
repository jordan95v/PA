<?php
require_once 'functions.php';

if (
    empty($_POST['title']) && empty($_POST['genre']) &&
    empty($_POST['maker']) && empty($_POST['actor']) &&
    empty($_FILES['file']) && count($_POST) != 5
) {
    die();
}

$target_dir = "../Images/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$errors = [];
$pdo = connectDB();

checkFileSize($_FILES['file']['size'], $errors);
// checkFileExists($target_file, $errors);
checkImage($_FILES['file'], $errors);
checkFileExtension($imageFileType, $errors);

if (count($errors) != 0)
{
    $_SESSION['errors'] = $errors;
    header('Location: ../index.php');
}
else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        makeFiligrane($target_file);
        $query = $pdo->prepare('INSERT INTO groschien_film (image_path, title, genre, maker, actors) VALUES (:image_path, :title, :genre, :maker, :actors);');
        $query->execute(['image_path'=>$target_file, 'title'=>$_POST['title'], 'genre'=>$_POST['genre'], 'maker'=>$_POST['maker'], 'actors'=>$_POST['actor']]);
        $_SESSION['upload'] = 1;
        header('Location: ../index.php');
    } else {
        $errors[] = 'Impossible d\'uploader le fichier.';
    }
    if (count($errors) != 0)
    {
        $_SESSION['errors'] = $errors;
        header('Location: ../index.php');
    } 
}

function checkFileSize($fileSize, &$errors)
{
    // Check file size.

    if ($fileSize > 500000) {
        $errors[] = 'L\'image est trop volumineuse.';
    }
}

function checkFileExists($target, &$errors)
{
    // Check if file already exists

    if (file_exists($target)) {
        $errors[] = 'Le fichier existe déjà dans la base de données.';
    }
}

function checkImage($image, &$errors)
{
  $check = getimagesize($image["tmp_name"]);
  if($check === false) {
        $errors[] = 'Le fichier n\'est pas valide.';
  }
}

function checkFileExtension($extension, &$errors)
{
    if($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
        $errors[] = 'L\'image doit être en .jpg, .png ou .jpeg.';
    }
}

function makeFiligrane($imageName) {
    // Charge le cachet et la photo afin d'y appliquer le tatouage numérique
    $stamp = imagecreatefrompng('../Images/stamp.png');
    $im = imagecreatefromjpeg($imageName);

    // Définit les marges pour le cachet et récupère la hauteur et la largeur de celui-ci
    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    // Copie le cachet sur la photo en utilisant les marges et la largeur de la
    // photo originale  afin de calculer la position du cachet 
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    
    imagejpeg($im, $imageName);
    imagedestroy($im);
}


