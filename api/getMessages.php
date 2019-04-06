<?php
include ('db.php');

header("Content-Type:application/json");

if (isset($_GET['id']) && $_GET['id'] != "")
	{
	$en_id = $_GET['id'];
	$status['type'] = "OK";
	$status['code'] = 200;
	$status['message'] = "Database is available.";
	$status['error'] = false;
	$result = mysqli_query($con, "SELECT * FROM `messages` WHERE id='$en_id'");
	if (mysqli_num_rows($result) > 0)
		{
		$row = mysqli_fetch_array($result);
		$user['id'] = $row['id'];
		$user['message'] = $row['message'];
		$user['fromNumber'] = $row['fromNumber'];
		$currentuser[1] = $user;
		$data['user'] = $currentuser;
		}
	}
elseif (isset($_GET['number']) && $_GET['number'] != "")
	{
	$en_number = $_GET['number'];
	$status['type'] = "OK";
	$status['code'] = 200;
	$status['message'] = "Database is available.";
	$status['error'] = false;
	$result = mysqli_query($con, "SELECT * FROM `messages` WHERE fromNumber='$en_number'");
	$count = 0;
	foreach($result as $row)
		{
		$user['id'] = $row['id'];
		$user['message'] = $row['message'];
		$user['fromNumber'] = $row['fromNumber'];
		$currentuser[$count] = $user;
		$data['user'] = $currentuser;
		$count+= 1;
		}
	}
  else
	{
	$status['type'] = "OK";
	$status['code'] = 200;
	$status['message'] = "Database is available.";
	$status['error'] = false;
	$result = mysqli_query($con, "SELECT * FROM `messages`");
	$count = 0;
	foreach($result as $row)
		{
		$user['id'] = $row['id'];
		$user['message'] = $row['message'];
		$user['fromNumber'] = $row['fromNumber'];
		$currentuser[$count] = $user;
		$data['user'] = $currentuser;
		$count+= 1;
		}
	}

$response['status'] = $status;
$response['data'] = $data;
response($response);

function response($response)
	{
	$json_response = json_encode($response);
	echo $json_response;
	}

?>