<?php

header("Content-Type:application/json");

if ( $_SERVER["REQUEST_METHOD"]=="GET" ){

    include ('db.php');

	$status['type'] = "OK";
	$status['code'] = 200;
	$status['message'] = "Database is available.";
	$status['error'] = false;

    $sql = "SELECT SUM(amount) AS total FROM transactions where targetuser='" . get_default__target_user() . "';";

    //echo($sql);

    $result = mysqli_query($con, $sql);

    $myrow = mysqli_fetch_array($result);

    $user['balance'] = $myrow['total'];
    $data['user'] = $user;

	$response['status'] = $status;
	$response['data'] = $data;
}else{

	$status['type'] = "Bad Request";
	$status['code'] = 400;
	$status['message'] = "must be GET request";
	$status['error'] = true;
	$response['status'] = $status;

}

function get_default__target_user(){
    return "consumer1";
}

response($response);

function response($response){

    $json_response = json_encode($response);
    echo $json_response;
}

?>

