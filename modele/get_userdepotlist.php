<?php
{
        function userdepotlist($depositaddress)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT hash, date_depot, value, confirmations FROM deposits WHERE depositaddress = :depositaddress');
        $req->execute(array('depositaddress' => $depositaddress));
        $resultat = $req->fetchAll();
//
        return $resultat;
    }
}