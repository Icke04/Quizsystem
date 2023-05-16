<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdModule']) && isset($_POST['Abbreviation']) && isset($_POST['FullDesignation']))
    {
        // Module löschen
        deleteModule($_POST['IdModule']);
        header("LOCATION: ../ShowModule.php");
    }
    else
    {
        ?>
        <p>Module konnte nicht gelöscht werden!</p>
        <?php
    }

?>