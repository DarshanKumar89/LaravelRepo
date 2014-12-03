<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $room_name }}Room Chat</title>
    <style type="text/css">
    .chatContainer
    {
      
    }
    </style>
  </head>
  <body>
    <h1>Chat UI</h1>
    <div class="chatContainer">
      
    </div>
    <ul class="chatWindow">
      
    </ul>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      Pusher.log = function(message) {
          if (window.console && window.console.log) {
            window.console.log(message);
          }
        };

        var pusher = new Pusher('bd51255b63e4d2408538');
        var channel = pusher.subscribe('{{ $room_id}}');
        channel.bind('message', function(data) {
          Notify(data,'{{ $room_id }}');
        });
        function Notify(chatData,room)
        {
            $('ul.chatWindow').append('<li><span class="chatWindow__userTime"><span class="chatWindow__username"><strong>'+chatData.from_name+'</strong>:</span><span class="chatWindow__chattime">'+' '+'</span></span><span class="chatWindow__chattext">'+chatData.message+'</span></li>');
            $(".content__chatWindow").animate({ scrollTop: $('ul.chatWindow'+room).height() },500);
        }
    </script>
  </body>
</html>