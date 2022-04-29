<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity 4: Perfect Palindrome</title>
</head>
<body>
    <h1>Perfect Palindrome</h1>

    <?php
     $Palindrome = array(
        "racecar",
        "Madam, I'm Adam",
        "Mitsubishi",
        "Borrow or rob?",
        "hehe",
        "Draw, o coward!",
        "level",
        "eve",
        "star"
    );

    foreach ($Palindrome as $paliCheck) {
        if (empty($paliCheck)) {
            echo "<p> $paliCheck is not a Standard Palindrome.";
        }
        else{
            $paliTest = $paliCheck;
            $finalPal = strrev($paliTest);

            $paliTest = strtoupper($paliTest);
            $finalPal = strtoupper($finalPal);
            if ($paliTest != $finalPal) {
                echo "<p> $paliCheck is not Perfect Palindrome. </p> <br />";
            }
            else{
                echo "<p> $paliCheck is a Perfect Palindrome. </p> <br />";
            }
        }
    }
    
    ?>
</body>
</html>