<!DOCTYPE HTML>
<head>
    <title>Bitcoin Doubler</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- FAVICONS DEBUT -->
        <link rel="apple-touch-icon" sizes="57x57" href="css/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="css/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="css/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="css/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="css/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="css/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="css/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="css/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="css/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="css/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="css/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="css/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="css/favicons/favicon-16x16.png">
        <link rel="manifest" href="css/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="css/favicons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    <!-- FAVICONS FIN -->
</head>
    
<body>
<h1>Doublez vos bitcoins</h1>


<div id="bilan">
    <form enctype="multipart/form-data" action="modele/creation_compte.php" method="post">
        <label id="useraddress" name="useraddress">
        Nous utiliserons votre adresse bitcoin comme identifiant unique de votre compte. <br>
        Entrez votre adresse bitcoin ici afin de créer votre compte : 
        <input type="text" id="useraddress" name="useraddress" placeholder="2NB7ZV1hc3VCDMaGHyjxdafpT8RwYNoJUU6" required/>
        </label> 
        <input type="submit" value="Créer mon compte"/></input>
    </form>
</div>

</body>
</html>