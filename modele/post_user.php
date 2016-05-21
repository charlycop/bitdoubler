<?php
{
        function post_user($useraddress,$depositaddress,$affcode,$parraincode)
    {
        global $bdd;       
        $req = $bdd->prepare('INSERT INTO id_user (useradress, depositaddress, affcode, parraincode) VALUES (:useradress, :depositaddress, :affcode, :parrain)');
        $req->execute(array(
			'useradress' => $useraddress,
            'depositaddress' => $depositaddress,
            'affcode' => $affcode,
            'parrain' => $parraincode
			));

        $resultat=$bdd->lastInsertId();

        return $resultat;
    }
}