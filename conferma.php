<?php
    // sessione
    $session = true;
    if( session_status() === PHP_SESSION_DISABLED  ) {
        $session = false;
    }

    if(! $session) {
        echo "<p class='err'>Sessioni disabilitate, impossibile proseguire.";
        exit();
    }

    session_start();

    if(!isset($_SESSION['logged'])) {
        echo "<p>Effettua il login per visualizzare correttamente questa pagina.</p>";
        exit();
    }

    if(isset($_REQUEST['annulla'])) {
        unset($_SESSION['annulla']);
        // session_destroy();
        // distruggi tutti i corsi salvati nelle sessioni e torna alla pagina del piano

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
                    exit();
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

        header("Location: home.php");
        exit();
    }

?>

<!doctype html>

<html>
    <header>
        <title>Conferma</title>
        <? include "file_suppl/meta.html"; ?>
        <link rel="stylesheet" type="text/css" href="file_suppl/vista.css">
    </header>

    <body class='grid-container'>
    <?php require "file_suppl/navmenu.php"; ?>
    <?php require "file_suppl/info_utente.php"; ?>
        <main class='theMain'>
            <h1>Riepilogo</h1>
    <!-- <?
            // foreach($_SESSION as $key => $value) {
            //     echo "<p> $key => $value";
            // }
    ?> -->
            <?php
                    if(isset($_SERVER['SERVER_ADDR'])) {
                        $conn = mysqli_connect($_SERVER['SERVER_ADDR'], "uRO", "posso_leggere?", "pianostudi");
                    
                        if(mysqli_connect_errno()) {
                            echo "<p class='err'>Errore collegamento al server: " . mysqli_connect_error() . "</p>";
                            return;
                        } else {

                            $sql2 = "SELECT Crediti, Corso FROM utenti WHERE Matricola=?";
                            if(isset($_SESSION['matricola'])) {
                                $stmt2 = mysqli_prepare($conn, $sql2);
                                mysqli_stmt_bind_param($stmt2, "s", $_SESSION['matricola']);

                                if(!mysqli_stmt_execute($stmt2)) {
                                    echo "<p class='err'>Esecuzione query fallita: " . mysqli_error($stmt2) . "</p>";
                                    return;
                                }
            
                                mysqli_stmt_bind_result($stmt2, $credStudente, $corsoStudente);
                                mysqli_stmt_fetch($stmt2); 
                            } else {
                                echo "<p class='err'>Errore, nessuna matricola salvata.</p>";
                                exit();
                            }

                            if(!mysqli_stmt_close($stmt2)) {
                                echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt0) . ".</p>";
                            }

                            $sql = "SELECT Nome, Laurea, CID, Crediti, Ore FROM corsi WHERE Attivo=1";
        
                            $stmt = mysqli_prepare($conn, $sql);
                            // no bind_param
                            
                            mysqli_set_charset($conn, "utf8mb4"); // per avere una corretta renderizzazione dei caratteri accentati assenti dal charset base americano
        
                            if(!mysqli_stmt_execute($stmt)) {
                                echo "<p class='err'>Esecuzione query fallita: " . mysqli_error($stmt) . "</p>";
                                return;
                            }
        
                            mysqli_stmt_bind_result($stmt, $nome, $laurea, $cid, $crediti, $ore); 
                            
                            // ----------------------------------------
                            $sumCrediti = 0;
                            $isExtra = false;
                            // ----------------------------------------

                            echo "<h2>Tabella dei corsi selezionati:</h2>\n <table class='tbl'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> <th>CID</th> <th>Crediti</th> <th>Ore</th> </tr>\n\t </thead>\n\t<tbody>";
                            
                            while($row=mysqli_stmt_fetch($stmt)) { 
                                if(isset($_SESSION["$cid"]))  {                                                                                                          
                                    echo "\n\t\t<tr> <td class='tdName'>$nome</td> <td>$laurea</td> <td>$cid</td> <td>$crediti</td> <td>$ore</td> </tr>";
                                    $sumCrediti += $crediti;
                                    if($laurea != $corsoStudente) {
                                        $isExtra = true;
                                    }
                                }
                            }

                            if(!mysqli_stmt_close($stmt)) {
                                echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt) . ".</p>";
                            }
                            
                            echo "\n\t</tbody>\n</table>\n\n"; 

                            if(!mysqli_close($conn)) {
                                echo "\n<p class='err'>Errore nella chiusura della connessione al database - impossibile rilasciare le risorse. </p>\n";
                            }
                            echo "<p>La somma totale dei crediti selezionati &egrave;: $sumCrediti CFU.</p>\n";
                            
                            if($sumCrediti < $credStudente || !$isExtra) {
                                if(!$isExtra) {
                                    echo "<p>Da regolamento, &egrave; necessario selezionare almeno un corso non afferente al proprio corso di studi.</p>";
                                } else {
                                    echo "<p>Totale crediti non sufficiente.</p>\n<p>Per raggiungere i $credStudente CFU devi selezionare altri corsi.</p>";
                                }
                                echo "\n<form action='piano.php' method='POST'>\n\t<button type='submit' value='Torna indietro'>Torna indietro</button>\n</form>\n";
                            } else {
                                echo "<form action='fine.php' method='POST'>\n\t<p>Per continuare con la navigazione e confermare i corsi: <button type='submit' value='Conferma'>Conferma</button></p>\n</form>";
                            }

                            echo "\n<form id='annullaSelezione' action='conferma.php' method='POST'>\n\t<input type='hidden' name='annulla' value='true'>\n\t<button type='submit' name='annullaS' value='Annulla selezione'>Annulla selezione</button>\n</form>";
                        }
                    } else {
                        echo "<p class='err'> Impossibile connettersi al database!</p>";
                    }

            ?>
        </main>
        <footer class="ft theFooter">
            <p> Pagina corrente: conferma.php </p>
            <? include "file_suppl/author.html" ; ?>
        </footer>
    </body>

</html>