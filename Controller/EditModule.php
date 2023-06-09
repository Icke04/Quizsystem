<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/IsTutor.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdModule']))
    {
        // Lädt ein Module
        $module = getModule($_POST['IdModule']);

        $getRole = getRoleByName("Tutor");
        // Lädt alle User, die Tutor sind
        $users = getUsersByRole($getRole->getIdRole());
        // Lädt alle Tutoren eines Modules
        $tutors = getIsTutorByModule($module->getIdModule());

        ?>
            <div class="flex-container-form">
                <p>Modul bearbeiten</p>
                <form method="post" action="../Controller/UpdateModule.php">
                    <input type="hidden" class="inputText" name="IdModule" value="<?php echo $module->getIdModule(); ?>" />
                    <input type="text" class="inputText" name="Abbreviation" value="<?php echo $module->getAbbreviation(); ?>" />
                    <input type="text" class="inputText" name="FullDesignation" value="<?php echo $module->getFullDesignation(); ?>" />
                    <input type="submit" class="inputSubmit" value="bearbeiten" />
                </form>
                <form method="post" action="../ShowModule.php">
                    <input type="submit" class="inputSubmit" value="zurück" />
                </form>
            </div>
            <div class="flex-container-form">
                <p>Tutoren bearbeiten</p>
                <form method="post" action="../Controller/UpdateIsTutor.php">

                    <input type="hidden" name="IdModule" value="<?php echo $module->getIdModule(); ?>"/>

                    <?php
                    // Alle User werden iteriert
                    foreach($users as $user)
                    {
                        // Alle Tutoren des Modules werden iteriert
                        foreach($tutors as $tutor)
                        {
                            // UserId == TutorId?
                            if($tutor->getIdUser() == $user->getIdUser())
                            {
                                $isTutor = true;
                                break;
                            }
                            else
                            {
                                $isTutor = false;
                            }
                        }

                        // User ist Tutor des Modules?
                        if($isTutor)
                        {
                            ?>
                                <div class="input-list">
                                    <input id="<?php echo $user->getUsername(); ?>" type="checkbox" name="user[]" value="<?php echo $user->getIdUser(); ?>" checked />
                                    <label for="<?php echo $user->getUsername(); ?>"><?php echo $user->getUsername(); ?></label>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                                <div class="input-list">
                                    <input id="<?php echo $user->getUsername(); ?>" type="checkbox" name="user[]" value="<?php echo $user->getIdUser(); ?>" />
                                    <label for=""<?php echo $user->getUsername(); ?>><?php echo $user->getUsername(); ?></label>
                                </div>
                            <?php
                        }
                    }
                    ?>
                    <input type="submit" class="inputSubmit margin" value="bearbeiten" />
                </form>
                <form method="post" action="../ShowModule.php">
                    <input type="submit" class="inputSubmit" value="zurück" />
                </form>
            </div>
        <?php
    }

?>



