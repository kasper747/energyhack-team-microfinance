<html>

<body>
<?php

    //TODO: deliver the .html that contains the vue.js stuff for our main page
    echo("hello");
    if( isset($_COOKIE["username"] ){
        echo("logged in as: " . $_COOKIE["username"] );
    }else{
        echo("Not Logged in ");
    }
?>


<p>LOGIN/ Change User</p>

<form method="POST" action="/login.php">
    <select name="username">
        <option>Consumer1</option>
        <option>Consumer1</option>
    </select>
    <button type="submit">Login</button>
</form>

</body>
</html>