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
                                    <td data-label="Frage"><?php echo $question->getQuestion(); ?></td>
                                    <td data-label="Richtige Antwort"><?php echo $question->getCorrectAnswer(); ?></td>
                                    <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer1(); ?></td>
                                    <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer2(); ?></td>
                                    <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer3(); ?></td>
                                    <td data-label="freigegeben"><?php echo $question->getIsApproved(); ?></td>
                                    <td data-label="Modul"><?php echo $module->getFullDesignation(); ?></td>
                                    <td data-label="bearbeiten"></td>
                                    <td data-label="löschen"></td>
                                </tr>
                            <?php
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td data-label="Frage"><?php echo $question->getQuestion(); ?></td>
                                    <td data-label="Richtige Antwort"><?php echo $question->getCorrectAnswer(); ?></td>
                                    <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer1(); ?></td>
                                    <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer2(); ?></td>
                                    <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer3(); ?></td>
                                    <td data-label="freigegeben"><?php echo $question->getIsApproved(); ?></td>
                                    <td data-label="Modul"><?php echo $module->getFullDesignation(); ?></td>
                                    <td data-label="bearbeiten">
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
                                    <td data-label="löschen">
                                        <?php
                                        if($gameQuestions[0]->getDataAvailable())
                                        {
                                            ?>
                                            <p><?php echo $_SESSION['Role']; ?></p>
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
		    $questionArray = array();
                    // Iteriert durch die Module, wo angemeldeter User Tutor ist
                    foreach($isTutorArray as $isTutor)
                    {
                        // Ist angemeldeter User Tutor im Modul der Frage oder ist angemeldeter User Ersteller der Frage?
                        if($isTutor->getIdModule() == $question->getIdModule() || $_SESSION['IdUser'] == $question->getIdUser())
                        {
                            // Ist angemeldeter User Tutor im Modul der Frage und Frage wurde noch nicht angenommen?
                            if($isTutor->getIdModule() == $question->getIdModule() && $question->getIsApproved() == 0 || $question->getIsApproved() == false){
                                $questionAlreadyShown = false;
				foreach($questionArray as $alreadyShownQuestion)
				{
				    if($question->getIdQuestion() == $alreadyShownQuestion)
				    {
 					$questionAlreadyShown = true;
				    }
				}
				
				if($questionAlreadyShown == false)
				{
				?>
				
                                    <tr>
                                        <td data-label="Frage"><?php echo $question->getQuestion(); ?></td>
                                        <td data-label="Richtige Antwort"><?php echo $question->getCorrectAnswer(); ?></td>
                                        <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer1(); ?></td>
                                        <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer2(); ?></td>
                                        <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer3(); ?></td>
                                        <td data-label="freigegeben"><?php echo $question->getIsApproved(); ?></td>
                                        <td data-label="Modul"><?php echo $module->getFullDesignation(); ?></td>
                                        <td data-label="bearbeiten">
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
                                                <input type="submit" value="freigeben" />
                                            </form>
                                        </td>
                                        <td data-label="löschen">
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
                                                <input type="submit" value="ablehnen" />
                                            </form>
                                            <?php
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                <?php
				$questionArray[] = $question->getIdQuestion();	
				}
                            }
                            else 
                            {
				$questionAlreadyShown = false;
				foreach($questionArray as $alreadyShownQuestion)
				{
				    if($question->getIdQuestion() == $alreadyShownQuestion)
				    {
 					$questionAlreadyShown = true;
				    }
				}
				
				if($questionAlreadyShown == false)
				{
                                ?>
                                    <tr>
                                        <td data-label="Frage"><?php echo $question->getQuestion(); ?></td>
                                        <td data-label="Richtige Antwort"><?php echo $question->getCorrectAnswer(); ?></td>
                                        <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer1(); ?></td>
                                        <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer2(); ?></td>
                                        <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer3(); ?></td>
                                        <td data-label="freigegeben"><?php echo $question->getIsApproved(); ?></td>
                                        <td data-label="Modul"><?php echo $module->getFullDesignation(); ?></td>
                                        <td data-label="bearbeiten">
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
                                        <td data-label="löschen">
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
				$questionArray[] = $question->getIdQuestion();
				}
                            }
                        }
                    }
                }
                // Angemeldeter User ist Admin?
                else if($_SESSION['Role'] == "Admin")
                {
                    ?>
                        <tr>
                            <td data-label="Frage"><?php echo $question->getQuestion(); ?></td>
                            <td data-label="Richtige Antwort"><?php echo $question->getCorrectAnswer(); ?></td>
                            <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer1(); ?></td>
                            <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer2(); ?></td>
                            <td data-label="Falsche Antwort"><?php echo $question->getWrongAnswer3(); ?></td>
                            <td data-label="freigegeben"><?php echo $question->getIsApproved(); ?></td>
                            <td data-label="Modul"><?php echo $module->getFullDesignation(); ?></td>
                            <td data-label="bearbeiten">
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
                            <td data-label="löschen">
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