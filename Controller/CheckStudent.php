<?php
    
    // Angemeldeter User ist Student?
    if($_SESSION['Role'] == "Student")
    {
        header("LOCATION: ../Index.php");
    }

?>