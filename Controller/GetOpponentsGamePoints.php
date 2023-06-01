<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameQuestion.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameUser.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GamePoint.php");

    // Session-Variablen gesetzt?
    if(isset($_SESSION['IdGameRoom']) && isset($_SESSION['IdGameUser']) && isset($_SESSION['IsSingleplayer']))
    {
        $resultArray = array();

        // Lädt alle Spielfragen
        $gameQuestions = getGameQuestions($_SESSION['IdGameRoom']);

        // Kein Error und Daten vorhanden?
        if(!($gameQuestions[0]->getIsError()) && $gameQuestions[0]->getDataAvailable())
        {
            // Lädt alle Spieler
            $gameUsers = getGameUserByGame($_SESSION['IdGameRoom']);

            // Kein Error und Daten vorhanden?
            if(!($gameUsers[0]->getIsError()) && $gameUsers[0]->getDataAvailable())
            {
                // Iteriert durch die Spieler
                foreach($gameUsers as $gameUser)
                {         
                    // Spieler nicht Ich?   
                    if($gameUser->getIdGameUser() != $_SESSION['IdGameUser'])
                    {
                        // Iteriert durch die Spielfragen
                        foreach($gameQuestions as $gameQuestion)
                        {
                            // Lädt Punkte des Gegners
                            $gamePoint = getGamePoint($gameUser->getIdGameUser(), $gameQuestion->getIdGameQuestion());

                            // Kein Error und Daten vorhanden?
                            if(!($gamePoint->getIsError()) && $gamePoint->getDataAvailable())
                            {
                                $resultArray[] = array($gameQuestion->getIdGameQuestion(), $gamePoint->getIsCorrect());
                            }
                            else
                            {
                                $resultArray[] = array($gameQuestion->getIdGameQuestion(), "open");
                            }
                        }
                    }
                }
            }
            else
            {
                ?>
                <p>Fehler beim Laden der Spieler!</p>
                <?php
            }
        }
        else
        {
            ?>
            <p>Fehler beim Laden der Spielfragen!</p>
            <?php
        }

        echo json_encode($resultArray);
    }
    else
    {
        ?>
        <p>Session-Variablen wurden nicht gesetzt!</p>
        <?php
    }

?>