<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity 5: Password Strength</title>
</head>
<body>
    <h1>Password Strength</h1>
    <?php
    
    $Passwords = array (
        "Kisses_123_ShanneN", // Strong
        "Kisses", // Too Short
        "qwertynbvcxzasdfghpoiuhjklmn019283", // Too long
        "kisha10_!", // must have an uppercase
        "K1SSES!!", // must have a lowercase
        "Aej 010=0!", // space is not allowed
        "K1sH4n_n3n", // Strong
        "C.i.t.T", // Too short
        "thesong@!", // must have a number
        "Miracle3DaysAgo", // must have a special character
    );

    foreach ($Passwords as $EntryCode){
        if (empty($EntryCode)) {
            echo "<p> $EntryCode is invalid password. Please try again.";
        }
        elseif (strlen($EntryCode) >= 8 && strlen($EntryCode) <= 16) {
            if (preg_match("([^0-9A-Za-z])", $EntryCode)) {
                if (strpos($EntryCode, ' ')) {
                    echo "Space is not allowed for your password <strong> \"" .$EntryCode ."\" </strong><br />";
                }
                elseif (!preg_match("/[0-9]/", $EntryCode)) {
                    echo "Your password <strong> \"" .$EntryCode ."\" </strong> must contain AT LEAST A NUMERIC VALUE <br />" ;
                }
                elseif (!preg_match("/[A-Z]/", $EntryCode)) {
                    echo "Your password <strong> \"" .$EntryCode ."\" </strong>must contain AT LEAST AN UPPER CASE LETTER <br />" ;
                }
                elseif (!preg_match("/[a-z]/", $EntryCode)) {
                    echo "Your password <strong> \"" .$EntryCode ."\" </strong> must contain AT LEAST A LOWER CASE LETTER <br />" ;
                }
                else {
                    echo "<strong>" .$EntryCode. "</strong>is a STRONG password <br />" ;
                }
            }
            elseif (!preg_match("([!@#%\$\\^&*()_+{}|:\"';/?><`~])", $EntryCode)) {
                echo "Your password <strong>\"" .$EntryCode ."\" </strong> must contain AT LEAST SPECIAL CHARACTER <br />" ;
            }
            else{
                echo "<strong>" .$EntryCode ."</strong> is a WEAK password" ;
            }
        }
        elseif (strlen($EntryCode) < 8) {
            echo "<strong>" .$EntryCode ." </strong> must contain AT LEAST 8 combination of uppercase, lowercase, numeric and special characters <br />" ;
        }
        elseif (strlen($EntryCode) > 16) {
            echo "<strong>" .$EntryCode ." </strong> must ONLY contain 16 combination of uppercase, lowercase, numeric and special characters <br />" ;
        }
    }

    ?>
</body>
</html>