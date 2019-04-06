<?php

header("Content-Type:application/json");

if ( $_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["username"]) ){

    include ('db.php');

	$username = $_GET['username'];

	$status['type'] = "OK";
	$status['code'] = 200;
	$status['message'] = "Database is available.";
	$status['error'] = false;

        $sql = "SELECT SUM(amount) AS total FROM transactions where targetuser='" . $username . "';";
        //echo($sql);
        //echo("<br>");

		$result = mysqli_query($con, $sql);

        $myrow = mysqli_fetch_array($result);

		//echo(implode(",",$myrow));

        $user['balance'] = $myrow['total'];
        $data['user'] = $user;



	$response['status'] = $status;
	$response['data'] = $data;
}else{

	$status['type'] = "Bad Request";
	$status['code'] = 400;
	$status['message'] = "The parameters are wrong.";
	$status['error'] = true;
	$response['status'] = $status;

}

response($response);

function response($response){

    $json_response = json_encode($response);
    echo $json_response;
}

?>

