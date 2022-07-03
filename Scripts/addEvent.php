<?php
require_once "functions.php";

if (
    empty($_POST["title"]) || empty($_POST["type"]) ||
    empty($_FILES["file"]) || !isset($_POST["date-debut"]) ||
    !isset($_POST["date-fin"]) || empty($_POST["content"]) ||
    empty($_POST["maker"]) || empty($_POST["actor"]) ||
    count($_POST) != 7 || empty($_FILES)
) {
    die();
}


$targetDir = "../Images/Events/";
$targetFile = $targetDir . basename($_FILES["file"]["name"]); //$_FILE variable de telechargement de fichier | basename retourne le chemin
$fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION)); // pathinfo retourne des informations sur un chemin (extension indique l'extension d'un fichier)
$errors = [];
$pdo = connectDB();

checkFileSize($_FILES["file"]["size"], $errors);
checkFileExists($targetFile, $errors);
checkImage($_FILES["file"], $errors);
checkFileExtension($fileType, $errors);

$title = strtolower($_POST["title"]);
$maker = strtolower($_POST["maker"]);
$actor = strtolower($_POST["actor"]);
$startDate = $_POST['date-debut'];
$endDate = $_POST['date-fin'];
$eventContent = nl2br(htmlspecialchars($_POST["content"]));

if (isAdmin($pdo))
{
    if (count($errors) != 0)
    {
        $_SESSION["errors"] = $errors;
        header("Location: ../admin.php?type=event");
    }
    else {
        if (eventExists($pdo, $title, $errors))
        {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                makeFiligrane($targetFile);
                $query = $pdo->prepare("INSERT INTO gigaecureil_event (image_event, title, type_event, maker, actors, content, start_date_event, end_date_event) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
                $query->execute(
                    array(
                        $targetFile, 
                        $title, 
                        $_POST["type"], 
                        $maker, 
                        $actor,
                        $eventContent, 
                        $startDate, 
                        $endDate
                    )
                );
                $_SESSION["uploadEvent"] = 1;
                header("Location: ../admin.php?type=event");
            } else {
                $errors[] = "Impossible d\"uploader le fichier.";
            }
        }
        if (count($errors) != 0)
        {
            $_SESSION["errors"] = $errors;
            header("Location: ../admin.php?type=event");
        } 
    }
}

function checkFileSize($fileSize, &$errors)
{
    
    if ($fileSize > 500000) {
        $errors[] = "L\"image est trop volumineuse.";
    }
}

function checkFileExists($target, &$errors)
{
   
    if (file_exists($target)) {
        $errors[] = "Le fichier existe déjà dans la base de données.";
    }
}

function checkImage($image, &$errors)
{

  $check = getimagesize($image["tmp_name"]);
  if($check === false) {
        $errors[] = "Le fichier n\"est pas valide.";
  }
}

function checkFileExtension($extension, &$errors)
{

    if($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
        $errors[] = "L\"image doit être en .jpg, .png ou .jpeg.";
    }
}

function makeFiligrane($imageName) {

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

function eventExists ($pdo, $title, &$errors)
{

    $query=$pdo->prepare("SELECT * FROM gigaecureil_event WHERE title=:title");
    $query->execute(["title"=>$title]);

    if (empty($query->fetch()))
    {
        return true;
    }
    $errors[] = "L'évènement existe déjà dans la base de données.";
    return false;
}