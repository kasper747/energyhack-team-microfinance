<?php
header("Content-Type:application/json");

if (isset($_GET['text']) && $_GET['text'] != "" && isset($_GET['number']) && $_GET['number'] != "")
	{
	include ('db.php');

	$text = $_GET['text'];
	$number = $_GET['number'];
	$result = mysqli_query($con, "INSERT INTO messages (message, fromNumber) VALUES ('$text', '$number')");
	if ($result === TRUE)
		{

		//TODO: insert block into factum blockchain.
		//insert_block_into_factum($block_contents_json);

		$status['type'] = "OK";
		$status['code'] = 200;
		$status['message'] = "Message added into the database.";
		$status['error'] = false;

		insert_block_into_factum("{'test':'3'}");
		$status['message'] .= " and block added to chain";

		// $response['status'] = $status;

		mysqli_close($con);
		}
	  else
		{
		$status['type'] = "Not Found";
		$status['code'] = 404;
		$status['message'] = "Message not added into the database.";
		$status['error'] = true;

		// $response['status'] = $status;
		// response($response);

		}
	}
  else
	{
	$status['type'] = "Bad Request";
	$status['code'] = 400;
	$status['message'] = "The parameters are wrong.";
	$status['error'] = true;

	// $response['status'] = $status;
	// response($response);

	}

$response['status'] = $status;
response($response);

function response($response)
	{
	$json_response = json_encode($response);
	echo $json_response;
	}

function insert_block_into_factum($block_contents_json){


    $request = new HttpRequest();
    $request->setUrl('https://ephemeral.api.factom.com/v1/chains/086c905173fa90fa1809741f2a0febc0aeea0a058454167973036f04e590218a/entries');
    $request->setMethod(HTTP_METH_POST);

    $request->setHeaders(array(
      'Postman-Token' => '746ae812-7801-45b7-ba0f-f8e405d5c794',
      'cache-control' => 'no-cache',
      'app_key' => '2b9eee51f459412508c07cf853eb939f',
      'app_id' => 'd01acae3',
      'Content-Type' => 'application/json'
    ));

    $request->setBody('{
        "external_ids":["RW5lcmd5TWljcm9DcmVkaXRz"],
        "content":base64_encode($block_contents_json);
    }');

    try {
      $response = $request->send();

      echo $response->getBody();
    } catch (HttpException $ex) {
      echo $ex;
    }
}

?>