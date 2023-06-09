<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Role.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdRole']))
    {
        // Lädt eine Rolle
        $result = getRole($_POST['IdRole']);

        ?>
            <div class="flex-container-form">
                <p>Rolle bearbeiten</p>
                <form method="post" action="../Controller/UpdateRole.php">
                    <input type="hidden" class="inputText" name="IdRole" value="<?php echo $result->getIdRole(); ?>" />
                    <input type="text" class="inputText" name="Role" value="<?php echo $result->getRole(); ?>" />
                    <input type="submit" class="inputSubmit" value="speichern" />
                </form>
                <form method="post" action="../ShowRole.php">
                    <input type="submit" class="inputSubmit" value="zurück" />
                </form>
            </div>
        <?php
    }

?>