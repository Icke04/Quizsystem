var isSingleplayer = $("#isSingleplayer").val();

if(isSingleplayer == false || isSingleplayer == 0)
{
    $("#start").hide();
    setInterval(function() 
    {
        $.ajax({
        type:'GET',
        url:'../../Controller/GetOpponent.php',
        dataType: "json",
        success: function($result)
        {
            if($result[0] != null)
            {
                $("#start").show();
                $("#delete").hide();
                $("#opponent").text($result[0] + " ist dem Spiel beigetreten!");
            }
        }
    });
    }, 2000);
}