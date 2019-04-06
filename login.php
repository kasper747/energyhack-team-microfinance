<?php
    //TODO: make a POST endpoint here to change the 'user' cookie to one of the predefined users
    //depending on the parameters
    if( $_SERVER['REQUEST_METHOD']=="POST" ){

        header("Location: /index.php");
    }else{
        echo("use POST");
    }
?>