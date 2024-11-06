<?php 
$message = $_GET['message'];
$title = $_GET['title'];
$token = $_GET['token'];

function send_notification ($tokens, $message_complete)
{
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'registration_ids' => $tokens,
        'notification' => $message_complete
    );

    $headers = array(
        'Authorization:key = KKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK', //Change API KEY HERE
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    
    $result = curl_exec($ch);           

    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

$tokens = array($token);
$message_complete = array("body" => $message, "title" => $title);
$message_status = send_notification($tokens, $message_complete);
echo $message_status;
?>
