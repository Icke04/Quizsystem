<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Role.php");

    // Post-Variable wurde befüllt?
    if(isset($_POST['Username']) && isset($_POST['Password']))
    {
        // Überprüft Userdaten
        $responseGetUser = getUserForLogin($_POST['Username'], $_POST['Password']);

        // Kein Error und Daten vorhanden?
        if(!($responseGetUser->getIsError()) && $responseGetUser->getDataAvailable())
        {
            $responseGetRole = getRole($responseGetUser->getIdRole());

            if(!($responseGetRole->getIsError()) && $responseGetRole->getDataAvailable())
            {
                // Session wird gestartet
                $_SESSION["IdUser"] = $responseGetUser->getIdUser();
                $_SESSION["Username"] = $responseGetUser->getUsername();
                $_SESSION["Role"] = $responseGetRole->getRole();
                header("LOCATION: ../index.php");
            }
            else
            {
                header("LOCATION: ../Login.php");
            }
        }
        else
        {
            header("LOCATION: ../Login.php");
        }
    }
    else
    {
        header("LOCATION: ../Login.php");
    }

?>