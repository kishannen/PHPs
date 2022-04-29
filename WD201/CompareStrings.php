<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity 2: Compare Strings</title>
</head>
<body>
    <h1> Compare Strings </h1>
    <?php
    
    $firstString = "Geek2Geek";
    $secondString = "Geezer2Geek";

    if(!empty($firstString) && !empty($secondString)){
        if ($firstString == $secondString) {
            echo "<p> Both strings are the same. </p>";
        }
        else{
            echo "Both strings have " . similar_text($firstString, $secondString) . " character(s) in common. <br />";
            echo "<p> You must change " . levenshtein($firstString, $secondString) . " character(s) to make the strings the same.";
        }
    }
    else{
        echo "<p> Either the \$firstString variable or the \$secondString variable does not contain a value so the two strings cannot be compared. </p>";
    }
    ?>
</body>
</html>