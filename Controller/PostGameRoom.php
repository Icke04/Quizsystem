<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameRoom.php");
    
    // Post-Varibale befüllt?
    if(isset($_POST['IdModule']) && $_POST['IdModule'] != 0)
    {
        // GameRoom posten
        $GameRoom = postGameRoom($_POST['IdModule'], $_POST['IsSingleplayer']);

        // Kein Error und Daten vorhanden?
        if(!($GameRoom->getIsError()) && $GameRoom->getDataAvailable())
        {
            // GameUser hinzufügen
            $gameUser = postGameUser($_SESSION['IdUser'], $GameRoom->getIdGameRoom());

            // Kein Error und Daten vorhanden?
            if(!($gameUser->getIsError()) && $gameUser->getDataAvailable())
            {
                $_SESSION['IdGameRoom'] = $GameRoom->getIdGameRoom();
                $_SESSION['IdGameUser'] = $gameUser->getIdGameUser();
                $_SESSION['IsSingleplayer'] = $GameRoom->getIsSingleplayer();

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
    }
    else
    {
        header("LOCATION: ../index.php");
    }
    
?>