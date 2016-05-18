<?php
{
        function user_exist($address)
    {
        global $bdd;       
        $req = $bdd->prepare('SELECT id_user FROM id_user WHERE useradress = :address');
        $req->execute(array(
			'address' => $address
		));
		$resultat = $req->fetch();

        return $resultat;
    }
}