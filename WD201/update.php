<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$cnum = $cname = $street = $city = $cstate = $zip = $repnum = "";
$cnum_err = $cname_err = $street_err = $city_err = $cstate_err = $zip_err = $repnum_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // Validate customer number
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
        $cname_err = "Please enter a valid name.";
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
        $cstate_err = "Please enter state.";     
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
    
    // Validate representative number
    $input_repnum = trim($_POST["repnum"]);
     if(empty($input_repnum)){
        $repnum_err = "Please enter representative number.";     
    } else{
        $repnum = $input_repnum;
    }
    
    
    // Check input errors before inserting in database
    if(empty($cnum_err) && empty($cname_err) && empty($street_err) && 
    empty($city_err) && empty($cstate_err) && empty($zip_err) && empty($repnum_err)){

        // Prepare an update statement
        $sql = "UPDATE customer SET CUSTOMER_NUM=?, CUSTOMER_NAME=?, STREET=?,
         CITY=?, CSTATE=?, ZIP=?, REP_NUM=? WHERE CUSTOMER_NUM=$cnum";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
             mysqli_stmt_bind_param($stmt, "sssssss", $param_cnum, $param_cname, 
             $param_street, $param_city, $param_cstate, $param_zip, $param_repnum);
             echo "update hello";

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
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM customer WHERE CUSTOMER_NUM = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $cnum = $row["CUSTOMER_NUM"];
                    $cname = $row["CUSTOMER_NAME"];
                    $street = $row["STREET"];
                    $city = $row["CITY"];
                    $cstate = $row["CSTATE"];
                    $zip = $row["ZIP"];
                    $repnum = $row["REP_NUM"];

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                            <input type="text" name="street" class="form-control <?php echo (!empty($street_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $street; ?>">
                            <span class="invalid-feedback"><?php echo $street_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>">
                            <span class="invalid-feedback"><?php echo $city_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>C. State</label>
                            <input type="text" name="cstate" class="form-control <?php echo (!empty($cstate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cstate; ?>">
                            <span class="invalid-feedback"><?php echo $cstate_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Zip</label>
                            <input type="text" name="zip" class="form-control <?php echo (!empty($zip_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zip; ?>">
                            <span class="invalid-feedback"><?php echo $zip_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Representative</label>
                            <input type="text" name="repnum" class="form-control <?php echo (!empty($repnum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $repnum; ?>">
                            <span class="invalid-feedback"><?php echo $repnum_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>