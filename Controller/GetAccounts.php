<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    // Lädt alle User
    $result = getUsers();

    // Kein Error und Daten vorhanden?
    if(!($result[0]->getIsError()) && $result[0]->getDataAvailable())
    {
        // User werden iteriert
        foreach($result as $user)
        {
            $pw = "*******";

            $getRole = getRole($user->getIdRole());

            // User ist Admin?
            if($_SESSION['Role'] == "Admin")
            {
                ?>
                    <tr>
                        <td><?php echo $user->getUsername(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td><?php echo $pw; ?></td>
                        <td><?php echo $getRole->getRole(); ?></td>
                        <td>
                            <form method="post" action="../EditAccount.php">
                                <input type="hidden" name="IdUser" value="<?php echo $user->getIdUser(); ?>" />
                                <input type="hidden" name="Username" value="<?php echo $user->getUsername(); ?>" />
                                <input type="hidden" name="Email" value="<?php echo $user->getEmail(); ?>" />
                                <input type="hidden" name="IdRole" value="<?php echo $user->getIdRole(); ?>" />
                                <input class="submitEdit" type="submit" value="&#9881;" />
                            </form>
                        </td>
                        <td>
                            <form method="post" action="../Controller/DeleteAccount.php">
                                <input type="hidden" name="IdUser" value="<?php echo $user->getIdUser(); ?>" />
                                <input type="hidden" name="Username" value="<?php echo $user->getUsername(); ?>" />
                                <input type="hidden" name="Email" value="<?php echo $user->getEmail(); ?>" />
                                <input type="hidden" name="IdRole" value="<?php echo $user->getIdRole(); ?>" />
                                <input class="submitDelete" type="submit" value="&#10006;" />
                            </form>
                        </td>
                    </tr>
                <?php
            }
            else
            {
                // Meine Userdaten?
                if($user->getIdUser() == $_SESSION['IdUser'])
                {
                    ?>
                        <td><?php echo $user->getUsername(); ?></td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td><?php echo $pw; ?></td>
                        <td><?php echo $getRole->getRole(); ?></td>
                        <td>
                            <form method="post" action="../EditAccount.php">
                                <input type="hidden" name="IdUser" value="<?php echo $user->getIdUser(); ?>" />
                                <input type="hidden" name="Username" value="<?php echo $user->getUsername(); ?>" />
                                <input type="hidden" name="Email" value="<?php echo $user->getEmail(); ?>" />
                                <input type="hidden" name="IdRole" value="<?php echo $user->getIdRole(); ?>" />
                                <input class="submitEdit" type="submit" value="&#9881;" />
                            </form>
                        </td>
                        <td></td>
                    <?php
                }
            }
        }
    }
    else
    {
        ?>
        <p>Fehler beim Laden der Accounts!</p>
        <?php
    }

?>