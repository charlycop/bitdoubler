<?php
{
        function userdepotlist($depositaddress)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT * FROM deposits WHERE depositaddress = :depositaddress');
        $req->execute(array('depositaddress' => $depositaddress));
        $resultat = $req->fetchAll();

        return $resultat;
    }
}