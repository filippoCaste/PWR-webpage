<?
        $session = true;
        if( session_status() === PHP_SESSION_DISABLED  ) {
            $session = false;
        }
    
        if(! $session) {
            echo "<p class='err'>Sessioni disabilitate, impossibile proseguire.";
            exit();
        }
    

    session_start();

    // if(session_status() !== PHP_SESSION_ACTIVE) {
    if(!isset($_SESSION['logged'])) {
        echo "<h1>Accesso negato!</h1>";
        echo "<p> Attenzione! Questa pagina &egrave; accessibile solo previa autenticazione. </p>";
        echo "<p> Vai alla <a href='home.php'>home</a></p>";
        exit();
    } 

    # per una maggiore sicurezza si potrebbe generare un valore casuale ed eventualmente che venga rimossa quando accedo.

    // creo le variabili sessione dei vari corsi spuntati
    // da query prendo tutti i CID e poi vado a vedere dal form quali sono stati spuntati
    if(isset($_REQUEST['sub'])) {
        if(isset($_SERVER['SERVER_ADDR'])) {
            $conn0 = mysqli_connect($_SERVER['SERVER_ADDR'], "uRO", "posso_leggere?", "pianostudi");
        
            if(mysqli_connect_errno()) {
                echo "<p class='err'>Errore collegamento al server: " . mysqli_connect_error() . "</p>";
                return;
            } else {
                $sql0 = "SELECT DISTINCT CID FROM corsi WHERE Attivo=1";

                $stmt0 = mysqli_prepare($conn0, $sql0);
                // no bind_param

                if(!mysqli_stmt_execute($stmt0)) {
                    echo "<p class='err'>Esecuzione query fallita: " . mysqli_error($conn0) . "</p>";
                    return;
                }

                // nel caso in cui l'utente sia tornato indietro alla pagina dei corsi e ne abbia deselezionati, e' necessario
                // andare a cancellare le variabili sessione che invece erano selezionate e tenere solo quelle relative all'ultima
                // selezione.

                mysqli_stmt_bind_result($stmt0, $codice);
                while($row = mysqli_stmt_fetch($stmt0)) {
                    if(isset($_SESSION[$codice])) {
                        unset($_SESSION[$codice]);
                    }
                    if(isset($_REQUEST["chk$codice"])) {
                        $_SESSION[$codice] = true;
                    }
                }

                if(!mysqli_stmt_close($stmt0)) {
                    echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt0) . ".</p>";
                }

                if(!mysqli_close($conn0)) {
                    echo "\n<p class='err'>Errore nella chiusura della connessione al database - impossibile rilasciare le risorse. </p>\n";
                }
                $_SESSION['confirmed'] = true;
                header("Location: conferma.php");
                exit();
            }
        } else {
            echo "<p class='err'> Impossibile connettersi al database!</p>";
        }
    } else if(isset($_REQUEST['res'])) { // cancellazione di tutti i valori selezionati
        if(isset($_SERVER['SERVER_ADDR'])) {
            $conn0 = mysqli_connect($_SERVER['SERVER_ADDR'], "uRO", "posso_leggere?", "pianostudi");
        
            if(mysqli_connect_errno()) {
                echo "<p class='err'>Errore collegamento al server: " . mysqli_connect_error() . "</p>";
                return;
            } else {
                $sql0 = "SELECT DISTINCT CID FROM corsi WHERE Attivo=1";

                $stmt0 = mysqli_prepare($conn0, $sql0);
                // no bind_param

                if(!mysqli_stmt_execute($stmt0)) {
                    echo "<p class='err'>Esecuzione query fallita: " . mysqli_error($conn0) . "</p>";
                    return;
                }

                mysqli_stmt_bind_result($stmt0, $codice);
                while($row = mysqli_stmt_fetch($stmt0)) {
                    if(isset($_SESSION[$codice])) {
                        unset($_SESSION[$codice]);
                    }
                }

                if(!mysqli_stmt_close($stmt0)) {
                    echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt0) . ".</p>";
                }

                if(!mysqli_close($conn0)) {
                    echo "\n<p class='err'>Errore nella chiusura della connessione al database - impossibile rilasciare le risorse. </p>\n";
                }
            }
        } else {
            echo "<p class='err'> Impossibile connettersi al database!</p>";
        }
    }
