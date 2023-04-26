<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    
    // Post-Variable wurde befüllt?
    if(isset($_POST['Username']) && isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['IdRole']) && $_POST['Username'] != "" && $_POST['Email'] != "" && $_POST['Password'] != "" && $_POST['IdRole'] != "")
    {
        // Userdaten werden gepostet
        $user = postUser($_POST['Username'], $_POST['Email'], $_POST['Password'], $_POST['IdRole']);

        // Kein Error und Daten vorhanden?
        if(!($user->getIsError()) && $user->getDataAvailable())
        {
            header("LOCATION: ../ShowAccount.php");
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