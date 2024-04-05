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

?>

<!doctype html>

<html lang="it">

    <head>
        <? include "file_suppl/meta.html"; ?>
        <title>Informazioni</title>
        <link rel="stylesheet" type="text/css" href="file_suppl/vista.css">
        <?php
        function nameCorso($cod) {
            switch ($cod) {
                case 'GES':
                    return "in Ingegneria Gestionale:";
                    break;
                case 'INF':
                    return "in Ingegneria Informatica:";
                    break;
                case 'URB':
                    return "in Architettura Urbanistica:";
                    break;
                case 'RES':
                    return "in Architettura per il Restauro:";
                    break;
            }
        }
        ?>
    </head>

    <body class='grid-container'>
        <h1 class='theHeader'>Informazioni</h1>
        <?php require "file_suppl/navmenu.php"; ?>
        <?php require "file_suppl/info_utente.php"; ?>
        <main class='theMain'>
            <?php
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

                        if(isset($_SESSION['matricola'])) {                        
                            echo "<p>Nella presente pagina sono mostrati i corsi attivi erogati dall'Universit&agrave; suddivisi per corso di laurea.";
                        while($row=mysqli_stmt_fetch($stmt)) {                                                                                                           
                            if(isset($laureaprev) && $laureaprev != $laurea) {
                                echo "\n\t</tbody>\n</table>\n\n";
                                echo "<h3 class='centered'> Corso di laurea " . nameCorso($laurea) . "</h3>";
                                echo "\n<table class='tbl tblCentered'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> <th>CID</th> <th>Crediti</th> <th>Ore</th> </tr>\n\t </thead>\n\t<tbody>";
                            } else if(!isset($laureaprev)) {
                                echo "<h3 class='centered'> Corso di laurea " . nameCorso($laurea) . "</h3>";
                                echo "\n<table class='tbl tblCentered'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> <th>CID</th> <th>Crediti</th> <th>Ore</th> </tr>\n\t </thead>\n\t<tbody>";
                            }     
                                echo "\n\t\t<tr> <td class='tdName'>$nome</td> <td>$laurea</td> <td>$cid</td> <td>$crediti</td> <td>$ore</td>";
                                echo "</tr>";
                                $laureaprev = $laurea;
                        } 

                        echo "\n\t</tbody>\n</table>\n\n"; 
                        } else {
                            echo "<h2>Corsi attivi:</h2>\n";
                            // echo "<table class='tbl tblCentered'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> </tr>\n\t </thead>\n\t<tbody>";
                            while($row=mysqli_stmt_fetch($stmt)) { 
                                if(isset($laureaprev) && $laureaprev != $laurea) {
                                    echo "\n\t</tbody>\n</table>\n\n";
                                    echo "<h3 class='centered'> Corso di laurea " . nameCorso($laurea) . "</h3>";
                                    echo "<table class='tbl tblCentered'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> </tr>\n\t </thead>\n\t<tbody>";
                                } else if(!isset($laureaprev)) {
                                    echo "<h3 class='centered'> Corso di laurea " . nameCorso($laurea) . "</h3>";
                                    echo "<table class='tbl tblCentered'>\n\t<thead>\n\t\t<tr> <th>Nome</th> <th>Laurea</th> </tr>\n\t </thead>\n\t<tbody>";
                                }                                                                                   
                                echo "\n\t\t<tr> <td class='tdName'>$nome</td> <td>$laurea</td>";
                                echo "</tr>";
                                $laureaprev = $laurea;
                            } 

                        echo "\n\t</tbody>\n</table>\n\n"; 
                        }
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
        </main>
        <footer class="ft theFooter">
                <p> Pagina corrente: info.php </p>
                <? include "file_suppl/author.html"; ?>
            </footer>        
    </body>

</html>