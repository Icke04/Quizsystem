$(document).ready(function() {
    $("#newMessage").keyup(function(e) {
        if(e.keyCode == 13){
            $.ajax({
                type:'POST',
                url:'../../Controller/PostMessage.php',
                data:{Username:$("#Username").val(),Message:$("#newMessage").val()},
                success:function(){
                    $("#newMessage").val("");
                }
            })
        }
    })

    setInterval(function(){
        $("#messages").load("../../Controller/GetMessages.php");
	var messageBody = document.querySelector('#messages');
	messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
    }, 500)
    $("#messages").load("../../Controller/GetMessages.php");

});