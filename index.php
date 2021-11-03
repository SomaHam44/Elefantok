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

     if (empty($_POST['nev']) && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== ""
      && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert a név mező üres!</p>";
     }
    else if (empty($_POST['fajta']) && $_POST['nev'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== ""
     && $_POST['nem'] !== "") {

        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert üres a fajta mező</p>";
     }
    else if (empty($_POST['suly']) && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['nev'] !== ""
     && $_POST['nem']
     !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert üres a súly mező</p>";
     }
     else if (empty($_POST['nem']) && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && $_POST['nev'] !== "") {

        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel,mert üres a nem mező!</p>";
     }
    else if ($_POST['suly'] === "0" && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['nev'] !== ""
     && $_POST['nem']
         !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly nem lehet nulla</p>";
         }
    else if ($_POST['suly'] === "0" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['nev'] === ""
     && $_POST['nem']
         === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert az összes mező üres és a súly nem lehet nulla</p>";
         }
    else if ($_POST['suly'] === "0" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['nev'] === "" 
    && $_POST['nem']
         === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly nem lehet nulla és nem lett megadva név, nem és fajta</p>";
         }
    else if ($_POST['suly'] < 0 && $_POST['suly'] !== "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['nev'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert nem lehet negatív szám a súly és a többi mező üres</p>";
    }
    
        
    else if ($_POST['suly'] < 0 && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['nev'] !== "" 
    && $_POST['nem']
     !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly nem lehet negatív szám</p>";
    }
    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert minden mező megadása kötelező</p>";
            
        }
    else if (is_numeric($_POST['nev']) && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && $_POST['nem'] !== "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név nem lehet szám</p>";
    }

    else if (is_numeric($_POST['nev']) && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név nem lehet szám és a többi mező üres</p>";
    }

    else if (is_numeric($_POST['nev']) && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név nem lehet szám és a fajta, nem mező üres és születési dátum nincs megadva</p>";
    }

    else if ($_POST['nev'] !== "" &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && $_POST['nem'] !== "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta nem lehet szám</p>";
    }

    else if ($_POST['nev'] === "" &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta nem lehet szám és a súly mezőn kívül a többi üres</p>";
    }

    else if ($_POST['nev'] === "" &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta nem lehet szám és minden másik mező üres</p>";
    }

    else if (is_numeric($_POST['nev']) &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név és fajra nem lehet szám valamint a többi mező üres</p>";
    }

    else if (is_numeric($_POST['nev']) &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "" ) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert nem lehet szám a név és a fajta és a súly megadásán kívül a többi mező üres</p>";
    }

    else if (is_numeric($_POST['nev']) &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && (is_numeric($_POST['nem']))) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nem, fajta és név nem lehet szám és nincsen megadva megfelelő születési dátum</p>";
    }

    else if (is_numeric($_POST['nev']) &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && (is_numeric($_POST['nem']))) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név,fajta és nemet meghatározó mező értéke nem lehet szám és a másik két mező üres</p>";
        
    }

    else if ($_POST['nev'] === "" &&  (is_numeric($_POST['fajta'])) && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && (is_numeric($_POST['nem']))) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta és nem nem lehet szám típusú és a többi mező üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && is_numeric($_POST['nem'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nem mező értéke nem lehet szám</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta mezőn kívül minden üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a neven kívül minden üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && !(is_numeric($_POST['nem']) && $_POST['nem'] !== "")) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nem értékén kívül minden mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && is_numeric($_POST['nem'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nem értéke nem lehet szám és minden mező üres</p>";
    }


    else if ($_POST['nev'] === "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvéte, mert a fajta és elefánt nemét meghatározó mezőn kívül minden másik üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert nem lett megadva megfelelő dátum és súly mező üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név és az elefánt nemén kívül minden mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly mező és a nemet meghatározó mezőn kívül a többi mező üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly, születési dátum és nem mező üres vagy nem megfelelő</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert nem megfelelő a születési dátum</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta és név mező üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta, súly és nem mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a születési dátumon kívül minden üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] === "" 
    && is_numeric($_POST['nem'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nem mezőben nem lehet szám és a többi mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && is_numeric($_POST['nem'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nem mezőben nem lehet szám és a súlyon kívül a többi mező üres </p>";
    }
    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== ""
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súlyon kívül a többi mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a születési dátum lett csak megadva</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta és a dátum kivételével a többi mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nemet meghatározó mező és a dártumon kívül a többi mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta és súly mezőn kívül a többi üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta, súly és a nem mezőn kívül a többi üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név és a nem mező üres</p>";
    }


    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert csak a súly lett megadva</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a név és a súly üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] !== "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta és a súly mező üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] === "" && $_POST['szulDatum'] === "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta, dátum és nem mező üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] === "" && $_POST['szulDatum'] !== "" && $_POST['suly'] !== "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a fajta és a nem mező üres</p>";
    }

    else if ($_POST['nev'] !== "" && $_POST['fajta'] !== "" && $_POST['szulDatum'] !== "" && $_POST['suly'] === "" 
    && $_POST['nem'] === "") {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a súly és a nem mező üres</p>";
    }

    else if ($_POST['nev'] === "" && $_POST['fajta'] === "" && $_POST['szulDatum'] == "" && $_POST['suly'] === "" 
    && is_numeric($_POST['nem'])) {
        $elefantosHiba = true;
        $sikertelen = "<p class='text-danger'>Sikertelen elefánt felvétel, mert a nem értéke nem lehet szám és a többi mező üres</p>";
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

    <form method="POST">
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

