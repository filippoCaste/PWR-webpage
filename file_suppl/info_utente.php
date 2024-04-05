<div class='userInfo'>
    <p> 
        <?php 
            if(session_status() === PHP_SESSION_ACTIVE) {
                if(isset($_SESSION['logged']) && isset($_SESSION['matricola'])) {
                    echo $_SESSION['matricola'];
                    if(substr($_SESSION['matricola'], 0, 1) == 's') {
                        echo ": $_SESSION[cfu] crediti";
                    } else {
                        echo ": NA";
                    }
                    
                } else {
                    echo "ANON: 0 crediti";
                }
            }
        ?>
    </p>
    <p> <a href="logout.php" class='logout <?php if(!isset($_SESSION["logged"])) {echo " disabled";}?>'>LOGOUT</a> </p>
</div>