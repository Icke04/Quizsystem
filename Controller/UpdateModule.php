<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdModule']) && isset($_POST['Abbreviation']) && isset($_POST['FullDesignation']) && $_POST['IdModule'] != 0 && $_POST['Abbreviation'] != "" && $_POST['FullDesignation'] != "")
    {
        // Module updaten
        $Module = new Module(intval($_POST['IdModule']), $_POST['Abbreviation'], $_POST['FullDesignation'], false, "", true);
        $module = updateModule($Module);

        // Kein Error und Daten vorhanden?
        if(!($module->getIsError()) && $module->getDataAvailable())
        {
            header("LOCATION: ../ShowModule.php");
        }
        else
        {
            ?>
            <p>Fehler beim Updaten des Modules!</p>
            <?php
        }
    }
    else
    {
        ?>
        <p>Post-Variable wurde nicht gesetzt!</p>
        <?php
    }

?>