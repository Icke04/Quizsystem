<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    // Post-Variable wurde befüllt?
    if(isset($_POST['IdUser']) && isset($_POST['Username']) && isset($_POST['Email']) && isset($_POST['Password']))
    {
        if(isset($_POST['IdRole']))
        {
            $IdRole = $_POST['IdRole'];
        }
        else
        {
            $User = getUser($_POST['IdUser']);
            $IdRole = $User->getIdRole();
        }

        // UserDaten updaten
        $User = new User(intval($_POST['IdUser']), $_POST['Username'], $_POST['Email'], $_POST['Password'], $IdRole, false, "", true);
        $user = updateUser($User);

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