isSingleplayer = "<?php echo $_SESSION['IsSingleplayer']; ?>";
//if(isSingleplayer == 0 || isSingleplayer == false)
//{
    setInterval(function()
    {
        if($("#opponentsPoints").text() == "")
        {
            $.ajax({
                type:'GET',
                dataType: 'json',
                url:'../../Controller/GetOpponentsGamePoints.php',
                success:function($result)
                {
                    $correct = 0;
                    $answeredQuestions = 0;
                    $.each($result, function($i, $item){
                        if($result[$i][1] == true)
                        {
                            $("#" + $result[$i][0]).addClass("green");
                            $("#" + $result[$i][0]).text("Richtig");
                            $correct++;
                            $answeredQuestions++;
                        }
                        else if($result[$i][1] == "open")
                        {
                            $("#" + $result[$i][0]).text("");
                        }
                        else if($result[$i][1] == false)
                        {
                            $("#" + $result[$i][0]).addClass("red");
                            $("#" + $result[$i][0]).text("Falsch");
                            $answeredQuestions++;
                        }
                    });

                    if($answeredQuestions == 5)
                    {
                        $("#opponentsPoints").text($correct);
                        $ownPoints = $("#ownPoints").text();

                        if($ownPoints > $correct)
                        {
                            $("#result").text("Du hast gewonnen!");
                        }
                        else if($ownPoints < $correct)
                        {
                            $("#result").text("Der Gegner hat gewonnen!");
                        }
                        else if($ownPoints == $correct)
                        {
                            $("#result").text("Untentschieden!");
                        }
                    }
                }
            });
        }

    }, 2000);
//}