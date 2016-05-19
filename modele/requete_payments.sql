# Sélectionner les paiements à effectuer
SELECT  ROUND(value/100*2) as value, 
		useradress, 
		id_deposit
from deposits
INNER JOIN id_user ON
			deposits.id_user=id_user.id_user
WHERE 
((nb_payouts < 10) AND (confirmations=6))


# Ajouter +1 au compteur de payouts
UPDATE deposits
SET nb_payouts = nb_payouts + 1
WHERE 
((nb_payouts < 10) AND (confirmations=6))