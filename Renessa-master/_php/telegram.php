<?php
function sendMessage($message, $only_ivan = false){
  $telegram_token = 'ID1:ID2';

  $message = str_replace("\n","%0a", $message);
  if($only_ivan){
    // IVAN TELEGRAM GROUP
    $chat_id = '-51676';
  } else {
    // FABER TELEGRAM GROUP
    $chat_id = '-xxxxxx';
  }
  $parameters = "parse_mode=html&chat_id=$chat_id&text=$message";
  $url = "https://api.telegram.org/bot$telegram_token/sendMessage?$parameters";
  
  $result = file_get_contents($url);
  //echo($url);
  //$result = json_decode($result, true);
  /*
  foreach ($result['result'] as $message) {
      var_dump($message);
  }
  */
  
}
?>