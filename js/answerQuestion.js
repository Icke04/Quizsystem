$counter = 1;
$lastDivId = "";
$('.answer').click(function()
{
    $answerId = $(this).attr('id');
    $answerValue = $(this).text();

    $parentDiv = document.getElementById($answerId).parentNode;
    $parentDiv = document.getElementById($parentDiv.id).parentNode;

    $gameQuestion = $parentDiv.querySelector("input");
    $gameQuestionId = $gameQuestion.value;

    $buttons = $parentDiv.querySelector("button");
    
    if($parentDiv.id != $lastDivId)
    {
        $answer1Id = "#" + $gameQuestion.id + "Answer1";
        $answer1Text = $($answer1Id).text();
        $answer2Id = "#" + $gameQuestion.id + "Answer2";
        $answer2Text = $($answer2Id).text();
        $answer3Id = "#" + $gameQuestion.id + "Answer3";
        $answer3Text = $($answer3Id).text();
        $answer4Id = "#" + $gameQuestion.id + "Answer4";
        $answer4Text = $($answer4Id).text();

        $.ajax({
            dataType: "json",
            type: "POST",
            url: "../Controller/PostAnswer.php",
            data: { IdGameQuestion: $gameQuestionId, Answer: $answerValue },
            success: function($result)
            {
                if($result[0] == $result[1])
                {
                    $("#" + $answerId).addClass('correct');
                }
                else
                {
                    $("#" + $answerId).addClass('wrong');

                    if($answer1Text == $result[0])
                    {
                        $($answer1Id).addClass('correct');
                    }
                    if($answer2Text == $result[0])
                    {
                        $($answer2Id).addClass('correct');
                    }
                    if($answer3Text == $result[0])
                    {
                        $($answer3Id).addClass('correct');
                    }
                    if($answer4Text == $result[0])
                    {
                        $($answer4Id).addClass('correct');
                    }
                }
                
                if($counter < 6)
                {
                    $("#nextBtn").show();
                }
                else
                {
                    $("#submit").show();
                }
            },
            error: function()
            {
                alert("Fehler!");
            }
        });

        $counter++;
    }

    $lastDivId = $parentDiv.id;
});

$("#nextBtn").click(function()
{
    if($counter > 1)
    {
        $oldDivId = "#question" + ($counter - 1);
    }

    $newDivId = "#question" + ($counter);

    $($oldDivId).hide();
    $($newDivId).show();
    $("#nextBtn").hide();
});