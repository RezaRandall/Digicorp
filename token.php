<?php 
    session_start();

    function generateToken($user){
        if(!isset($_SESSION["tokens"][$user]))
        {
            $_SESSION["tokens"][$user] = [];
        }

        $token = bin2hex(random_bytes(16));

        if(count($_SESSION["tokens"][$user]) >= 10){
            array_shift($_SESSION["tokens"][$user]);
        }

        $_SESSION["tokens"][$user][] = $token;
        return implode(", ", $_SESSION["tokens"][$user]);
    }

    function verifyToken($user, $token){
        if(isset($_SESSION["tokens"][$user]))
        {
            $tokens = $_SESSION["tokens"][$user];
            $index = array_search($token, $tokens );
            if($index !== false){
                unset($tokens[$index]);
                $_SESSION["tokens"][$user] = array_values($tokens);
                return true;
            }
        }
        return false;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["action"])){
            $action = $_POST["action"];
            if($action === "generate"){
                if(isset($_POST["user"])){
                    $user = $_POST["user"];
                    echo generateToken($user);
                    exit;
                }
            }
            elseif($action === "verify"){
                if(isset($_POST["user"]) && isset($_POST["token"])){
                    $user = $_POST["user"];
                    $token = $_POST["token"];
                    echo verifyToken($user, $token) ? "true" : "false";
                    exit;
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Generate Token and Verification</h1>
    <h2>Generate Token</h2>
    <form id="generateForm">
        <label for="user">User :</label>
        <input type="text" id="user" name="user" required>
        <button type="button" onclick="generateToken()">Generate Token</button>
    </form>
    <p id="generateToken"></p>

    <h2>Verify Token</h2>
    <form id="verifyForm">
        <label for="verifyUser">User :</label>
        <input type="text" id="verifyUser" name="user" required>
        <label for="token">Token :</label>
        <input type="text" id="token" name="token">
        <button type="button" onclick="verifyToken()">Verify Token</button>
    </form>
    <p id="verificationResult"></p>
</body>
<script>
    function generateToken(){
        var user = document.getElementById("user").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "token.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                document.getElementById("generateToken").innerText = xhr.responseText;
            }
        };
        xhr.send("action=generate&user=" + user);
    }

    function verifyToken(){
        var user = document.getElementById("verifyUser").value;
        var token = document.getElementById("token").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "token.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                document.getElementById("verificationResult").innerText = xhr.responseText;
            }
        };
        xhr.send("action=verify&user=" + user + "&token=" + token);
    }
</script>
</html>