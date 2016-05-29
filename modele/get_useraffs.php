<?php
{
        function get_useraffs($codeparrain)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT   value, 
                                         id_user.useradress,
                                         parrainhash,
                                         date_depot
                                         from deposits
                                         INNER JOIN id_user ON
                                         deposits.id_user=id_user.id_user
                                            WHERE 
                                                ((confirmations=6) AND parraincode=:parraincode)');
        $req->execute(array(
            'parraincode' => $codeparrain
        ));
        $resultat = $req->fetchAll();

        return $resultat;
    }
}