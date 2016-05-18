<?php
{
        function get_user($useraddress)
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT id_user, depositaddress, affcode, parraincode FROM id_user WHERE useradress = :useradress');
        $req->execute(array(
            'useradress' => $useraddress
        ));
        $resultat = $req->fetch();

        return $resultat;
    }
}