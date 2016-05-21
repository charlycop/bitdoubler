<?php
{
        function parraincode_exist($parraincode)
    {
        global $bdd;       
        $req = $bdd->prepare('SELECT affcode FROM id_user WHERE affcode = :parraincode');
        $req->execute(array(
			'parraincode' => $parraincode
		));
		$resultat = $req->fetch();
        
        return $resultat;
    }
}