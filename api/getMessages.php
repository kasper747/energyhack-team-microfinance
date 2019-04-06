<?php
header("Content-Type:application/json");

if (isset($_GET['id']) && $_GET['id'] != "")
	{
	include ('db.php');

	$en_id = $_GET['id']; //entered email
	$status['type'] = "OK";
	$status['code'] = 200;
	$status['message'] = "Database is available.";
	$status['error'] = false;
	if ($en_id == - 1)
		{
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
	  else
		{
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

	$response['status'] = $status;
	$response['data'] = $data;
	}
  else
	{
	$status['type'] = "Bad Request";
	$status['code'] = 400;
	$status['message'] = "The parameters are wrong.";
	$status['error'] = true;
	$response['status'] = $status;

	// response($response);

	}

response($response);

function response($response)
	{
	$json_response = json_encode($response);
	echo $json_response;
	}

?>
