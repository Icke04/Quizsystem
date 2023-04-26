<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    
    // Post-Variable wurde befüllt?
    if(isset($_POST['Role']) && $_POST['Role'] != "")
    {
        // Rolle hinzufügen
        $role = postRole($_POST['Role']);

        // Kein Error und Daten vorhanden?
        if(!($role->getIsError()) && $role->getDataAvailable())
        {
            header("LOCATION: ../ShowRole.php");
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