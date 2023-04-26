<?php
    include_once("/xampp/htdocs/OnlineQuiz/Controller/CheckSession.php");
?>

<!DOCTYPE html>
<html>

    <div class="nav-flex-container">


        <div class="nav-titles">
            <div class="nav-item"><a class="nav-title">OnlineQuiz</a></div>
        </div>


        <div class="nav-links">

            <div class="nav-item dropdown">
                <form method="post" action="index.php">
                    <input type="submit" class="nav-link dropbtn" value="Play" />
                </form>
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link dropbtn">Question</a>
                <div class="dropdown dropdown-content">
                    <?php 
                        $outputQuestion = "<form method='post' action='CreateQuestion.php'><input type='submit' class='nav-link drop' value='Create' /></form>" .
                                            "<form method='post' action='ShowQuestion.php'><input type='submit' class='nav-link drop' value='Edit' /></form>";
                        echo $outputQuestion;
                    ?>
                </div>
            </div>

            <?php 
                if($_SESSION['Role'] == "Admin"){
                    $outputModule = "<div class='nav-item dropdown'>" .
                                    "<a class='nav-link dropbtn'>Module</a>" .
                                    "<div class='dropdown dropdown-content'>" .
                                        "<form method='post' action='CreateModule.php'><input type='submit' class='nav-link drop' value='Create' /></form>" .
                                        "<form method='post' action='ShowModule.php'><input type='submit' class='nav-link drop' value='Edit' /></form>" .
                                    "</div>" .
                                "</div>";
                    echo $outputModule;
                }
            ?>

            <?php 
                if($_SESSION['Role'] == "Admin"){
                    $outputModule = "<div class='nav-item dropdown'>" .
                                    "<a class='nav-link dropbtn'>Role</a>" .
                                    "<div class='dropdown dropdown-content'>" .
                                        "<form method='post' action='CreateRole.php'><input type='submit' class='nav-link drop' value='Create' /></form>" .
                                        "<form method='post' action='ShowRole.php'><input type='submit' class='nav-link drop' value='Edit' /></form>" .
                                    "</div>" .
                                "</div>";
                    echo $outputModule;
                }
            ?>

            <div class="nav-item dropdown">
                <a class="nav-link dropbtn">Account</a>
                <div class="dropdown dropdown-content">
                    <?php 
                        if($_SESSION['Role'] == "Admin"){
                            $outputAccount = "<form method='post' action='CreateAccount.php'><input type='submit' class='nav-link drop' value='Create' /></form>" .
                                             "<form method='post' action='ShowAccount.php'><input type='submit' class='nav-link drop' value='Edit' /></form>";
                            echo $outputAccount;
                        }else{
                            $outputAccount = "<form method='post' action='ShowAccount.php'><input type='submit' class='nav-link drop' value='Edit' /></form>";
                            echo $outputAccount;
                        }
                    ?>
                    
                </div>
            </div>

        </div>


        <div class="nav-logout">
            <div class="nav-item">
                <form method="post" action="./Controller/LogoutController.php">
                    <input type="submit" class="nav-link" value="Logout">
                </form>
            </div>
        </div>


    </div>

</html>