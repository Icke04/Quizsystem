<?php
    
    // Angemeldeter User ist Admin?
    if($_SESSION['Role'] == "Admin")
    {
        header("LOCATION: ../Index.php");
    }

?>