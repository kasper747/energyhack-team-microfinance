<?php
header("Content-Type:application/json");
if (isset($_GET['text']) && $_GET['text'] != "" && isset($_GET['number']) && $_GET['number'] != "") {
    include('db.php');
    $text    = $_GET['text'];
    $number = $_GET['number'];
    $result      = mysqli_query($con, "INSERT INTO messages (message, fromNumber) VALUES ('$text', '$number')");
    if ($result === TRUE) {
        $status['type']    = "OK";
        $status['code']    = 200;
		$status['message'] = "Message added into the database.";
        $status['error']   = false;
		
		//$response['status'] = $status;
      
        mysqli_close($con);
    } else {
		$status['type']    = "Not Found";
        $status['code']    = 404;
        $status['message'] = "Message not added into the database.";
        $status['error']   = true;
        
        //$response['status'] = $status;
        //response($response);
    }
} else {
    $status['type']    = "Bad Request";
    $status['code']    = 400;
    $status['message'] = "The parameters are wrong.";
    $status['error']   = true;
    
    //$response['status'] = $status;
    //response($response);
}

$response['status'] = $status;
response($response);

function response($response)
{
    $json_response = json_encode($response);
    echo $json_response;
}
?>