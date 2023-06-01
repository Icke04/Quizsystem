<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GamePoint.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameQuestion.php");

    // Kein Error und Daten vorhanden?
    if(isset($_SESSION['IdGameRoom']) && isset($_SESSION['IdGameUser']) && isset($_SESSION['IsSingleplayer']))
    {
        // Lädt alle Fragen für ein Spiel
        $gameQuestions = getGameQuestions($_SESSION['IdGameRoom']);

        // Kein Error, Daten vorhanden und Anzahl der Fragen gleich 5?
        if($gameQuestions[0]->getDataAvailable() && $gameQuestions[0]->getIsError() == false && count($gameQuestions) == 5)
        {
            $sumPoints = 0;
            $sumOpponentsPoints = 0;

            ?>
            <div id='resultDiv'>
            <p id='result'></p>
            <table id='resultTable'>
            <?php

            // Singleplayer-Spiel?
            if($_SESSION['IsSingleplayer'])
            {
                ?>
                    <thead>
                        <tr>
                            <td>Question</td>
                            <td>CorrectAnswer</td>
                            <td>WrongAnswer1</td>
                            <td>WrongAnswer2</td>
                            <td>WrongAnswer3</td>
                            <td>Richtig?</td>
                        </tr>
                    </thead>
                    <tbody>
                <?php
            }
            else
            {
                ?>
                    <thead>
                        <tr>
                            <td>Question</td>
                            <td>CorrectAnswer</td>
                            <td>WrongAnswer1</td>
                            <td>WrongAnswer2</td>
                            <td>WrongAnswer3</td>
                            <td>Richtig?</td>
                            <td>Gegner Richtig?</td>
                        </tr>
                    </thead>
                    <tbody>
                <?php
            }

            // Iteriert durch die Fragen des Spiels
            foreach($gameQuestions as $gameQuestion)
            {
                // Lädt Punkte für die Frage
                $gamePoint = getGamePoint($_SESSION['IdGameUser'], $gameQuestion->getIdGameQuestion());

                // Kein Error und Daten vorhanden?
                if(!($gamePoint->getIsError()) && $gamePoint->getDataAvailable())
                {
                    // Lädt die Fragedaten
                    $question = getQuestion($gameQuestion->getIdQuestion());

                    // Kein Error und Daten vorhanden?
                    if(!($question->getIsError()) && $question->getDataAvailable())
                    {
                        ?>
                        <tr>
                            <td><?php echo $question->getQuestion(); ?></td>
                            <td><?php echo $question->getCorrectAnswer(); ?></td>
                            <td><?php echo $question->getWrongAnswer1(); ?></td>
                            <td><?php echo $question->getWrongAnswer2(); ?></td>
                            <td><?php echo $question->getWrongAnswer3(); ?></td>
                            <?php
                            // Frage korrekt beantwortet?
                            if($gamePoint->getIsCorrect() == true || $gamePoint->getIsCorrect() == 1)
                            {
                                $sumPoints++;
                                ?>
                                <td class="green">Richtig</td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td class="red">Falsch</td>
                                <?php
                            }

                            // Spiel ist im Multiplayer-Modus?
                            if(!$_SESSION['IsSingleplayer'])
                            {
                                // Lädt alle Spieler
                                $gameUsers = getGameUserByGame($_SESSION['IdGameRoom']);

                                // Kein Error und Daten vorhanden?
                                if(!($gameUsers[0]->getIsError()) && $gameUsers[0]->getDataAvailable())
                                {
                                    // Iteriert durch Spieler
                                    foreach($gameUsers as $gameUser)
                                    {
                                        // SpielerId ungleich Meiner?
                                        if($gameUser->getIdGameUser() != $_SESSION['IdGameUser'])
                                        {
                                            // Lädt Punkte des Gegners
                                            $opponentsGamePoint = getGamePoint($gameUser->getIdGameUser(), $gameQuestion->getIdGameQuestion());
    
                                            // Kein Error und Daten vorhanden?
                                            if(!($opponentsGamePoint->getIsError()) && $opponentsGamePoint->getDataAvailable())
                                            {
                                                // Frage korrekt beantwortet?
                                                if($opponentsGamePoint->getIsCorrect() == true || $opponentsGamePoint->getIsCorrect() == 1)
                                                {
                                                    $sumOpponentsPoints++;
                                                    ?>
                                                    <td class="green">Richtig</td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td class="red">Falsch</td>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                    <td id="<?php echo $gameQuestion->getIdGameQuestion(); ?>"></td>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                else
                                {
                                    ?>
                                    <p>Fehler beim Laden der Spielerdaten!</p>
                                    <?php
                                }
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    else
                    {
                        ?>
                        <p>Fehler beim Laden der Frage!</p>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <p>Fehler beim Laden der Punkte!</p>
                    <?php
                }
            }

            ?>
                        <tr>
                            <td class="noBackground"></td>
                            <td class="noBackground"></td>
                            <td class="noBackground"></td>
                            <td class="noBackground"></td>
                            <td class="noBackground"></td>
                            <td id='ownPoints'><?php echo $sumPoints; ?></td>
                            <?php
                            if(!$_SESSION['IsSingleplayer'])
                            {
                                ?>
                                <td id='opponentsPoints'></td>
                                <?php
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
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
        <p>Fehler beim Laden der Punkte!</p>
        <?php
    }

?>