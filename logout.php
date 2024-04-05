<?php
    $session = true;
    if( session_status() === PHP_SESSION_DISABLED  ) {
        $session = false;
    }

    if(! $session) {
        echo "<p class='err'>Sessioni disabilitate, impossibile proseguire.";
        exit();
    }

    session_start();

    $_SESSION = array();
    unset($_SESSION['matricola']);
    session_destroy();

    // cancellato tutto si torna alla homepage
    header("Location:home.php");
?>