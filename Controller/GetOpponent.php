<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameUser.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    $result = array();

    if(isset($_SESSION['IdGameRoom']))
    {
        // Lädt alle GameUser
        $gameUsers = getGameUserByGame($_SESSION['IdGameRoom']);

        // Kein Error und Daten vorhanden?
        if(!($gameUsers[0]->getIsError()) && $gameUsers[0]->getDataAvailable())
        {
            foreach($gameUsers as $gameUser)
            {
                if($gameUser->getIdUser() != $_SESSION['IdUser'])
                {
                    $user = getUser($gameUser->getIdUser());

                    if(!($user->getIsError()) && $user->getDataAvailable())
                    {
                        $result[] = $user->getUsername();
                    }
                }
            }
        }
    }
    
    echo json_encode($result);

?>