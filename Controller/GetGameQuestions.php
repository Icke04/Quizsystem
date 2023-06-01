<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameUser.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameQuestion.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Question.php");

    // IdGameRoom und IdGameUser vorhanden?
    if(isset($_SESSION['IdGameRoom']) && isset($_SESSION['IdGameUser']))
    {
        // Lädt alle Spielfragen
        $getGameQuestions = getGameQuestions($_SESSION['IdGameRoom']);

        if(!($getGameQuestions[0]->getIsError()) && $getGameQuestions[0]->getDataAvailable())
        {
            $counter = 1;

            // Iteriert durch die Spielfragen
            foreach($getGameQuestions as $getGameQuestion)
            {
                $fomrId = "";
                $formId = "question" . $counter;
                $questionId = "IdGameQuestion" . $counter;

                $answerArray = array();
                $randomIntsArray = array();

                // Lädt iterierte Fragedaten
                $getQuestion = getQuestion($getGameQuestion->getIdQuestion());

                if(!($getQuestion->getIsError()) && $getQuestion->getDataAvailable())
                {
                    $answerArray[] = $getQuestion->getCorrectAnswer();
                    $answerArray[] = $getQuestion->getWrongAnswer1();
                    $answerArray[] = $getQuestion->getWrongAnswer2();
                    $answerArray[] = $getQuestion->getWrongAnswer3();

                    // Frage 1?
                    if($counter == 1)
                    {
                        ?>
                        <div id="<?php echo $formId; ?>" class="questionDiv" >
                        <?php
                    }
                    else
                    {
                        ?>
                        <div id="<?php echo $formId; ?>" class="questionDiv" style="display:none;" >
                        <?php
                    }

                    ?>
                    <div class="question">
                        <p><?php echo $getQuestion->getQuestion(); ?></p>
                    </div>
                    <input id="<?php echo $questionId; ?>" type="hidden" name="IdGameQuestion" value="<?php echo $getGameQuestion->getIdGameQuestion(); ?>" />

                    <?php
                        for($i = 0; $i < 4; $i++)
                        {
                            $randomInt = rand(0, 3);
                            $alreadyExists = false;

                            // Es wurde schon mind. eine Zufallszahl gezogen?
                            if(count($randomIntsArray) > 0)
                            {
                                // Iteriert bereits gezogene Zufallszahlen
                                foreach($randomIntsArray as $int)
                                {
                                    // neue Zufallszahl schon in bestehenden vorhanden?
                                    if($randomInt == $int)
                                    {
                                        $alreadyExists = true;
                                        break;
                                    }
                                }
                            }
                            
                            // Zufallszahl existiert noch nicht?
                            if(!($alreadyExists))
                            {
                                $answerId = "Answer" . ($i + 1);
                                $answerId = $questionId . $answerId;

                                // Counter gleich 0 oder 2?
                                if($i == 0 || $i == 2)
                                {
                                    // Counter gleich 2?
                                    if($i == 2)
                                    {
                                        ?>
                                        </div>
                                        <?php
                                    }

                                    // Counter gleich 0?
                                    if($i == 0)
                                    {
                                        $answerRowId = $questionId . "Answer1And2";
                                    }
                                    else
                                    {
                                        $answerRowId = $questionId . "Answer3And4";
                                    }
                                    ?>
                                    <div class="answerRow" id="<?php echo $answerRowId; ?>">
                                    <?php
                                }
                                ?>
                                <button id="<?php echo $answerId; ?>" class="answer" type="button"><?php echo $answerArray[$randomInt]; ?></button>
                                <?php
                                $randomIntsArray[] = $randomInt;
                            }
                            else
                            {
                                $i = $i - 1;
                            }
                        }
                        ?>
                        </div>
                        <?php
                    ?>                 
                    </div>
                    <?php

                    $counter++;
                }
                else
                {
                    ?>
                    <p>Fehler beim Laden der Fragedaten!</p>
                    <?php
                }
            }
            ?>
            <div class="buttonRow">
                <button type="button" id="nextBtn" class="btn" style="display:none;">Next</button>
            </div>
            <form class="buttonRow" method="post" action="../GameResult.php">
                <input id="submit" class="btn" type="submit" value="Show Result" style="display:none;" />
            </form>
            <?php
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
        ?>
        <p>Fehler beim Laden der Spielfragen!</p>
        <?php
    }

?>