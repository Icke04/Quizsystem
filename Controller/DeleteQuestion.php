<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdQuestion']))
    {
        // Question löschen
        deleteQuestion($_POST['IdQuestion']);
        header("LOCATION: ../ShowQuestion.php");
    }
    else
    {
        ?>
        <p>Frage konnte nicht gelöscht werden!</p>
        <?php
    }
    
?>