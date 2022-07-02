<?php

require "../Scripts/functions.php";
$pdo = connectDB();
require "fpdf.php";

class PDF extends FPDF
{

    function Header()
    {
        //Logo
        $this->Image('../Images/stamps.png',10,6,30);
        // Police Arial gras 20
        $this->SetFont('Arial','B',20);
        //Décalage à droite
        $this->Cell(75);
        //Titre
        $this->Cell(40,10,utf8_decode('Les Lumières'));
        //Saut de ligne
        $this->Ln(20);
    }

    function Footer()
    {
        //Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        //Police Arial italique 8
        $this->SetFont('Arial','I',8);
        //Couleur du texte en gris
        $this->SetTextColor(128);
        //Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }

    function title($titleData){
        //Arial 14
        $this->SetFont('Arial','B',14);
        //Saut de ligne
        $this->Ln(5);
        //Titre
        $this->Cell(0,6,utf8_decode($titleData),0,1,'L');
        //Saut de ligne
        $this->Ln(4);
    }

    function dataTicket($pdo)
    {
        //Recuperation des achats de billet
        $query = $pdo->prepare("SELECT type, date FROM moyenlezard_user_logs WHERE user_id=:user_id AND type = 'achat de billet' ORDER BY date DESC");
        $query->execute(["user_id" => $_SESSION["id"]]);
        $result = $query->fetchAll();
        $count = count($result);

        //Recuperation des films vis a vis des billets
        $queryMovies = $pdo->prepare("SELECT film_name FROM megalapin_ticket WHERE user_id=:user_id ORDER BY id DESC");
        $queryMovies->execute(["user_id" => $_SESSION["id"]]);
        $resultMovies = $queryMovies->fetchAll();

        $i = 0;
        for($i=0;$i < $count; $i++){
            //Times 12
            $this->SetFont('Times','',12);
            //Sortie du texte justifié
            $this->MultiCell(0,5,utf8_decode('Vous avez effectué un '.$result[$i]["type"].' le '.$result[$i]["date"].' pour le film '.$resultMovies[$i]["film_name"]));
            //Saut de ligne
            $this->Ln();
        }
    }

    function dataAccount($pdo)
    {
        $query = $pdo->prepare('SELECT email, username, creation_date, update_date FROM petitchat_user WHERE id=:id');
        $query->execute(["id" => $_SESSION["id"]]);
        $result = $query->fetch();

        //Times 12
        $this->SetFont('Times','',12);
        //Sortie du texte justifié
        $this->MultiCell(0,5,utf8_decode('Bonjour '.$result["username"].', voici vos données :'));
        $this->Ln();
        $this->MultiCell(0,5,utf8_decode('Vous avez créé votre compte le '.$result["creation_date"]));
        $this->Ln();
        $this->MultiCell(0,5,utf8_decode('La dernière modification date du '.$result["update_date"]));
        $this->Ln();

        $query = $pdo->prepare("SELECT type, date FROM moyenlezard_user_logs WHERE user_id=:user_id AND type = 'login.'ORDER BY date DESC");
        $query->execute(["user_id" => $_SESSION["id"]]);
        $result = $query->fetchAll();
        $count = count($result);
        $i = 0;
        $this->MultiCell(0,5,utf8_decode('Historique de connexion :'));
        for($i=0;$i < $count; $i++){
            $this->MultiCell(0,5,'Connexion le '.$result[$i]["date"].'.');
        }

        $this->Ln();

        $query = $pdo->prepare("SELECT type, date FROM moyenlezard_user_logs WHERE user_id=:user_id AND type = 'logout'ORDER BY date DESC");
        $query->execute(["user_id" => $_SESSION["id"]]);
        $result = $query->fetchAll();
        $count = count($result);
        $i = 0;
        $this->MultiCell(0,5,utf8_decode('Historique de déconnexion :'));
        for($i=0;$i < $count; $i++){
            $this->MultiCell(0,5,utf8_decode('Déconnexion le '.$result[$i]["date"].'.'));
        }
      $this->Ln();

        $query = $pdo->prepare('SELECT count(id_author) FROM geantemarmotte_forum WHERE id_author=:id_author');
        $query->execute(["id_author" => $_SESSION['id']]);
        $result = $query->fetch();
        $this->MultiCell(0,5,utf8_decode('Vous avez publié '.$result["count(id_author)"].' sujet(s) sur le forum, voici vos publications :'));

        $query = $pdo->prepare("SELECT film_subject, title, content, date_publication FROM geantemarmotte_forum WHERE id_author=:id_author ORDER BY date_publication DESC");
        $query->execute(["id_author" => $_SESSION['id']]);
        $result = $query->fetchAll();
        $count = count($result);
        $i = 0;
        for($i=0;$i < $count;$i++){
            $this->MultiCell(0,5,utf8_decode($result[$i]["film_subject"].' : "'.$result[$i]["title"].'", "'.$result[$i]["content"].'". Le '.$result[$i]["date_publication"].'.'));
        }


    }

}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AddPage();

$title = 'Données relatif au compte';
$pdf->title($title);
$pdf->dataAccount($pdo);

$title = 'Date d\'achat de vos billets';
$pdf->title($title);
$pdf->dataTicket($pdo);


$pdf->SetFont('Times','',12);
$pdf->Output();  