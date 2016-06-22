<?php
{
        function get_payoutstx($id_deposit)
    {
        global $bdd;       
        $req = $bdd->prepare('SELECT date_payout, hash_payout FROM payouts WHERE id_deposit = :id_deposit');
        $req->execute(array('id_deposit' => $id_deposit));
        $resultat = $req->fetchAll();

        return $resultat;
    }
}