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

    if(isset($_SESSION['matricola'])) {
        $matr = $_SESSION['matricola'];        
        if(substr($matr,0,1) == 'r') {
            if(isset($_SERVER['SERVER_ADDR'])) 
                $conn = mysqli_connect($_SERVER['SERVER_ADDR'], "uRW", "SuperPippo!!!", "pianostudi");
                    
            if(mysqli_connect_errno()) {
                echo "<p class='err'>Errore collegamento al server: " . mysqli_connect_error() . "</p>";
                exit();
            } else {

                if(isset($_REQUEST['update'])) {
                    $queryCID = "SELECT CID, Attivo FROM corsi";
                    $rs = mysqli_query($conn, $queryCID);
                    $cids = array();
                    while($row = mysqli_fetch_assoc($rs)) {
                        $cids[$row['CID']] = $row['Attivo'];
                    }
                
                    $sql = "UPDATE corsi SET Attivo=? WHERE CID=?;";
                    $stmt = mysqli_prepare($conn, $sql);

                    foreach ($cids as $key => $value) {
                        if(isset($_REQUEST["chk$key"])) {
                            mysqli_stmt_bind_param($stmt, "is", abs($value-1), $key);
                        
                        if(!mysqli_stmt_execute($stmt)) {
                            echo "<p class='err'>Esecuzione query fallita: " . mysqli_stmt_error($stmt) . "</p>";
                            return;
                        }
                    }
                    }

                    if(!mysqli_stmt_close($stmt)) {
                        echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt) . ".</p>";
                    }
                    
                } else if(isset($_REQUEST['add'])) {
                    if(isset($_REQUEST['nome']) && isset($_REQUEST['cdl']) && isset($_REQUEST['cfu']) && isset($_REQUEST['h']) && isset($_REQUEST['cid'])) {
                        $n = trim($_REQUEST['nome']);
                        $cdl = trim($_REQUEST['cdl']);
                        $cid = trim($_REQUEST['cid']);
                        $cfu = trim($_REQUEST['cfu']);
                        $h = trim($_REQUEST['h']);

                        $err = false;
                        if(!preg_match("/^(([[:alnum:]\è\ò\à\ì\é\ù])([\s])?){10,40}$/", $n)) {
                            echo "<script> window.alert('Nome del corso incorretto. Ritentare.')</script>";
                            $err = true;
                        }
                        if(!preg_match("/^[A-Z]{3}$/", $cdl)) {
                            echo "<script> window.alert('Collegio di laurea incorretto. Ritentare.')</script>";
                            $err = true;
                        } else if(!($cdl==="INF" || $cdl === "GES" || $cdl === "RES" || $cdl === "URB")) {
                            echo "<script>window.alert('Collegio di laurea inesistente. Inserirne uno valido.')</script>";
                            $err = true;
                        }
                        if(!preg_match("/^[\d]{2}[A-Z]{2}$/", $cid)) {
                            echo "<script> window.alert('Codice del corso incorretto. Ritentare.')</script>";
                            $err = true;
                        }
                        if(!preg_match("/^[\d]{1,2}$/", $cfu)) {
                            echo "<script> window.alert('Numero cfu incorretto. Ritentare.')</script>";
                            $err = true;
                        } else if(!($cfu >= 1 && $cfu <= 10)) {
                            echo "<script> window.alert('Il valore di cfu può essere compreso tra 1 e 10.'); </script>";
                            $err = true;
                        }
                        if(!preg_match("/^[\d]{1,2}$/", $h)) {
                            echo "<script> window.alert('Numero di ore incorretto. Ritentare.')</script>";
                            $err = true;
                        } else if(!($h >= 9 && $h <= 90)) {
                            echo "<script> window.alert('Numero di ore incorretto, deve essere compreso tra 9 e 90'); </script>";
                            $err = true;
                        }

                        if($err) {
                            // header("Location: gestione.php");
                            exit();
                            // return;
                        }

                        $sql = "INSERT INTO corsi(Nome, Laurea, CID, Crediti, Ore, Attivo) VALUES (?, ?, ?, ?, ?, 1);";
                        $stmt = mysqli_prepare($conn, $sql);

                        mysqli_stmt_bind_param($stmt, "sssii", $n, $cdl, $cid, $cfu, $h);

                        if(!mysqli_stmt_execute($stmt)) {
                            echo "<p class='err'>Esecuzione query fallita: " . mysqli_stmt_error($stmt) . "</p>";
                            return;
                        }

                        if(!mysqli_stmt_close($stmt)) {
                            echo "<p class='err'>Errore chiusura connessione statement " . mysqli_stmt_error($stmt) . ".</p>";
                        }
                    }
                }
        }
     } else {
            echo "<script>window.alert('L\'accesso a questa pagina è riservato ai responsabili');</script>";
            // header("Location: login.php");
            exit();
        }

    } else {
        echo "<p class='err'>Impossibile eseguire l'operazione. Utente non identificato.";
        // header("Location: login.php");
        exit();
    }
