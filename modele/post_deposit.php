<?php
{    
        function post_deposit($hash, $date_depot, $value, $depositaddress, $id_user, $nb_confirmations)
    {
        global $bdd;

        // On fige la date de transaction de PHP
        $datetimephp = date("Y-m-d H:i:s");

        if ($nb_confirmations == 0)
        {
            $req = $bdd->prepare('INSERT INTO   deposits (
                                                id_deposit,
                                                hash, 
                                                date_depot, 
                                                value, 
                                                depositaddress, 
                                                id_user, 
                                                confirmations,
                                                nb_payouts,
                                                last_payout) 
                                                VALUES (
                                                    NULL,
                                                    :hash, 
                                                    :datedepot, 
                                                    :value, 
                                                    :depositaddress, 
                                                    :id_user, 
                                                    :nb_confirmations,
                                                    0,
                                                    :datetime
                                                    )');
            $req->execute(array(
                                'hash' => $hash,
                                'datedepot' => $datetimephp,
                                'value' => $value,
                                'depositaddress' => $depositaddress,
                                'id_user' => $id_user, 
                                'nb_confirmations' => $nb_confirmations,
                                'datetime' => $datetimephp
            ));
            $resultat=$bdd->lastInsertId();
        }

        else
        {
            // On vérifie le nombre de confirmations dans la BDD actuellement
            $req = $bdd->prepare('SELECT confirmations, id_deposit FROM deposits WHERE hash = :hash');
            $req->execute(array(
            'hash' => $hash
            ));
            $confs_actuels = $req->fetch();

            if ($confs_actuels['confirmations'] < $nb_confirmations)
            {
                $req = $bdd->prepare('UPDATE deposits SET confirmations = :nb_confirmations WHERE hash = :hash');
                $req->execute(array(
                'nb_confirmations' => $nb_confirmations,
                'hash' => $hash
                ));
            }
        
            $resultat=(int) $confs_actuels['id_deposit'];
        }
        
        return $resultat;
    }
}