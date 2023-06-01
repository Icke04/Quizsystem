<?php

    if(isset($_SESSION['IsSingleplayer']))
    {
        unset($_SESSION['IsSingleplayer']);
    }

    if(isset($_SESSION['IdGameRoom']))
    {
        unset($_SESSION['IdGameRoom']);
    }

    if(isset($_SESSION['IdGameUser']))
    {
        unset($_SESSION['IdGameUser']);
    }

?>