<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");

    // Post-Variable befüllt?
    if(isset($_POST['Question']) && isset($_POST['CorrectAnswer']) && isset($_POST['WrongAnswer1']) && isset($_POST['WrongAnswer2']) && isset($_POST['WrongAnswer3']) && isset($_POST['IdModule']) && isset($_SESSION['IdUser']) && $_POST['IdModule'] != 0 && $_POST['Question'] != "" && $_POST['CorrectAnswer'] != "" && $_POST['WrongAnswer1'] != "" && $_POST['WrongAnswer2'] != "" && $_POST['WrongAnswer3'] != "")
    {
        // IsApproved wurde nicht gepostet?
        if(!(isset($_POST['IsApproved'])))
        {
            $IsApproved = false;
        }
        else
        {
            $IsApproved = true;
        }

        // Question updaten
        $Question = new Question(intval($_POST['IdQuestion']), $_POST['Question'], $_POST['CorrectAnswer'], $_POST['WrongAnswer1'], $_POST['WrongAnswer2'], $_POST['WrongAnswer3'], $IsApproved, $_POST['IdModule'], $_POST['IdUser'], false, "", true);
        $question = updateQuestion($Question);

        // Kein Error und Daten vorhanden?
        if(!($question->getIsError()) && $question->getDataAvailable())
        {
            header("LOCATION: ../ShowQuestion.php");
        }
        else
        {
            ?>
            <p>Fehler beim Updaten der Frage!</p>
            <?php
        }
    }
    else
    {
        ?>
        <p>Post-Variable wurde nicht gesetzt!</p>
        <?php
    }

?>