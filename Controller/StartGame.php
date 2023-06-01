<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameRoom.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameQuestion.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");
    
    // Session-Variable befüllt?
    if(isset($_SESSION['IdGameRoom']) && isset($_SESSION['IdGameUser']))
    {
        // Lädt Spielraumdaten
        $gameRoom = getGameRoom($_SESSION['IdGameRoom']);

        // Kein Error und Daten vorhanden?
        if(!($gameRoom->getIsError()) && $gameRoom->getDataAvailable())
        {
            // Lädt alle Spielfragen
            $getGameQuestions = getGameQuestions($gameRoom->getIdGameRoom());

            // Spielfragen wurden noch nicht generiert?
            if(count($getGameQuestions) != 5)
            {
                // Lädt alle Fragen zum ausgewählten Module
                $getQuestions = getQuestionByModuleAndIsApproved($gameRoom->getIdModule());

                // Kein Error und Daten vorhanden?
                if(!($getQuestions[0]->getIsError()) && $getQuestions[0]->getDataAvailable() && count($getQuestions) >= 5)
                {
                    // Anzahl der Fragen
                    $countQuestions = count($getQuestions);
                    $randomInts = array();

                    // Iteriert 5 mal, um 5 zufällige Fragen zu wählen
                    for($i = 0; $i < 5; $i++)
                    {
                        // Zufallszahl
                        $randomInt = rand(0, $countQuestions-1);
            
                        // Überprüft, ob Frage bereits gewählt wurde
                        $alreadyExists = false;
                        if(count($randomInts) > 0)
                        {
                            foreach($randomInts as $int)
                            {
                                if($randomInt == $int)
                                {
                                    $alreadyExists = true;
                                    break;
                                }
                            }
                        }
            
                        // Frage wurde noch nicht ausgewhält?
                        if(!($alreadyExists))
                        {
                            $gameQuestion = $getQuestions[$randomInt];
                            $idGameQuestion = postGameQuestion($_SESSION['IdGameRoom'], $gameQuestion->getIdQuestion());
                            $randomInts[] = $randomInt;
                        }
                        else
                        {
                            $i = $i - 1;
                        }
                    }
                    
                    header("LOCATION: ../AnswerQuestion.php");
                }
                else
                {
                    ?>
                    <p>Fehler beim Laden der Fragen zum ausgewählten Module!</p>
                    <?php
                }
            }
            else
            {
                header("LOCATION: ../AnswerQuestion.php");
            }
        }
        else
        {
            ?>
            <p>Fehler beim Laden der Spielfragen!</p>
            <?php
        }
    }
    else
    {
        header("LOCATION: ../index.php");
    }

?>