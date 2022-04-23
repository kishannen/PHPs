<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$cnum = $cname = $street = $city = $cstate = $zip = $repnum = "";
$cnum_err = $cname_err = $street_err = $city_err = $cstate_err = $zip_err = $repnum_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate customer num
    $input_cnum = trim($_POST["cnum"]);
    if(empty($input_cnum)){
        $cnum_err = "Please enter customer number.";     
    } else{
        $cnum = $input_cnum;
    }
    
    // Validate customer name
    $input_cname = trim($_POST["cname"]);
    if(empty($input_cname)){
        $cname_err = "Please enter customer name.";
    } elseif(!filter_var($input_cname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $cname_err = "Please enter a valid customer name.";
    } else{
        $cname = $input_cname;
    }
    
    // Validate street
    $input_street = trim($_POST["street"]);
    if(empty($input_street)){
        $street_err = "Please enter street.";     
    } else{
        $street = $input_street;
    }
    
    // Validate city
    $input_city = trim($_POST["city"]);
    if(empty($input_city)){
        $city_err = "Please enter city.";     
    } else{
        $city = $input_city;
    }
    
    // Validate state
    $input_cstate = trim($_POST["cstate"]);
    if(empty($input_cstate)){
        $cstate_err = "Please enter cstate.";     
    } else{
        $cstate = $input_cstate;
    }
    
    // Validate zip
    $input_zip = trim($_POST["zip"]);
     if(empty($input_zip)){
        $zip_err = "Please enter zip.";     
    } else{
        $zip = $input_zip;
    }

    // Validate rep num
    $input_repnum = trim($_POST["repnum"]);
     if(empty($input_repnum)){
        $repnum_err = "Please enter representative number.";     
    } else{
        $repnum = $input_repnum;
    }
    
    
    // Check input errors before inserting in database
    if(empty($cnum_err) && empty($cname_err) && empty($street_err) && empty($city_err) && empty($cstate_err) && empty($zip_err) && empty($repnum_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO customer (CUSTOMER_NUM, CUSTOMER_NAME, STREET, CITY, CSTATE, ZIP, REP_NUM) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_cnum, $param_cname, $param_street, $param_city, $param_cstate, $param_zip, $param_repnum);
            
            // Set parameters
            $param_cnum = $cnum;
            $param_cname = $cname;
            $param_street = $street;
            $param_city = $city;
            $param_cstate = $cstate;
            $param_zip = $zip;
            $param_repnum = $repnum;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add customer record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                            <label>Customer Number</label>
                            <input type="text" name="cnum" class="form-control <?php echo (!empty($cnum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cnum; ?>">
                            <span class="invalid-feedback"><?php echo $cnum_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="cname" class="form-control <?php echo (!empty($cname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cname; ?>">
                            <span class="invalid-feedback"><?php echo $cname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Street</label>
                            <input type="text" name="street" class="form-control <?php echo (!empty($street_err)) ? 'is-invalid' : ''; ?>"><?php echo $street; ?>
                            <span class="invalid-feedback"><?php echo $street_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>"><?php echo $city; ?>
                            <span class="invalid-feedback"><?php echo $city_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>C. State</label>
                            <input type="text" name="cstate" class="form-control <?php echo (!empty($cstate_err)) ? 'is-invalid' : ''; ?>"><?php echo $cstate; ?>
                            <span class="invalid-feedback"><?php echo $cstate_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" name="zip" class="form-control <?php echo (!empty($zip_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zip; ?>">
                            <span class="invalid-feedback"><?php echo $zip_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>RepNum</label>
                            <input type="text" name="repnum" class="form-control <?php echo (!empty($repnum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $repnum; ?>">
                            <span class="invalid-feedback"><?php echo $repnum_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>