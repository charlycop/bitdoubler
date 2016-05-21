<?php
{
        function topayout()
    {
        
        global $bdd;       
        $req = $bdd->prepare('SELECT ROUND(value/100*2) as value, 
                                                           id_user.useradress, 
                                                          id_deposit
                                                          from deposits
                                                    INNER JOIN id_user ON
                                                        deposits.id_user=id_user.id_user
                                                    WHERE 
                                                        ((nb_payouts < 10) 
                                                            AND (confirmations=6) 
                                                            AND (TIMEDIFF(NOW(),last_payout) >= "01:30:00"))');
        $req->execute();
        $resultat = $req->fetchAll();

        return $resultat;
    }
}
