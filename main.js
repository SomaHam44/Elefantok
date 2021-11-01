
function nevreKattintas() {
    if (document.getElementById("neve").value === "") {
        document.getElementById("hibaN").innerHTML = "A név nem lehet üres";
    }
    else if (!isNaN(document.getElementById("neve").value)) {
        document.getElementById("hibaN").innerHTML = "A név nem lehet szám";
    }
    else {
        document.getElementById("hibaN").innerHTML = "";
    }

}
function fajraKattintas() {
    if (document.getElementById("faj").value === "") {
        document.getElementById("hibaF").innerHTML = "A faj nem lehet üres";
    }
    else if (!isNaN(document.getElementById("faj").value)) {
        document.getElementById("hibaF").innerHTML = "A faj nem lehet szám";
    }
    else {
        document.getElementById("hibaF").innerHTML = "";
    }
}

function sulyraKattintas() {
    if (document.getElementById("sulya").value === "") {
        document.getElementById("hibaS").innerHTML = "A súly nem lehet üres";
    }
    else if (document.getElementById("sulya").value === "0") {
        document.getElementById("hibaS").innerHTML = "A súly nem lehet nulla";
    }
    else if (document.getElementById("sulya").value < 0) {
        document.getElementById("hibaS").innerHTML = "A súly nem lehet negatív";
    }
    else {
        document.getElementById("hibaS").innerHTML = "";
    }
}

function nemreKattintas() {
    if (document.getElementById("neme").value === "") {
        document.getElementById("hibaNe").innerHTML = "A nem mező nem lehet üres";
    }
    else if (!isNaN(document.getElementById("neme").value)) {
        document.getElementById("hibaNe").innerHTML = "A nem mezőben nem lehet szám";
    }
    else {
        document.getElementById("hibaNe").innerHTML = "";
    }
}



function init() {
    document.getElementById("neve").addEventListener("input", nevreKattintas);
    document.getElementById("faj").addEventListener("input", fajraKattintas);
    document.getElementById("sulya").addEventListener("input", sulyraKattintas);
    document.getElementById("neme").addEventListener("input", nemreKattintas);
    
}




document.addEventListener("DOMContentLoaded", init);