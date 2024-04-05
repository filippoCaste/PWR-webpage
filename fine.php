<?php
    $session = true;
    if( session_status() === PHP_SESSION_DISABLED ) {
        $session = false;
    }

    if(! $session) {
        echo "<p class='err'>Sessioni disabilitate, impossibile proseguire.</p>";
        exit();
    }

    session_start();

    // poiche' non ha senso accedere alla pagina di fine senza aver completato alcun carico didattico, e senza essersi nemmeno loggati,
    // all'utente se non loggato verra' consigliato di tornare alla pagina home dalla quale potra' avere una overview generale dei vari
    // orientamenti offerti dall'universita' e quindi eventualmente recarsi alla pagina di login.
    // if(session_status() !== PHP_SESSION_ACTIVE) {
    if(!isset($_SESSION['logged'])) {
        echo "<h1>Attenzione!</h1>";
        echo "<p>Per accedere a questa pagina devi prima aver definito un carico didattico.</p>";
        echo "<p> Vai alla <a href='home.php'>home</a></p>";
        exit();
    }

    // se invece l'utente è loggato ma non ha ancora effettuato la selezione e la conferma dalla pagina piano,
    // verra' rimandato alla pagina piano per poter effettuare la selezione adeguata.
    if(!isset($_SESSION['confirmed'])) {
        echo "<h1>Attenzione!</h1>";
        echo "<p>Per continuare la navigazione in questa pagina devi prima effettuare una selezione dei corsi alla pagina <a href='piano.php'> piano </a></p>";
        exit();
    }
?>

<!doctype html>

<html lang="it">

    <head>
        <?php include "file_suppl/meta.html"; ?>
        <title>Fine</title>
        <link rel="stylesheet" type="text/css" href="file_suppl/vista.css">
    </head>

    <body class='grid-container'>
        <h1 class='theHeader'>Fine</h1>
        <?php require "file_suppl/navmenu.php"; ?>
        <?php require "file_suppl/info_utente.php"; ?>
        
        <main class='theMain'>
            <p> Hai completato la definizione del tuo carico didattico. Buono studio! </p>
        </main>

        <footer class="ft theFooter">
                <p> Pagina corrente: fine.php </p>
                <?php include "file_suppl/author.html"; ?>
        </footer>
    </body>


</html>