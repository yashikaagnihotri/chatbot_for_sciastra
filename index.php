<?php
date_default_timezone_set('Asia/Kolkata');
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>SciAstra Chatbot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@300&family=Nunito:wght@300;400&family=Quicksand:wght@300;400&family=Raleway&family=Roboto+Slab&family=Shantell+Sans:wght@300&family=Wix+Madefor+Display&display=swap" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-5">
                <!-- CHATBOT -->
                <div class="card">
                    <div class="card-body messages-box">
                        <ul class="list-unstyled messages-list">
                            <?php
							$res=mysqli_query($con,"select * from message");
							if(mysqli_num_rows($res)>0){
								$html='';
								while($row=mysqli_fetch_assoc($res)){
									$message=$row['message'];
									$added_on=$row['added_on'];
									$strtotime=strtotime($added_on);
									$time=date('h:i A',$strtotime);
									$type=$row['type'];
									if($type=='user'){
										$class="messages-me";
										$imgAvatar="user_img.jpg";
										$name="Me";
									}else{
										$class="messages-you";
										$imgAvatar="bot_img.png";
										$name="SciAstra";
									}
									$html.='<li class="'.$class.' clearfix"><span class="message-img"><img src="image/'.$imgAvatar.'" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">'.$name.'</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">'.$time.'</span></small> </div><p class="messages-p">'.$message.'</p></div></li>';
								}
								echo $html;
							}else{
								?>
								<li class="messages-me clearfix start_chat">
                                <img src="image/bot_img.png" class="avatar-sm rounded-circle">
                                Any Queries?
								</li>
								<?php
							}
							?>

                        </ul>
                    </div>
                    <div class="card-header">
                        <div class="input-group">
                            <input id="input-me" type="text" name="messages" class="form-control input-sm"
                                placeholder="Type your message..." />
                            <span class="input-group-append">
                                <input type="button" class="btn send-btn" value="Send" onclick="send_msg()">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function getCurrentTime() {
            var now = new Date();
            var hh = now.getHours();
            var min = now.getMinutes();
            var ampm = (hh >= 12) ? 'PM' : 'AM';
            hh = hh % 12;
            hh = hh ? hh : 12;
            hh = hh < 10 ? '0' + hh : hh;
            min = min < 10 ? '0' + min : min;
            var time = hh + ":" + min + " " + ampm;
            return time;
        }
        function send_msg() {
            jQuery('.start_chat').hide();
            var txt = jQuery('#input-me').val();
            var html = '<li class="messages-me clearfix"><span class="message-img"><img src="image/user_img.jpg" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Me</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + txt + '</p></div></li>';
            jQuery('.messages-list').append(html);
            jQuery('#input-me').val('');
            if (txt) {
                jQuery.ajax({
                    url: 'connect_ques_table.php',
                    type: 'post',
                    data: 'txt=' + txt,
                    success: function (result) {
                        var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p">' + result + '</p></div></li>';
                        var resultString = result.toString();
                            if(resultString === "https://www.sciastra.com/courses/"){
                                var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p"><a style="cursor:pointer; color:white;" href="https://www.sciastra.com/courses/">' + result + '</a></p></div></li>';
                            }
                            if(resultString === "https://www.sciastra.com/selections/"){
                                var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p"><a style="cursor:pointer; color:white;" href="https://www.sciastra.com/selections/">' + result + '</a></p></div></li>';
                            }
                            if(resultString === "https://www.sciastra.com/blog/"){
                                var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p"><a style="cursor:pointer; color:white;" href="https://www.sciastra.com/blog/">' + result + '</a></p></div></li>';
                            }
                            if(resultString === "https://www.sciastra.com/materials/"){
                                var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p"><a style="cursor:pointer; color:white;" href="https://www.sciastra.com/materials/">' + result + '</a></p></div></li>';
                            }
                            if(resultString === "https://www.sciastra.com/teams/"){
                                var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p"><a style="cursor:pointer; color:white;" href="https://www.sciastra.com/teams/">' + result + '</a></p></div></li>';
                            }
                            if(resultString === "https://www.sciastra.com/contact/"){
                                var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p"><a style="cursor:pointer; color:white;" href="https://www.sciastra.com/contact/">' + result + '</a></p></div></li>';
                            }
                            if(resultString === "https://www.sciastra.com/app/"){
                                var html = '<li class="messages-you clearfix"><span class="message-img"><img src="image/bot_img.png" class="avatar-sm rounded-circle"></span><div class="message-body clearfix"><div class="message-header"><strong class="messages-title">Chatbot</strong> <small class="time-messages text-muted"><span class="fas fa-time"></span> <span class="minutes">' + getCurrentTime() + '</span></small> </div><p class="messages-p"><a style="cursor:pointer; color:white;" href="https://www.sciastra.com/app/">' + result + '</a></p></div></li>';
                            }
                        jQuery('.messages-list').append(html);
                        jQuery('.messages-box').scrollTop(jQuery('.messages-box')[0].scrollHeight);
                    }
                });
            }
        }
    </script>
</body>

</html>