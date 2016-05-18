<?php
{
        function post_user($useraddress,$depositaddress,$affcode)
    {
        global $bdd;       
        $req = $bdd->prepare('INSERT INTO id_user (useradress, depositaddress, affcode) VALUES (:useradress, :depositaddress, :affcode)');
        $req->execute(array(
			'useradress' => $useraddress,
            'depositaddress' => $depositaddress,
            'affcode' => $affcode
			));

        $resultat=$bdd->lastInsertId();

        return $resultat;
    }
}