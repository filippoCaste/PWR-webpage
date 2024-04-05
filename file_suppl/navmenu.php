<nav class="theMenu1">
    <a href="home.php" class='menItem'>HOMEPAGE</a>
</nav>
<nav class="theMenu2">
    <a href="info.php" class='menItem'>INFO</a>
</nav>
<nav class="theMenu3">
    <a href="login.php" class='menItem<?php if(isset($_SESSION['logged'])) {echo " disabled";} ?>' >LOGIN</a>
</nav>
<nav class="theMenu4">
    <a href="piano.php" class='menItem'>PIANO</a>
</nav>
<nav class="theMenu5">
    <a href="gestione.php" class='menItem <?php 
    if(!isset($_SESSION['logged']) || (isset($_SESSION['logged']) && substr($_COOKIE['matricola'], 0, 1)!=='r')) {
        echo ", disabled";
        } ?>'>GESTIONE</a>
</nav>