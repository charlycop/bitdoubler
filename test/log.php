<?php
// 1 : on ouvre le fichier
$monfichier = fopen('log.txt', 'a');
fputs($monfichier , $transactions);
// 2 : on fera ici nos opérations sur le fichier...

// 3 : quand on a fini de l'utiliser , on ferme le fichier
fclose($monfichier);
?>