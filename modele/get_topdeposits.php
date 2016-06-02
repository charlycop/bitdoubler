<?php
{
        function get_topdeposits($howmany)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT hash, value, date_depot FROM deposits ORDER BY value DESC LIMIT '.$howmany.'');
        $req->execute();
        $resultat = $req->fetchAll();

        return $resultat;
    }
}