<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Chat.php");

    // Lädt alle Chats
    $result = getChats();

    // Kein Error und Daten vorhanden?
    if(!($result[0]->getIsError()) && $result[0]->getDataAvailable())
    {
        // Nachrichten werden iteriert
        foreach($result as $message)
        {
            ?>
            <div class="ChatMessages"><?php echo $message->getUsername(); ?> schreibt: <?php echo $message->getMessage(); ?></div>
            <?php
        }
    }
    else
    {
        ?>
        <p>Fehler beim Laden der Nachrichten!</p>
        <?php
    }

?>