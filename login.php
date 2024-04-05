<? 
    // avvio sessione
    $session = true;
    if( session_status() === PHP_SESSION_DISABLED  ) {
        $session = false;
    }

    if(! $session) {
        echo "<p class='err'>Sessioni disabilitate, impossibile proseguire.</p>";
        exit();
    }

    session_start();

    if(isset($_REQUEST["mtrcl"]) && isset($_REQUEST["password"])) {
        $psw = trim($_REQUEST["password"]);
        $matr = trim($_REQUEST["mtrcl"]);
        
        if(isset($_SERVER['SERVER_ADDR'])) {
            $conn = mysqli_connect($_SERVER['SERVER_ADDR'], "uRO", "posso_leggere?", "pianostudi");

            if(mysqli_connect_errno()) {
                echo "<p class='err'>Errore collegamento al server: " . mysqli_connect_error() . "</p>";
                return;
            } else {
                $sql = "SELECT Matricola, Crediti FROM utenti WHERE Matricola=? AND utenti.Password=?";

                $stmt = mysqli_prepare($conn, $sql);
                
                mysqli_stmt_bind_param($stmt, "ss", $matr, $psw);
                    
                if(!mysqli_stmt_execute($stmt)) {
                    echo "<p class='err'>Esecuzione query fallita: " . mysqli_error($conn) . "</p>";
                    return;
                }

                mysqli_stmt_bind_result($stmt, $m, $cfu);
                mysqli_stmt_fetch($stmt);

                if($m === $matr) {
                    $scadenza = time() + 3600*48; // time di ora + 48 ore espresse in secondi
                    setcookie("matricola", $matr, $scadenza, "/s270867/website/Elaborato_finale"); // aggiorno il cookie solo se il login ha successo
                    
                    //------------------------------------------
                    $_SESSION['logged'] = 1;
                    
                    $_SESSION['cfu'] = $cfu;
                    $_SESSION['matricola'] = $matr;
                    //------------------------------------------

                    // allora è stato trovato un utente con credenziali valide --> via al redirect
                    if(substr($m, 0, 1) == "s") {
                        header("Location:piano.php");
                        exit();
                    } else if(substr($m, 0, 1) == "r") {
                        header("Location:gestione.php");
                        exit();
                    }
                } else {
                    echo "<script> window.alert('Credenziali errate, riprovare.'); </script>";
                    
                }

                // chiusura statement
                if(!mysqli_stmt_close($stmt)) {
                    echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt) . ".</p>";
                    exit;
                }

                // chiusura conn
                if(!mysqli_close($conn)) {
                    echo "<p class='err'>Errore nella chiusura della connessione al database</p>";
                    exit;
                }
            }
        } else {
            echo "<p class='err'> Impossibile connettersi al database!</p>";
        }
    }    
?>

<!DOCTYPE html>

<html lang="it">

    <head>
        <? include "file_suppl/meta.html"; ?>
        <link rel="stylesheet" type="text/css" href="file_suppl/vista.css">
        <script src="file_suppl/dynamism.js"></script>
        <title> Login </title>
    </head>

    <body class='grid-container'>
        <h1 class='theHeader'>Pagina di accesso </h1>

        <?php require "file_suppl/navmenu.php"; ?>
        <?php require "file_suppl/info_utente.php"; ?>
        <main class='theMain'>


            <form id='loginForm' action="<? echo $_SERVER['PHP_SELF']; ?>" method='POST' onsubmit="return validateLoginForm(this);">
                <p>Inserisci i dati per l'accesso:</p>
                <p>Matricola: <input type="text" name="mtrcl" id='mt' value= '<? echo $_COOKIE['matricola']; ?>'> </p>
                <p>Password: <input type="password" name="password" id='ps'> </p>
                <button type="submit" value="Login">Login</button> 
                <button type="button" onclick="clearForm('mt','ps')"> Cancella </button>
            </form>
        </main>
        
        <footer class="ft theFooter">
            <p> Pagina corrente: login.php </p>
            <? include "file_suppl/author.html"; ?>
        </footer>
    </body>
</html>