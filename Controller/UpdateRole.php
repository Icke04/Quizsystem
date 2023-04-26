<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Role.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdRole']) && isset($_POST['Role']) && $_POST['IdRole'] != 0 && $_POST['Role'] != "")
    {
        // Role updaten
        $Role = new Role(intval($_POST['IdRole']), $_POST['Role'], false, "", true);
        $role = updateRole($Role);

        // Kein Error und Daten vorhanden?
        if(!($role->getIsError()) && $role->getDataAvailable())
        {
            header("LOCATION: ../ShowRole.php");
        }
        else
        {
            ?>
            <p>Fehler beim Updaten der Rolle!</p>
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