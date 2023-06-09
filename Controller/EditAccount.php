<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Role.php");

    // Post-Variable befüllt?
    if(isset($_POST['IdUser']))
    {
        // Lädt UserDaten für einen User
        $user = getUser($_POST['IdUser']);
        // Lädt alle Rollen
        $roles = getRoles();

        ?>
            <div class="flex-container-form">
                <p>Account bearbeiten</p>
                <form method="post" action="../Controller/UpdateAccount.php">
                    <input type="hidden" class="inputText" name="IdUser" value="<?php echo $user->getIdUser(); ?>" />
                    <input type="text" class="inputText" name="Username" value="<?php echo $user->getUsername(); ?>" />
                    <input type="text" class="inputText" name="Email" value="<?php echo $user->getEmail(); ?>" />
                    <input type="password" class="inputText" name="Password" value="<?php echo $user->getPassword(); ?>" />

                    <?php
                    // Rolle = Admin?
                    if($_SESSION['Role'] == "Admin")
                    {
                        ?>
                            <select class="select" name="IdRole">
                            <?php
                                // Rollen iterieren
                                foreach($roles as $role)
                                {
                                    // Ausgewählte Rolle des Users?
                                    if($role->getIdRole() == $user->getIdRole())
                                    {
                                        ?>
                                            <option value="<?php echo $role->getIdRole(); ?>" selected><?php echo $role->getRole(); ?></option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value="<?php echo $role->getIdRole(); ?>"><?php echo $role->getRole(); ?></option>
                                        <?php
                                    }
                                }
                            ?>
                            </select>
                        <?php
                    }
                    ?>
                    
                    <input type="submit" class="inputSubmit" value="speichern" />
                </form>
                <form method="post" action="../ShowAccount.php">
                    <input type="submit" class="inputSubmit" value="zurück" />
                </form>
            </div>
        <?php
    }

?>