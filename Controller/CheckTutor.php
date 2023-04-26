<?php

    // Angemeldeter User ist Tutor?
    if($_SESSION['Role'] == "Tutor")
    {
        header("LOCATION: ../Index.php");
    }

?>