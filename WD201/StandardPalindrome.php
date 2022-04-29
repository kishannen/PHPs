<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity 4: Standard Palindrome</title>
</head>
<body>
    <h1>Standard Palindrome</h1>
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

            $paliTest = strtoupper(preg_replace("([^A-Za-z0-9])", "", $paliTest));
            $finalPal = strtoupper(preg_replace("([^A-Za-z0-9])", "", $finalPal));
            if ($paliTest != $finalPal) {
                echo "<p> $paliCheck is not Standard Palindrome. </p> <br />";
            }
            else{
                echo "<p> $paliCheck is a Standard Palindrome. </p> <br />";
            }
        }
    }
    ?>
</body>
</html>