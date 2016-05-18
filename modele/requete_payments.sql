SELECT  value*0.98 as value, 
		useradress, 
		id_deposit,
		nb_payouts
from deposits
INNER JOIN id_user ON
			deposits.id_user=id_user.id_user
WHERE 
((nb_payouts < 10) AND (confirmations=6))

1 UPDATE Compteur
2 SET Compteur = Compteur + 1;