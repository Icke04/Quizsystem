<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    
    // Post-Variable wurde befüllt?
    if(isset($_POST['Abbreviation']) && isset($_POST['FullDesignation']) && $_POST['Abbreviation'] != "" && $_POST['FullDesignation'] != "")
    {
        // Module hinzufügen
        $module = postModule($_POST['Abbreviation'], $_POST['FullDesignation']);

        // Kein Error und Daten vorhanden?
        if(!($module->getIsError()) && $module->getDataAvailable())
        {
            header("LOCATION: ../ShowModule.php");
        }
        else
        {
            header("LOCATION: ../index.php");
        }
    }
    else
    {
        header("LOCATION: ../index.php");
    }

?>