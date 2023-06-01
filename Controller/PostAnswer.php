<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameQuestion.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GamePoint.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdGameQuestion']) && isset($_POST['Answer']) && $_POST['IdGameQuestion'] != 0 && $_POST['Answer'] != "")
    {
        $resultArray = array();

        // Lädt Spielfrage
        $GameQuestion = getGameQuestion($_POST['IdGameQuestion']);

        // Kein Error und Daten vorhanden?
        if(!($GameQuestion->getIsError()) && $GameQuestion->getDataAvailable())
        {
            // Lädt Fragedaten
            $Question = getQuestion($GameQuestion->getIdQuestion());

            // Kein Error und Daten vorhanden?
            if(!($Question->getIsError()) && $Question->getDataAvailable())
            {
                $idGameQuestion = $GameQuestion->getIdGameQuestion();

                $correctAnswer = $Question->getCorrectAnswer();
                $wrongAnswer1 = $Question->getWrongAnswer1();
                $wrongAnswer2 = $Question->getWrongAnswer2();
                $wrongAnswer3 = $Question->getWrongAnswer3();

                // Frage korrekt beantwortet?
                if($correctAnswer == $_POST['Answer'])
                {
                    postGamePoint($_SESSION['IdGameUser'], $_POST['IdGameQuestion'], true);
                    $resultArray = array($correctAnswer, $_POST['Answer']);
                }
                // Frage falsch beantwortet?
                else if($wrongAnswer1 == $_POST['Answer'] || $wrongAnswer2 == $_POST['Answer'] || $wrongAnswer3 == $_POST['Answer'])
                {
                    postGamePoint($_SESSION['IdGameUser'], $_POST['IdGameQuestion'], false);
                    $resultArray = array($correctAnswer, $_POST['Answer']);
                }

                echo json_encode($resultArray);
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