<?php
{
        function get_parrainbtcaddress($parraincode)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT useradress FROM id_user WHERE affcode = :parraincode');
        $req->execute(array(
            'parraincode' => $parraincode
        ));
        $resultat = $req->fetch();

        return $resultat;
    }
}