<?php
{
        function get_lastpayouts($howmany)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT 	date_payout,
        								useradress,
        								value,
        								nb_payouts
										FROM payouts
										INNER JOIN deposits ON payouts.id_deposit = deposits.id_deposit
										INNER JOIN id_user ON deposits.id_user = id_user.id_user
										ORDER BY date_payout DESC
										LIMIT '.$howmany.'');
        $req->execute();
        $resultat = $req->fetchAll();

        return $resultat;
    }
}