<?php 
session_start();

function getNextTrafficColor()
{
    $colors = ["Merah", "Kuning", "Hijau"];
    if(!isset($_SESSION["trafficCollor"]))
    {
        $_SESSION["trafficCollor"] = 0;
    }
    else
    {
        $_SESSION["trafficCollor"] = ($_SESSION["trafficCollor"] + 1) % count($colors);
    }
    return $colors[$_SESSION["trafficCollor"]];
}

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    echo getNextTrafficColor();
    exit;
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
    <h1>Soal no 3</h1>
    <p>TRAFFIC LIGHT</p>
    <button onclick="changeColor()">Rubah Warna Lalu Lintas </button>
    <p>Hasil warna lalu lintas : <span id="trafficCollor"></span></p>
</body>

<script>
    function changeColor()
    {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "traffic.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4 && xhr.status == 200)
            {
                document.getElementById("trafficCollor").innerText = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>
</html>