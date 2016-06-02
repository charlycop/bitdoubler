<?php
{
        function get_lastdeposits($howmany)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT hash, value, date_depot FROM deposits ORDER BY date_depot DESC LIMIT '.$howmany.'');
        $req->execute();
        $resultat = $req->fetchAll();

        return $resultat;
    }
}