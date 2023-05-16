<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
        
    // Post-Variable wurde befüllt?
    if(isset($_POST['Question']) && isset($_POST['CorrectAnswer']) && isset($_POST['WrongAnswer1']) && isset($_POST['WrongAnswer2']) && isset($_POST['WrongAnswer3']) && isset($_POST['IdModule']) && isset($_SESSION['IdUser']) && $_POST['IdModule'] != 0 && $_POST['Question'] != "" && $_POST['CorrectAnswer'] != "" && $_POST['WrongAnswer1'] != "" && $_POST['WrongAnswer2'] != "" && $_POST['WrongAnswer3'] != "")
    {
        // Question wird gepostet
        $question = postQuestion($_POST['Question'], $_POST['CorrectAnswer'], $_POST['WrongAnswer1'], $_POST['WrongAnswer2'], $_POST['WrongAnswer3'], false, $_POST['IdModule'], $_SESSION['IdUser']);

        // Kein Error und Daten vorhanden?
        if(!($question->getIsError()) && $question->getDataAvailable())
        {
            header("LOCATION: ../ShowQuestion.php");
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