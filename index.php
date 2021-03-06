<?php 

require_once "Adatbazis.php";
require_once "Elefant.php";


function ki($szoveg) {
    echo htmlspecialchars($szoveg, ENT_QUOTES);
}

$elefantosHiba = false;
$sikeres = "";
$sikertelen = "";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $deleteId = $_POST['deleteId'] ?? '';
    if ($deleteId != '') {
        Elefant::torol($deleteId);
    }
    else {

    
     $ujNev = $_POST['nev'] ?? '';
     $ujFajta = $_POST['fajta'] ?? '';
     $ujSzulDatum = $_POST['szulDatum'] ?? '';
     $ujSuly = $_POST['suly'] ?? 0;
     $ujNem =  $_POST['nem'] ?? '';

     if (empty($_POST['nev'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert a név mező üres!</p>";
     }
    else if (is_numeric($_POST['nev'])) {

        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert nem lehet szám a név!</p>";
     }
    else if (empty($_POST['faj'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert üres a faj mező!</p>";
     }
     else if (is_numeric($_POST['faj'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert nem lehet szám a faj!</p>";
     }
    else if (empty($_POST['suly'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly nem lehet üres!</p>";
         }
    else if ($_POST['suly'] === "0") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly nem lehet nulla</p>";
         }
    else if ($_POST['suly'] < 0) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert nem lehet negatív szám a súly!</p>";
         }
    else if ($_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert nem lehet üres a nem mező!</p>";
    }
    
        
    else if (is_numeric($_POST['nem'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nemet meghatározó mező nem lehet szám!</p>";
    }
   
    //Csak akkor vehetünk fel új elefántot, ha nincsen hiba!
    else if (!$elefantosHiba) {
        $ujElefant = new Elefant($ujNev, $ujFajta, new DateTime($ujSzulDatum), (int)$ujSuly, $ujNem);
        $ujElefant->uj();
        $sikeres = "<p class='text-success'>Sikeres elefánt felvétel</p>"; 
        }
        
    }


}

    


$elefantok = Elefant::osszes();

$gomb = $_POST['gomb'] ?? false;



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elefántok</title>
    <link rel="stylesheet" href="sajat.css">
    <script src="main.js"></script>
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
</div>
    <div class="container-fluid">

    <form  method="POST">
        <div>
            Név: <input type="text" name="nev" id="neve" required>
            <p class='text-danger' id="hibaN"></p>
        </div>
        <div>
            Fajta: <input type="text" name="fajta" id="faj" required>
            <p class='text-danger' id="hibaF"></p>
        </div>
        <div>
            Születési dátum: <input type="date" name="szulDatum" required>
            <p></p>
        </div>
        <div>
            Súly: <input type="number" name="suly" id="sulya" required>
            <p class='text-danger' id="hibaS"></p>
        </div>
        <div>
            Nem: <input type="text" name="nem" id="neme" required>
            <p class='text-danger' id="hibaNe"></p>
        </div>
        <div>
            <input type="submit" value="Új elefánt" name ="gomb" class="btn btn-warning" id="elefantGomb">
        </div>
    </form>
    </div>
    <?php  if ($gomb && $elefantosHiba) {
        echo $sikertelen; }
        else if ($gomb && !$elefantosHiba) {
            echo $sikeres;
        } ?>
    <?php
    echo "<div class='container-fluid'>";
    echo "<div class='row'>";
        foreach ($elefantok as $elefant) {
            echo "<div class='col-sm-3'>";
            echo "<div class='card bg-warning' style='width: 15rem;'>";
            echo "<img src='elef.jpg' class='elefant img-fluid'><h2 class='text-center'>" . $elefant->getNev() . "</h2>";
            echo "<p> Faj: " . $elefant->getFajta() . "<p>";
            echo "<p> Született: " . $elefant->getSzuletesiDatum() . "<p>";
            echo "<p> Súly: " . $elefant->getSuly() . " tonna <p>";
            echo "<p> Nem: " . $elefant->getNem() . "<p>";
            echo "<form method='POST'>";
            echo "<input type='hidden' name='deleteId' value='" . $elefant->getId() . "'>";
            echo "<div class='text-center'><input type='submit' value='Törlés' class='gombok'></div>";
            echo "</form>";
            echo "<div class='text-center'><a href='szerkesztElefant.php?id=" . $elefant->getId() . "'> <input type='submit' value='Szerkesztés' class='gombok'></a></div>";
            echo "</div>";
            echo "</div>";
            
           
           
        }
        
        echo "</div>";
        echo "</div>";






    ?>






</body>
</html>

