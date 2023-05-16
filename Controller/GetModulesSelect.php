<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");
    include_once("/xampp/htdocs/OnlineQuiz/Models/Module.php");

    // Lädt alle Modules
    $modules = getModules();

    // Kein Error und Daten vorhanden?
    if(!($modules[0]->getIsError()) && $modules[0]->getDataAvailable())
    {
        // Iteriert durch alle Module
        foreach($modules as $module)
        {
            ?>
            <option value="<?php echo $module->getIdModule(); ?>"><?php echo $module->getFullDesignation(); ?></option>
            <?php
        }
    }
    else
    {
        ?>
        <p>Fehler beim Laden der Modules!</p>
        <?php
    }

?>