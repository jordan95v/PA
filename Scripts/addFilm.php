<?php
require_once "functions.php";

if (
    empty($_POST["title"]) || empty($_POST["genre"]) ||
    empty($_POST["maker"]) || empty($_POST["actors"]) ||
    empty($_FILES["file"]) || empty($_POST["desc"]) || empty($_FILES)
) {
    $_SESSION["empty"] = 1;
    header("Location: ../index.php");
    die();
}

$target_dir = "../Images/Movies/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$errors = [];
$pdo = connectDB();

checkFileSize($_FILES["file"]["size"], $errors);
checkFileExists($target_file, $errors);
checkImage($_FILES["file"], $errors);
checkFileExtension($imageFileType, $errors);

$title = htmlspecialchars(strtolower($_POST["title"]));
$maker = htmlspecialchars(strtolower($_POST["maker"]));
$actors = htmlspecialchars(strtolower($_POST["actors"]));
$info = htmlspecialchars(strtolower($_POST["desc"]));
if (isset($_POST["featured"]))
{
    $featured = ($_POST["featured"] === "on") ? 1 : 0;
}

if (isAdmin($pdo)) {
    if (count($errors) != 0) {
        $_SESSION["errors"] = $errors;
        header("Location: ../admin.php?type=film");
        die();
    } else {
        if (filmExists($pdo, $title, $errors)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                makeFiligrane($target_file);
                $query = $pdo->prepare("INSERT INTO groschien_film (image_path, title, genre, maker, actors, info, featured) VALUES (:image_path, :title, :genre, :maker, :actors, :info, :featured);");
                $query->execute(["image_path" => $target_file, "title" => $title, "genre" => $_POST["genre"], "maker" => $maker, "actors" => $actors, "info" => $info, "featured" => $featured]);
                updateUserLogs($pdo, $_SESSION["id"], "added a movie: " . $title . ".");
                $_SESSION["upload"] = 1;
                header("Location: ../index.php");
            } else {
                $errors[] = "Impossible d\"uploader le fichier.";
            }
        }
        if (count($errors) != 0) {
            $_SESSION["errors"] = $errors;
            header("Location: ../admin.php?type=film");
        }
    }
} else {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
}


function checkFileSize($fileSize, &$errors)
{
    // Check file size.

    // Args:
    //  fileSize (str): The size to check.
    //  errors(list[str]): The errors list.

    if ($fileSize > 500000) {
        $errors[] = "L\"image est trop volumineuse.";
    }
}

function checkFileExists($target, &$errors)
{
    // Check if file already exists

    // Args:
    //  target (str): Where the file is supposed to be.
    //  errors(list[str]): The errors list.


    if (file_exists($target)) {
        $errors[] = "Le fichier existe déjà dans la base de données.";
    }
}

function checkImage($image, &$errors)
{
    // Check if the image is valid.

    // Args:
    //  image (...): The image to check.
    //  errors(list[str]): The errors list.

    $check = getimagesize($image["tmp_name"]);
    if ($check === false) {
        $errors[] = "Le fichier n\"est pas valide.";
    }
}

function checkFileExtension($extension, &$errors)
{
    // Check the extension of a file.

    // Args:
    //  extension (str): The extension to check.
    //  errors(list[str]): The errors list.

    if ($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
        $errors[] = "L\"image doit être en .jpg, .png ou .jpeg.";
    }
}

function makeFiligrane($imageName)
{
    // Add a watermark to an image.

    // Args:
    //  imageName (...): Where the image is located.

    $stamp = imagecreatefrompng("../Images/stamps.png");
    $im = imagecreatefromjpeg($imageName);

    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    imagejpeg($im, $imageName);
    imagedestroy($im);
}

function filmExists($pdo, $title, &$errors)
{
    // Check if a movie already exists.

    // Args:
    //  pdo (PDO): The PDO instane.
    //  title (str): The title to search.
    //  errors (list[str]): The list of errors.

    // Returns:
    //  bool: True if movie exists, else False.

    $query = $pdo->prepare("SELECT * FROM groschien_film WHERE title=:title;");
    $query->execute(["title" => $title]);

    if (empty($query->fetch())) {
        return true;
    }
    $errors[] = "Le film existe déjà dans la base de données.";
    return false;
}
