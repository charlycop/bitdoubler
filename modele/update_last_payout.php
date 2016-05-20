<?php
{    
        function update_last_payout($listIdDepositPaid, $datetime)
    {
        // On prépare le lot d'insertion
        $values = '(';

        foreach($listIdDepositPaid as $idcourant)
        {
            $values.="$idcourant,";
        }

        // On efface la virgule à la fin et on ferme la parenthèse
        $values = trim($values, ',');
        $values .= ')';

        global $bdd;

                $req = $bdd->prepare('UPDATE deposits SET last_payout = :datetime, 
                                                          nb_payouts = nb_payouts + 1 
                                                        WHERE id_deposit in '.$values.'');
                $req->execute(array(
                'datetime' => $datetime
                ));
    }
}        