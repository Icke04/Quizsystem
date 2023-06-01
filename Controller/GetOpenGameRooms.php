<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameRoom.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/GameUser.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/User.php");

    // Lädt alle Spielräume
    $gameRooms = getGameRooms();

    // Kein Error und Daten vorhanden?
    if(!($gameRooms[0]->getIsError()) && $gameRooms[0]->getDataAvailable())
    {
        $resultArray = array();

        // Iteriert durch Spielräume
        foreach($gameRooms as $gameRoom)
        {
            // Spielraum ist Multiplayer?
            if($gameRoom->getIsSingleplayer() == false || $gameRoom->getIsSingleplayer() == 0)
            {
                // Lädt alle Spieler
                $gameUsers = getGameUserByGame($gameRoom->getIdGameRoom());
                
                // Kein Error und Daten vorhanden?
                if(!($gameUsers[0]->getIsError()) && $gameUsers[0]->getDataAvailable())
                {
                    // Ein Spieler im Spielraum?
                    if(count($gameUsers) == 1)
                    {
                        // Lädt Module
                        $module = getModule($gameRoom->getIdModule());

                        // Kein Error und Daten vorhanden?
                        if(!($module->getIsError()) && $module->getDataAvailable())
                        {
                            // Lädt Gegner
                            $user = getUser($gameUsers[0]->getIdUser());
        
                            // Kein Error und Daten vorhanden?
                            if(!($user->getIsError()) && $user->getDataAvailable())
                            {
                                // UserId ungleich Meiner?
                                if($user->getIdUser() != $_SESSION['IdUser'])
                                {
                                    $resultArray[] = array($gameRoom->getIdGameRoom(), $module->getFullDesignation(), $user->getUsername());
                                }
                            }
                            else
                            {
                                // User konnte nicht geladen werden
                            }
                        }
                        else
                        {
                            // Module konnte nicht geladen werden
                        }
                    }
                    else
                    {
                        // Lobby bereits voll
                    }
                }
                else
                {
                    // Keine Spieler vorhanden
                }
            }
        }
    }
    else
    {
        // Keine GameRooms vorhanden
    }

    echo json_encode($resultArray);

?>