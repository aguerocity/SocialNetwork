<?php
require_once("FbChatMock.php");

$chat = new FbChatMock();
$messages = $chat->getMessages($_GET["from"]);
$chat_converstaion = array();

if (!empty($messages)) {
  $chat_converstaion[] = '<table>';
  foreach ($messages as $message) {
     $msg = htmlentities($message['message'], ENT_NOQUOTES);
     $user_name = ucfirst($message['f']);
     $sent = $message['send_on'];
      require_once("connection.php");
              $q="select profile_pic from users where username='".strtolower($user_name)."'";
                 if(!$result=$con->query($q))
                   echo $con->error;
                    $row=$result->fetch_assoc();
                     $picname=$row["profile_pic"];
    $chat_converstaion[] = <<<MSG
      <tr class="msg-row-container">
        <td>
          <div class="msg-row">
             <img class="avatar" src='$picname'/>
            <div class="message">
              <span class="user-label"><a href="#" style="color: #6D84B4;">{$user_name}</a> <span class="msg-time">{$sent}</span></span><br/>{$msg}
            </div>
          </div>
        </td>
      </tr>
MSG;
  }
  $chat_converstaion[] = '</table>';
} else {
  echo '<span style="margin-left: 25px;">No chat messages available!</span>';
}

echo implode('', $chat_converstaion);
?>