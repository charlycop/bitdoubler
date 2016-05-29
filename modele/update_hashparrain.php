<?php
{    
        function update_hashparrain($hashparrain, $hash_depot)
    {
        
        global $bdd;

                $req = $bdd->prepare('UPDATE deposits SET parrainhash = :hashparrain 
                                                        WHERE hash = :hash_depot');
                $req->execute(array(
                'hashparrain' => $hashparrain,
                'hash_depot' => $hash_depot
                ));
    }
}        