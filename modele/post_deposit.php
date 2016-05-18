<?php
{    
        function post_deposit($hash, $date_depot, $value, $depositaddress, $id_user, $nb_confirmations)
    {
        global $bdd;

        if ($nb_confirmations == 0)
        {
            $req = $bdd->prepare('INSERT INTO   deposits (
                                                hash, 
                                                date_depot, 
                                                value, 
                                                depositaddress, 
                                                id_user, 
                                                confirmations) 
                                                VALUES (
                                                    :hash, 
                                                    NOW(), 
                                                    :value, 
                                                    :depositaddress, 
                                                    :id_user, 
                                                    :nb_confirmations
                                                    )');
            $req->execute(array(
                                'hash' => $hash,
                                'value' => $value,
                                'depositaddress' => $depositaddress,
                                'id_user' => $id_user, 
                                'nb_confirmations' => $nb_confirmations
            ));
        }

        else
        {
            // On vérifie le nombre de confirmations dans la BDD actuellement
            $req = $bdd->prepare('SELECT confirmations FROM deposits WHERE hash = :hash');
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
           
        }
        
        $resultat=$bdd->lastInsertId();
        return $resultat;
    }
}