<?php 
//COUNT FREQUECT CHAR
    function countMostFrequentCharacter($word)
    {
        $charCount = [];
        for($i = 0; $i < strlen($word); $i++)
        {
            $char = $word[$i];
            if(!isset($charCount[$char]))
            {
                $charCount[$char] = 1;
            }
            else
            {
                $charCount[$char]++;
            }
        }

        $mostFrequentChar = "";
        $maxCount = 0;
        foreach($charCount as $char => $count)
        {
            if($count > $maxCount)
            {
                $mostFrequentChar = $char;
                $maxCount = $count;
            }
        }
        return "$mostFrequentChar $maxCount" . "x";
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["word"]))
        {
            $word = $_POST["word"];
            $result = countMostFrequentCharacter($word);
        }
    }

    // SECOND LARGEST NUMBER
    function secondLargestNumber($arr)
    {
        if (!empty($arr)) { 
            rsort($arr);
            return $arr[1];
        } else {
            return "Array kosong";
        }
    }

    $resultLargestSecondNumber = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["number"]))
        {
            $numbers = explode(',', $_POST["number"]);

            $numbers = array_filter($numbers, function($val){
                return is_numeric($val);
            });
        }
        if (isset($numbers)) { 
            $resultLargestSecondNumber = secondLargestNumber($numbers);
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
<h1>Soal No 5</h1>
    <p>Menghitung karakter mana yang kemunculannya paling banyak dalam suatu kata</p>
    <form action="" method="POST">
        <label for="word">Kata:</label>
        <input type="text" id="word" name="word" required><br>
        <button type="submit">Check karakter yang sama</button>
    </form>
    <p>Hasil karakter yang sama: 
        <?php if($_SERVER["REQUEST_METHOD"] == "POST" && isset($result)) echo $result; ?>
    </p>
    <br>

    <h1>Soal No 4</h1>
    <p>Mendapatkan nilai terbesar kedua</p>
    <form action="" method="POST">
        <label for="number"></label>
        <input type="text" id="number" name="number" required>
        <button type="submit">Check nilai terbesar kedua</button>
    </form>
    <p>Hasil nilai terbesar kedua: 
        <?php if($_SERVER["REQUEST_METHOD"] == "POST" && isset($resultLargestSecondNumber)) echo  $resultLargestSecondNumber; ?>
    </p>
    <br>



</body>

</html>
