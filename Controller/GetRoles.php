<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Role.php");

    // Lädt alle Rollen
    $roles = getRoles();

    // Kein Error und Daten vorhanden?
    if(!($roles[0]->getIsError()) && $roles[0]->getDataAvailable())
    {
        // Rollen werden iteriert
        foreach($roles as $role)
        {
            ?>
            <tr>
                <td><?php echo $role->getRole(); ?></td>
                <td>
                    <form method="post" action="../EditRole.php">
                        <input type="hidden" name="IdRole" value="<?php echo $role->getIdRole(); ?>" />
                        <input type="hidden" name="Role" value="<?php echo $role->getRole(); ?>" />
                        <input class="submitEdit" type="submit" value="&#9881;" />
                    </form>
                </td>
                <td>
                    <form method="post" action="../Controller/DeleteRole.php">
                        <input type="hidden" name="IdRole" value="<?php echo $role->getIdRole(); ?>" />
                        <input type="hidden" name="Role" value="<?php echo $role->getRole(); ?>" />
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
        <p>Fehler beim Laden der Rollen!</p>
        <?php
    }
    
?>