?>



<!doctype html>

<html lang="it">

    <head>
        <? include "file_suppl/meta.html"; ?>
        <title>Gestione</title>
        <link rel="stylesheet" type="text/css" href="file_suppl/vista.css">
        <script src="file_suppl/dynamism.js"></script>
    </head>

    <body class='grid-container'>
        <h1 class='theHeader'>Gestione dei corsi</h1>
        <?php require "file_suppl/navmenu.php"; ?>
        <?php require "file_suppl/info_utente.php"; ?>
        <main class='theMain'>
           
            <h2>Panoramica</h2>
            <?php
                if(isset($_SERVER['SERVER_ADDR'])) {
                    $conn = mysqli_connect($_SERVER['SERVER_ADDR'], "uRO", "posso_leggere?", "pianostudi");
                
                    if(mysqli_connect_errno()) {
                        echo "<p class='err'>Errore collegamento al server: " . mysqli_connect_error() . "</p>";
                        return;
                    } else {
                        $sql = "SELECT Nome, Laurea, CID, Crediti, Ore, Attivo FROM corsi ORDER BY Laurea, Nome, Crediti;";

                        $stmt = mysqli_prepare($conn, $sql);
                        // no bind_param
                        
                        mysqli_set_charset($conn, "utf8mb4"); // per avere una corretta renderizzazione dei caratteri accentati assenti dal charset base americano

                        if(!mysqli_stmt_execute($stmt)) {
                            echo "<p class='err'>Esecuzione query fallita: " . mysqli_error($conn) . "</p>";
                            return;
                        }

                        mysqli_stmt_bind_result($stmt, $nome, $laurea, $cid, $crediti, $ore, $status); 

                        echo "<form id='chkCorsi' action='$_SERVER[PHP_SELF]' method='POST'>";
                        echo "<h2>Tabella dei corsi:</h2>\n <table class='tbl'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> <th>CID</th> <th>Crediti</th> <th>Ore</th> <th>Attiva/Disattiva</th> </tr>\n\t </thead>\n\t<tbody>";
                        
                        while($row=mysqli_stmt_fetch($stmt)) {
                            echo "\n\t\t<tr> <td class='tdName'>$nome</td> <td>$laurea</td> <td>$cid</td> <td>$crediti</td> <td>$ore</td> <td>";
                            if($status == 1) {
                                echo "Disattiva: ";
                            } else {
                                echo "Attiva: ";
                            }
                            echo "<input type='checkbox' name='chk$cid'";
                            
                            echo "></td></tr>";
                        } 

                        echo "\n\t</tbody>\n</table>\n\n"; 
                        echo "\n <button type='submit' name='update' value='Applica modifiche'>Applica modifiche</button><button type='reset' value='Annulla'>Annulla</button> \n </form>";

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

            ?>

            <h2>Aggiungi corso</h2>

            <form action='<? echo "$_SERVER[PHP_SELF]"; ?>' method='POST' id='addCorso' onsubmit='return validateCorso(this);'>
            <fieldset>
                <legend>Inserisci i dati</legend>
            
                <p> Nome del corso: <input type='text' name='nome'> </p>
                <p> Corso di laurea: <input type='text' name='cdl'></p>
                <p> Codice del corso: <input type='text' name='cid'></p>
                <p> Crediti del corso (CFU): <input type='number' min=1 step=1 max=10 name='cfu'> </p>
                <p> Ore complessive: <input type='number' min=9 step=1 max=90 name='h'> </p>
                <p> <button type='submit' value='Aggiungi' name='add'>Aggiungi</button> </p>
            </fieldset>
            </form>

        </main>
        <footer class="ft theFooter">
                <p> Pagina corrente: gestione.php </p>
                <? include "file_suppl/author.html"; ?>
        </footer>
    </body>


</html>