<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdQuestion']))
    {
        // Lädt eine Question
        $question = getQuestion($_POST['IdQuestion']);
        // Lädt alle Modules
        $modules = getModules();

        ?>
            <div class="flex-container-form">
                <p>Frage bearbeiten</p>
                <form method="post" action="../Controller/UpdateQuestion.php">
                    <input type="hidden" class="inputText" name="IdQuestion" value="<?php echo $question->getIdQuestion(); ?>" />
                    <input type="hidden" class="inputText" name="IdUser" value="<?php echo $question->getIdUser(); ?>" />
                    <input type="text" class="inputText" name="Question" value="<?php echo $question->getQuestion(); ?>"  />
                    <input type="text" class="inputText" name="CorrectAnswer" value="<?php echo $question->getCorrectAnswer(); ?>"  />
                    <input type="text" class="inputText" name="WrongAnswer1" value="<?php echo $question->getWrongAnswer1(); ?>" />
                    <input type="text" class="inputText" name="WrongAnswer2" value="<?php echo $question->getWrongAnswer2(); ?>"  />
                    <input type="text" class="inputText" name="WrongAnswer3" value="<?php echo $question->getWrongAnswer3(); ?>"  />
                    <div class="input-list">
                        <?php
                            // Question wurde angenommen?
                            if($question->getIsApproved())
                            {
                                ?>
                                    <input id="isApproved" type="checkbox" name="IsApproved" checked />
                                <?php
                            }
                            else
                            {
                                ?>
                                    <input id="isApproved"  type="checkbox" name="IsApproved" />
                                <?php
                            }
                        ?>
                        <label for="isApproved">freigegeben</label>
                    </div>

                    <select class="select" name="IdModule">
                        <?php 
                            // Iteriert alle Modules
                            foreach($modules as $module)
                            {
                                // Modules = Module der Frage?
                                if($question->getIdModule() == $module->getIdModule())
                                {
                                    ?>
                                        <option value=<?php echo $module->getIdModule(); ?> selected><?php echo $module->getFullDesignation(); ?></option>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <option value=<?php echo $module->getIdModule(); ?>><?php echo $module->getFullDesignation(); ?></option>
                                    <?php
                                }
                            } 
                        ?>
                    </select>
                    
                    <input type="submit" class="inputSubmit" value="speichern" />
                </form>
                <form method="post" action="../ShowQuestion.php">
                    <input type="submit" class="inputSubmit" value="zurück" />
                </form>
            </div>
        <?php
    }

?>