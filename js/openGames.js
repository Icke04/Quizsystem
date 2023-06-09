
	setInterval(function()
	{
	    $.ajax({
	        type:'GET',
	        url:'../../Controller/GetOpenGameRooms.php',
	        dataType: "json",
	        success: function($result)
        	{
	            $("#openGameRooms").empty();
	            $.each($result, function($i, $item){
        	        $inputIdGameRoom = "<input type='hidden' name='IdGameRoom' value=" + $item[0] + " >";
	                $show = "<div> " + $item[1] + " - " + $item[2] + " <input type='submit' class='playbtn' value='Spielen' /> </div>";
                	$("#openGameRooms").append("<form id=" + $item[0] + " method='post' action='../../Controller/PostGameUser.php'> " + $inputIdGameRoom + " " + $show + " </form>");
            	});
        	},
        		error: function()
        		{
            			$("#openGameRooms").empty();
        		}
    		});
	}, 5000);