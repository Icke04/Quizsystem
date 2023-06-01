<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameRoom.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameUser.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameQuestion.php");

    // Session-Variable befüllt?
    if(isset($_SESSION['IdGameRoom']) && isset($_SESSION['IdGameUser']))
    {
        // Lädt Spielraumdaten
        $gameRoom = getGameRoom($_SESSION['IdGameRoom']);

        // Kein Error und Daten vorhanden?
        if(!($gameRoom->getIsError()) && $gameRoom->getDataAvailable())
        {
            $gameUsers = getGameUserByGame($_SESSION['IdGameRoom']);

            if(!($gameUsers[0]->getIsError()) && $gameUsers[0]->getDataAvailable())
            {
                $gameQuestions = getGameQuestions($_SESSION['IdGameRoom']);

                if(!($gameQuestions[0]->getIsError()) && $gameQuestions[0]->getDataAvailable())
                {
                    foreach($gameQuestions as $gameQuestion)
                    {
                        foreach($gameUsers as $gameUser)
                        {
                            $gamePoint = getGamePoint($gameUser->getIdGameUser(), $gameQuestion->getIdGameQuestion());

                            if(!($gamePoint->getIsError()) && $gamePoint->getDataAvailable())
                            {
                                // GamePoint wird gelöscht
                                deleteGamePoint($gameUser->getIdGameUser(), $gameQuestion->getIdGameQuestion());
                            }
                        }
                    }

                    // GameQuestions werden gelöscht
                    deleteGameQuestion($_SESSION['IdGameRoom']);
                }

                // GameUser werden gelöscht
                deleteGameUser($_SESSION['IdGameRoom']);
            }

            deleteGameRoom($_SESSION['IdGameRoom']);
        }
    }

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DeleteGameSession.php");

    header("LOCATION: ../index.php");

?>