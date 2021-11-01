<?php

class Elefant {
    private $id;
    private $nev;
    private $fajta;
    private $szuletesiDatum;
    private $suly;
    private $nem;

    public function __construct(string $nev, string $fajta, DateTime $szuletesiDatum, int $suly, string $nem) {
        $this->nev = $nev;
        $this->fajta = $fajta;
        $this->szuletesiDatum = $szuletesiDatum;
        $this->suly = $suly;
        $this->nem = $nem;
        



    }

    public function uj() {
        global $db;
        $db->prepare('INSERT INTO allatkertiek(nev, fajta, szuletesiDatum, suly, nem) 
        VALUES (:nev, :fajta, :szuletesiDatum, :suly, :nem)')
        ->execute(['nev' => $this->nev, ':fajta' => $this->fajta, ':szuletesiDatum' => 
        $this->szuletesiDatum->format('Y-m-d'), ':suly' => $this->suly,
        ':nem' => $this->nem]);
    }


    public function getId() : ?int {
        return $this->id;
    }

    public function getNev() : string {
        return $this->nev;
    }

    public function setNev(string $nev): void {
        $this->nev = $nev;
    }

    

    public function getFajta() : string {
        return $this->fajta;
    }

    public function setFajta(string $fajta) : void {
        $this->fajta = $fajta;
    }

    public function getSzuletesiDatum() {
        return $this->szuletesiDatum;
    }

    public function setSzulDatum(DateTime $szulDatum): void {
        $this->szuletesiDatum = $szulDatum;
    }
    

    public function getSuly() : int {
        return $this->suly;
    }

    public function setSuly(int $suly) : void {
        $this->suly = $suly;
    }

    public function getNem() : string {
        return $this->nem;
    }

    public function setNem(string $nem) : void{
        $this->nem = $nem;
    }

    public static function torol(int $id){
        global $db;
        $db->prepare('DELETE FROM allatkertiek WHERE id = :id')
        ->execute([':id' => $id]);
    }

    public static function getById(int $id) : Elefant  {
        global $db;

        $t = $db->prepare("SELECT * FROM allatkertiek WHERE id = :id");
        $t->execute([':id' => $id]);
        $eredmeny = $t->fetchAll();
        
        $elefant =  new Elefant($eredmeny[0]['nev'], $eredmeny[0]['fajta'], new DateTime($eredmeny[0]['szuletesiDatum']), $eredmeny[0]['suly'], $eredmeny[0]['nem']);
        $elefant->id = $eredmeny[0]['id'];
        return $elefant;
        
    }

    public static function osszes(): array{
        global $db;

        $t = $db->query("SELECT * FROM allatkertiek ORDER BY szuletesiDatum ASC")
        ->fetchAll();
        $eredmeny = [];
        foreach ($t as $elem) {
            $elefant =  new Elefant($elem['nev'], $elem['fajta'], new DateTime($elem['szuletesiDatum']), $elem['suly'], $elem['nem']);
            $elefant->id = $elem['id'];
            $elefant->nev = $elem['nev'];
            $elefant->fajta = $elem['fajta'];
            $elefant->szuletesiDatum = $elem['szuletesiDatum'];
            $elefant->suly = $elem['suly'];
            $elefant->nem = $elem['nem'];
            $eredmeny[] = $elefant;
        }

        return $eredmeny;

    }

    public function mentes() {
        global $db;
        $db->prepare('UPDATE allatkertiek SET nev = :nev, fajta = :fajta, szuletesiDatum =
        :szuletesiDatum, suly = :suly, nem = :nem WHERE id = :id')
        ->execute([':nev' => $this->nev, ':fajta' => $this->fajta,
        ':szuletesiDatum' => $this->szuletesiDatum->format('Y-m-d'), ':suly' => $this->suly,
         ':nem' => $this->nem, ':id' => $this->id]);


    }



}