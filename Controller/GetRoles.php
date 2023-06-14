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
	    $usersForRole = getUsersByRole($role->getIdRole());
            ?>
            <tr>
                <td data-label="Rolle"><?php echo $role->getRole(); ?></td>
		<?php
		if($usersForRole[0]->getDataAvailable())
	    	{
		?>
                	<td data-label="bearbeiten">
                    		Nicht möglich
                	</td>
                	<td data-label="löschen">
                    		Nicht möglich
                	</td>
		<?php
		}
		else
		{
		?>
			<td data-label="bearbeiten">
                    		<form method="post" action="../EditRole.php">
                        		<input type="hidden" name="IdRole" value="<?php echo $role->getIdRole(); ?>" />
                        		<input type="hidden" name="Role" value="<?php echo $role->getRole(); ?>" />
                        		<input class="submitEdit" type="submit" value="&#9881;" />
                    		</form>
                	</td>
                	<td data-label="löschen">
                    		<form method="post" action="../Controller/DeleteRole.php">
                        		<input type="hidden" name="IdRole" value="<?php echo $role->getIdRole(); ?>" />
                        		<input type="hidden" name="Role" value="<?php echo $role->getRole(); ?>" />
                        		<input class="submitDelete" type="submit" value="&#10006;" />
                    		</form>
                	</td>
		<?php
		}
		?>
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