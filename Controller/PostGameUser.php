<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameUser.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdGameRoom']) && $_POST['IdGameRoom'] != 0)
    {
        // User hinzufügen
        $gameUser = postGameUser($_SESSION['IdUser'], $_POST['IdGameRoom']);

        // Kein Error und Daten vorhanden?
        if(!($gameUser->getIsError()) && $gameUser->getDataAvailable())
        {
            $_SESSION['IdGameRoom'] = $_POST['IdGameRoom'];
            $_SESSION['IdGameUser'] = $gameUser->getIdGameUser();
            $_SESSION['IsSingleplayer'] = false;

            header("LOCATION: ../GameRoom.php");
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