<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity 1: Validate Credit Card</title>
</head>
<body>
    <h1>Validate Credit Card</h1>

    <?php
    $CreditCard = array(
        "", //empty string
        "8910-1234-5648-6543", //with dashes
        "OOOO-9123-4567-0123", //with non-numeric, uppercase Os
        "1234 5678 9120 2212" // with spaces
    );

    foreach ($CreditCard as $CardNumber){
        if(empty($CardNumber)){
            echo "<p> This Credit Card Number is invalid because it contains an empty string. <p>";
        }
        else{
            $CreditCardNumber = $CardNumber;
            $CreditCardNumber = str_replace("-", "", $CreditCardNumber);
            $CreditCardNumber = str_replace(" ", "", $CreditCardNumber);
            if(!is_numeric($CreditCardNumber)){
                echo "<p> Credit Card Number " .$CreditCardNumber ." is not a valid Credit Card Number because it contains a non-numeric character. </p>";
            }
            else{
                echo "<p> Credit Card Number " .$CreditCardNumber ." is a valid Credit Card Number. </p>";
            }
        }
    }
    ?>

</body>
</html>