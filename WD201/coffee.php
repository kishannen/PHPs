<?php
    $username = "root";
    $password = "";
    $database = "coffeeshop";
    $mysqli = new mysqli("localhost", $username, $password, 
    $database);
    $query = "SELECT * FROM CUSTOMER";
    echo "<b> <center> <h1> CAFE CUSTOMER </h1> </center> </b> <br>";
?>

<table border="3" align = center>
<tr>
<th>CUSTOMER_ID</th>
<th>CUSTOMER_NAME</th>
<th>PHONE_NUMBER</th>
<th>STREET</th>
<th>CITY</th>
<th>ZIPCODE</th>

</tr>

<center> <strong> <h2> 20 OUTPUTS </h2></strong></center>

<?php
    if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()) 
    {
?>

<tr>
<td> <?php echo $row['CUSTOMER_ID'] ?></td>
<td><?php echo $row['CUSTOMER_NAME'] ?></td>
<td><?php echo $row['PHONE_NUMBER'] ?></td>
<td> <?php echo $row['STREET'] ?></td>
<td><?php echo $row['CITY'] ?></td>
<td><?php echo $row['ZIPCODE'] ?></td>
</tr>

<?php

    }
?>
</table> 
<?php
 
$result->free();
}?>