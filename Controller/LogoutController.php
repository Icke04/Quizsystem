<?php

    include_once("/xampp/htdocs/OnlineQuiz/Controller/DataAdapter.php");

    // Session wird beendet
    session_destroy();
    header("LOCATION: ../login.php");

?>