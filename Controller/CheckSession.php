<?php

    // Läuft eine Session?
    if($_SESSION['IdUser'] == null || $_SESSION['Username'] == null || $_SESSION['Role'] == null)
    {
        session_reset();
        session_abort();
        header('LOCATION: ../Login.php');
    }
    
?>