?>

<!doctype html>

<html lang="it">

    <head>
        <? include "file_suppl/meta.html"; ?>
        <title> Piano carriera </title>
        <link rel="stylesheet" type="text/css" href="file_suppl/vista.css">
        <script src="file_suppl/dynamism.js"></script>
    </head>

    <body class='grid-container'>
        <h1 class='theHeader'>Piano carriera</h1>

        <?php require "file_suppl/navmenu.php"; ?>
        <?php require "file_suppl/info_utente.php"; ?>

        <main class='theMain'>

            <?php
                // se arrivato qui vuol dire che l'utente e' gia' stato ampiamente verificato e quindi ha facolta' di accesso a questa pagina;
                // quindi e' sufficiente un controllo se si tratta di uno studente o di un responsabile per andare a capire cosa deve vedere.
                if(substr($_COOKIE['matricola'], 0, 1) == 's') {
                    if(isset($_SERVER['SERVER_ADDR'])) {
                        $conn = mysqli_connect($_SERVER['SERVER_ADDR'], "uRO", "posso_leggere?", "pianostudi");
                    
                        if(mysqli_connect_errno()) {
                            echo "<p class='err'>Errore collegamento al server: " . mysqli_connect_error() . "</p>";
                            return;
                        } else {
                            $sql = "SELECT Nome, Laurea, CID, Crediti, Ore FROM corsi WHERE Attivo=1 ORDER BY Laurea, Nome, Crediti;";

                            $stmt = mysqli_prepare($conn, $sql);
                            // no bind_param
                            
                            mysqli_set_charset($conn, "utf8mb4"); // per avere una corretta renderizzazione dei caratteri accentati assenti dal charset base americano

                            if(!mysqli_stmt_execute($stmt)) {
                                echo "<p class='err'>Esecuzione query fallita: " . mysqli_error($conn) . "</p>";
                                return;
                            }

                            mysqli_stmt_bind_result($stmt, $nome, $laurea, $cid, $crediti, $ore); 

                            echo "<form id='chkCorsi' action='$_SERVER[PHP_SELF]' method='POST'>";
                            echo "<h2>Tabella dei corsi attivi:</h2>\n <table class='tbl'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> <th>CID</th> <th>Crediti</th> <th>Ore</th> <th>Seleziona</th> </tr>\n\t </thead>\n\t<tbody>";
                            
                            while($row=mysqli_stmt_fetch($stmt)) {                                                                                                           // chkcid è il name per poi ricavare se il checkbox è spuntato   
                                echo "\n\t\t<tr> <td class='tdName'>$nome</td> <td>$laurea</td> <td>$cid</td> <td>$crediti</td> <td>$ore</td> <td><input type='checkbox' name='chk$cid'";
                                if(isset($_SESSION[$cid])) {
                                    echo "checked";
                                }
                                echo "></td></tr>";
                            } 

                            echo "\n\t</tbody>\n</table>\n\n"; 
                            echo "\n <button type='submit' name='sub' value='Procedi'>Procedi</button><button type='submit' name='res' value='Cancella'>Cancella</button> \n </form>";

                            if(!mysqli_stmt_close($stmt)) {
                                echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt) . ".</p>";
                            }
            
                            if(!mysqli_close($conn)) {
                                echo "\n<p class='err'>Errore nella chiusura della connessione al database - impossibile rilasciare le risorse. </p>\n";
                            }
                        }
                    } else {
                        echo "<p class='err'> Impossibile connettersi al database!</p>";
                    }
                }
                else if(substr($_COOKIE['matricola'], 0, 1) == 'r') {
                    echo "<p>In qualità di responsabile, questa pagina non contiene alcun corso. </p>";
                }
            ?>
        </main>
        
        <footer class="ft theFooter">
                <p> Pagina corrente: piano.php </p>
                <?php include "file_suppl/author.html"; ?>
        </footer>
    </body>
</html>