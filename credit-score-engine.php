<?php

    //TODO:
    //this should be the endpoint to get the credit score for producers and consumers. it should make a JSON
    //with their current credit score and their credit score over time

header("Content-Type:application/json");

if (   isset($_GET['username'])  ) {

    $username = $_GET['username'];

    //credit score / 100
    // (max credit score is 100)
    $data["credit-score"]=50;




    $status['type']    = "OK";
    $status['code']    = 200;
    $status['message'] = "credit score retrieved";
    $status['error']   = false;

    $response["status"]=$status;
    $response["data"]  =$data;

} else {
    $status['type']    = "Bad Request";
    $status['code']    = 400;
    $status['message'] = "The parameters are wrong. 'username' is the parameter";
    $status['error']   = true;

    $response['status'] = $status;
}

response($response);

function response($response)
{
    $json_response = json_encode($response);
    echo $json_response;
}


?>
