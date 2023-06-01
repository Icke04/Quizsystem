<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");

    // Post-Variable wurde befüllt?
    if(isset($_POST['Message']) && isset($_POST['Username']) && $_POST['Message'] != "" && $_POST['Username'] != "")
    {
        // Nachricht nicht leer?
        if($_POST['Message'] != "" || $_POST['Message'] != null)
        {
            // Nachricht wird gepostet
            $result = postChat($_POST['Username'], $_POST['Message']);
        }
    }
    else
    {
        header("LOCATION: ../index.php");
    }

?>