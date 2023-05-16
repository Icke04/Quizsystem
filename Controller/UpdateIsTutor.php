<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/IsTutor.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    // Post-Variable befüllt?
    if(isset($_POST['user']) && isset($_POST['IdModule']) && $_POST['IdModule'] != 0)
    {
        // Checked User iterieren
        foreach($_POST['user'] as $userIsChecked)
        {
            // Lädt alle Tutoren des Modules
            $getIsTutor = getIsTutorByUserAndModule(intval($userIsChecked), intval($_POST['IdModule']));
            
            // IsTutor Eintrag existiert noch nicht?
            if($getIsTutor->getIdUser() == 0)
            {
                // IsTutor posten
                $IsTutor = new IsTutor(intval($userIsChecked), intval($_POST['IdModule']), false, "", true);
                $Result = postIsTutor($IsTutor);
            }
        }
        
        $getRole = getRoleByName("Tutor");
        // Alle User, die Tutor sind laden
        $users = getUsersByRole($getRole->getIdRole());

        // Kein Error und Daten vorhanden?
        if(!($users[0]->getIsError()) && $users[0]->getDataAvailable())
        {
            // Alle Tutoren iterieren
            foreach($users as $user)
            {
                // Lädt welche User bei ausgewähltem Module Tutor sind
                $getIsTutor = getIsTutorByUserAndModule(intval($user->getIdUser()), intval($_POST['IdModule']));

                // IsTutor Eintrag vorhanden?
                if($getIsTutor->getIdUser() != 0)
                {
                    // Checked User iterieren
                    foreach($_POST['user'] as $userIsChecked)
                    {
                        // UserId des Tutors ungleich des checkedUsers?
                        if($user->getIdUser() != $userIsChecked)
                        {
                            $unchecked = true;
                        }
                        else
                        {
                            $unchecked = false;
                            break;
                        }
                    }

                    // Wurde der User unchecked?
                    if($unchecked)
                    {
                        // IsTutor löschen
                        $IsTutor = new IsTutor(intval($user->getIdUser()), intval($_POST['IdModule']), false, "", true);
                        $Result = deleteIsTutor($IsTutor);
                    }
                }
            }
            
            header("LOCATION: ../ShowModule.php");
        }
        else
        {
            ?>
            <p>Fehler beim Laden der User!</p>
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