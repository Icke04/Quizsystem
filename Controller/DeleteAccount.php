<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");
    
    // Post-Variable befüllt?
    if(isset($_POST['IdUser']) && isset($_POST['Username']) && isset($_POST['Email']) && isset($_POST['IdRole']))
    {
        // User löschen
        deleteUser($_POST['IdUser']);
        header("LOCATION: ../ShowAccount.php");
    }
    else
    {
        ?>
        <p>User konnte nicht gelöscht werden!</p>
        <?php
    }
    
?>