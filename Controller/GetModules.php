<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/IsTutor.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    // Lädt alle Modules
    $modules = getModules();

    // Kein Error und Daten vorhanden?
    if(!($modules[0]->getIsError()) && $modules[0]->getDataAvailable())
    {
        // Modules werden iteriert
        foreach($modules as $module)
        {
            // Lädt alle Tutoren eines Modules
            $tutors = getIsTutorByModule($module->getIdModule());

            ?>
            <tr>
                <td><?php echo $module->getAbbreviation(); ?></td>
                <td><?php echo $module->getFullDesignation(); ?></td>
                <td>
                    <ul>
                        <?php
                            // Tutoren werden iteriert
                            foreach($tutors as $tutor)
                            {
                                // Lädt Userdaten des Tutors
                                $user = getUser($tutor->getIdUser());

                                // Kein Error und Daten vorhanden?
                                if(!($user->getIsError()) && $user->getDataAvailable())
                                {
                                    ?>
                                    <li><?php echo $user->getUsername(); ?></li>
                                    <?php
                                }
                                else if ($user->getIdUser() == 0)
                                {
                                    ?>
                                    <p>Kein Tutor vorhanden!</p>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <p>Fehler beim Laden der Tutoren!</p>
                                    <?php
                                }
                            }
                        ?>
                    </ul>
                </td>
                <td>
                    <form method="post" action="../EditModule.php">
                        <input type="hidden" name="IdModule" value="<?php echo $module->getIdModule(); ?>" />
                        <input type="hidden" name="Abbreviation" value="<?php echo $module->getAbbreviation(); ?>" />
                        <input type="hidden" name="FullDesignation" value="<?php echo $module->getFullDesignation(); ?>" />
                        <input class="submitEdit" type="submit" value="&#9881;" />
                    </form>
                </td>
                <td>
                    <form method="post" action="../Controller/DeleteModule.php">
                        <input type="hidden" name="IdModule" value="<?php echo $module->getIdModule(); ?>" />
                        <input type="hidden" name="Abbreviation" value="<?php echo $module->getAbbreviation(); ?>" />
                        <input type="hidden" name="FullDesignation" value="<?php echo $module->getFullDesignation(); ?>" />
                        <input class="submitDelete" type="submit" value="&#10006;" />
                    </form>
                </td>
            </tr>
            <?php
        }
    }
    else
    {
        ?>
        <p>Fehler beim Laden der Modules!</p>
        <?php
    }
           
?>