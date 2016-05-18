<?php
{
        function userdepot($depositaddress)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT id_user, parraincode FROM id_user WHERE depositaddress = :depositaddress');
        $req->execute(array('depositaddress' => $depositaddress));
        $resultat = $req->fetch();
//
        return $resultat;
    }
}