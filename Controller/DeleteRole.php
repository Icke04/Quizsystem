<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Role.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdRole']))
    {
        // Role löschen
        deleteRole($_POST['IdRole']);
        header("LOCATION: ../ShowRole.php");
    }
    else
    {
        ?>
        <p>Rolle konnte nicht gelöscht werden!</p>
        <?php
    }
    
?>