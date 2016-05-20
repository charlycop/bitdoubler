<?php
{    
        function post_payout($hash, $listIdDepositPaid, $datetime)
    {
        global $bdd;
        
        // On prépare le lot d'insertion
        $values = '';

        foreach($listIdDepositPaid as $idcourant)
        {
            $values.="(NULL, '$datetime', '$hash', '$idcourant'),";
        }

        // On efface la virgule à la fin
        $values = trim($values, ',');

        if ($values != '')
        {
            $req = $bdd->prepare('INSERT INTO   payouts (
                                                id_payout, 
                                                date_payout, 
                                                hash_payout, 
                                                id_deposit) 
                                                VALUES '.$values.'
                                                ');
            $req->execute();
        
        return true;
        }

        else
        {
            return false;
        }
           
    }
}