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
</head>
<body>
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
            <input type="submit" value="Elefánt szerkesztése">
        </div>
    </form>


</body>
</html>