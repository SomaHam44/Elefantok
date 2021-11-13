<?php

require_once 'Adatbazis.php';
require_once 'Elefant.php';

$elefantId = $_GET['id'] ?? null;

if ($elefantId === null) {
    header("Location: index.php");
    exit();
} 
$elefant = Elefant::getById($elefantId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ujNev = $_POST['nev'] ?? '';
    $ujFajta = $_POST['fajta'] ?? '';
    $ujSzulDatum = $_POST['szulDatum'] ?? '';
    $ujSuly = $_POST['suly'] ?? 0;
    $ujNem = $_POST['nem'] ?? '';

    
    $elefant->setNev($ujNev);
    $elefant->setFajta($ujFajta);
    $elefant->setFajta($ujFajta);
    $elefant->setszulDatum(new DateTime($ujSzulDatum));
    $elefant->setSuly($ujSuly);
    $elefant->setNem($ujNem);


    $elefant->mentes();
    header("Location: index.php");
}




?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elefántok</title>
    <link rel="stylesheet" href="sajat.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
  <div class="jumbotron">
    <h1>Elefántok</h1>      
    <h5 class="text-center">Afrikai szavannák állata</h5>
  </div> 
    <div class="container-fluid">
    <form method="POST">
        <div>
            Név: <input type="text" name="nev" value='<?php echo $elefant->getNev(); ?>'>
        </div>
        <div>
            Fajta: <input type="text" name="fajta" value='<?php echo $elefant->getFajta(); ?>'>
        </div>
        <div>
            Születési dátum: <input type="date" name="szulDatum">
        </div>
        <div>
            Súly: <input type="number" name="suly" value='<?php echo $elefant->getSuly(); ?>'>
        </div>
        <div>
            Nem: <input type="text" name="nem" value='<?php echo $elefant->getNem(); ?>'>
        </div>
        <div>
            <input type="submit" class="btn btn-warning" value="Elefánt szerkesztése">
        </div>
    </form>
    </div>


</body>
</html>