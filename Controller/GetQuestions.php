<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/IsTutor.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");

    // Lädt alle Fragen
    $questions = getQuestions();

    // Angemeldeter User ist Tutor?
    if($_SESSION['Role'] == "Tutor")
    {
        // Lädt, wo der angemeldete User Tutor ist
        $isTutorArray = getIsTutorByUser($_SESSION['IdUser']);
    }

    // Kein Error und Daten vorhanden?
    if(!($questions[0]->getIsError()) && $questions[0]->getDataAvailable())
    {
        // Fragen werden iteriert
        foreach($questions as $question)
        {
            // Lädt Module, welches zur Frage gehört
            $module = $question->getModule();

            $gameQuestions = getUsedGameQuestions($question->getIdQuestion());

            // Kein Error und Daten vorhanden?
            if(!($module->getIsError()) && $module->getDataAvailable())
            {
                // Angemeldeter User ist Student?
                if($_SESSION['Role'] == "Student")
                {
                    // Frage wurde vom angemeldeten User erstellt?
                    if($question->getIdUser() == $_SESSION['IdUser'])
                    {
                        // Frage wurde bereits angenommen?
                        if($question->getIsApproved())
                        {
                            ?>
                                <tr>
                                    <td><?php echo $question->getQuestion(); ?></td>
                                    <td><?php echo $question->getCorrectAnswer(); ?></td>
                                    <td><?php echo $question->getWrongAnswer1(); ?></td>
                                    <td><?php echo $question->getWrongAnswer2(); ?></td>
                                    <td><?php echo $question->getWrongAnswer3(); ?></td>
                                    <td><?php echo $question->getIsApproved(); ?></td>
                                    <td><?php echo $module->getFullDesignation(); ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td><?php echo $question->getQuestion(); ?></td>
                                    <td><?php echo $question->getCorrectAnswer(); ?></td>
                                    <td><?php echo $question->getWrongAnswer1(); ?></td>
                                    <td><?php echo $question->getWrongAnswer2(); ?></td>
                                    <td><?php echo $question->getWrongAnswer3(); ?></td>
                                    <td><?php echo $question->getIsApproved(); ?></td>
                                    <td><?php echo $module->getFullDesignation(); ?></td>
                                    <td>
                                        <form method="post" action="../EditQuestion.php">
                                            <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                            <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                            <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                            <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                            <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                            <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                            <input type="hidden" name="IsApproved" value="<?php echo $question->getIsApproved(); ?>" />
                                            <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                            <input class="submitEdit" type="submit" value="&#9881;" />
                                        </form>
                                    </td>
                                    <td>
                                        <?php
                                        if($gameQuestions[0]->getDataAvailable())
                                        {
                                            ?>
                                            <p></p>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <form method="post" action="../Controller/DeleteQuestion.php">
                                                <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                                <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                                <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                                <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                                <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                                <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                                <input type="hidden" name="IsApproved" value="<?php echo $question->getIsApproved(); ?>" />
                                                <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                                <input class="submitDelete" type="submit" value="&#10006;" />
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                }
                // Angemeldeter User ist Tutor?
                else if($_SESSION['Role'] == "Tutor") 
                {
                    // Iteriert durch die Module, wo angemeldeter User Tutor ist
                    foreach($isTutorArray as $isTutor)
                    {
                        // Ist angemeldeter User Tutor im Modul der Frage oder ist angemeldeter User Ersteller der Frage?
                        if($isTutor->getIdModule() == $question->getIdModule() || $_SESSION['IdUser'] == $question->getIdUser())
                        {
                            // Ist angemeldeter User Tutor im Modul der Frage und Frage wurde noch nicht angenommen?
                            if($isTutor->getIdModule() == $question->getIdModule() && $question->getIsApproved() == 0){
                                ?>
                                    <tr>
                                        <td><?php echo $question->getQuestion(); ?></td>
                                        <td><?php echo $question->getCorrectAnswer(); ?></td>
                                        <td><?php echo $question->getWrongAnswer1(); ?></td>
                                        <td><?php echo $question->getWrongAnswer2(); ?></td>
                                        <td><?php echo $question->getWrongAnswer3(); ?></td>
                                        <td><?php echo $question->getIsApproved(); ?></td>
                                        <td><?php echo $module->getFullDesignation(); ?></td>
                                        <td>
                                            <form method="post" action="../Controller/UpdateQuestion.php">
                                                <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                                <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                                <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                                <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                                <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                                <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                                <input type="hidden" name="IsApproved" value="1" />
                                                <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                                <input type="hidden" name="IdUser" value="<?php echo $question->getIdUser(); ?>" />
                                                <input type="submit" value="Approve" />
                                            </form>
                                        </td>
                                        <td>
                                        <?php
                                        if($gameQuestions[0]->getDataAvailable())
                                        {
                                            ?>
                                            <p></p>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <form method="post" action="../Controller/DeleteQuestion.php">
                                                <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                                <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                                <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                                <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                                <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                                <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                                <input type="hidden" name="IsApproved" value="<?php echo $question->getIsApproved(); ?>" />
                                                <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                                <input type="hidden" name="IdUser" value="<?php echo $question->getIdUser(); ?>" />
                                                <input type="submit" value="Decline" />
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                            else 
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $question->getQuestion(); ?></td>
                                        <td><?php echo $question->getCorrectAnswer(); ?></td>
                                        <td><?php echo $question->getWrongAnswer1(); ?></td>
                                        <td><?php echo $question->getWrongAnswer2(); ?></td>
                                        <td><?php echo $question->getWrongAnswer3(); ?></td>
                                        <td><?php echo $question->getIsApproved(); ?></td>
                                        <td><?php echo $module->getFullDesignation(); ?></td>
                                        <td>
                                            <form method="post" action="../EditQuestion.php">
                                                <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                                <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                                <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                                <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                                <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                                <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                                <input type="hidden" name="IsApproved" value="<?php echo $question->getIsApproved(); ?>" />
                                                <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                                <input class="submitEdit" type="submit" value="&#9881;" />
                                            </form>
                                        </td>
                                        <td>
                                            <?php
                                            if($gameQuestions[0]->getDataAvailable())
                                            {
                                                ?>
                                                <p></p>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <form method="post" action="../Controller/DeleteQuestion.php">
                                                    <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                                    <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                                    <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                                    <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                                    <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                                    <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                                    <input type="hidden" name="IsApproved" value="<?php echo $question->getIsApproved(); ?>" />
                                                    <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                                    <input class="submitDelete" type="submit" value="&#10006;" />
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                    }
                }
                // Angemeldeter User ist Admin?
                else if($_SESSION['Role'] == "Admin")
                {
                    ?>
                        <tr>
                            <td><?php echo $question->getQuestion(); ?></td>
                            <td><?php echo $question->getCorrectAnswer(); ?></td>
                            <td><?php echo $question->getWrongAnswer1(); ?></td>
                            <td><?php echo $question->getWrongAnswer2(); ?></td>
                            <td><?php echo $question->getWrongAnswer3(); ?></td>
                            <td><?php echo $question->getIsApproved(); ?></td>
                            <td><?php echo $module->getFullDesignation(); ?></td>
                            <td>
                                <form method="post" action="../EditQuestion.php">
                                    <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                    <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                    <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                    <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                    <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                    <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                    <input type="hidden" name="IsApproved" value="<?php echo $question->getIsApproved(); ?>" />
                                    <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                    <input class="submitEdit" type="submit" value="&#9881;" />
                                </form>
                            </td>
                            <td>
                                <?php
                                if($gameQuestions[0]->getDataAvailable())
                                {
                                    ?>
                                    <p></p>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <form method="post" action="../Controller/DeleteQuestion.php">
                                        <input type="hidden" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                                        <input type="hidden" name="Question" value="<?php echo $question->getQuestion(); ?>" />
                                        <input type="hidden" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>" />
                                        <input type="hidden" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                                        <input type="hidden" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>" />
                                        <input type="hidden" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>" />
                                        <input type="hidden" name="IsApproved" value="<?php echo $question->getIsApproved(); ?>" />
                                        <input type="hidden" name="IdModule" value="<?php echo $question->getIdModule(); ?>" />
                                        <input class="submitDelete" type="submit" value="&#10006;" />
                                    </form>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <p>Fehler beim Laden des Modules!</p>
                <?php
            }
        }
    }
    else
    {
        ?>
        <p>Fehler beim Laden der Fragen!</p>
        <?php
    }

?>