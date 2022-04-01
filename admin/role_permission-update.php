<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$id_role = "";
$id_permission = "";
$is_allowed = "";

$id_role_err = "";
$id_permission_err = "";
$is_allowed_err = "";


// Processing form data when form is submitted
if(isset($_POST["id_permission"]) && !empty($_POST["id_permission"])){
    // Get hidden input value
    $id_permission = $_POST["id_permission"];

    $id_role = trim($_POST["id_role"]);
		$id_permission = trim($_POST["id_permission"]);
		$is_allowed = trim($_POST["is_allowed"]);
		

    // Prepare an update statement
    $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];
    try {
        $pdo = new PDO($dsn, $db_user, $db_password, $options);
    } catch (Exception $e) {
        error_log($e->getMessage());
        exit('Something weird happened');
    }

    $vars = parse_columns('role_permission', $_POST);
    $stmt = $pdo->prepare("UPDATE role_permission SET id_role=?,id_permission=?,is_allowed=? WHERE id_permission=?");

    if(!$stmt->execute([ $id_role,$id_permission,$is_allowed,$id_permission  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        header("location: role_permission-read.php?id_permission=$id_permission");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["id_permission"] = trim($_GET["id_permission"]);
    if(isset($_GET["id_permission"]) && !empty($_GET["id_permission"])){
        // Get URL parameter
        $id_permission =  trim($_GET["id_permission"]);

        // Prepare a select statement
        $sql = "SELECT * FROM role_permission WHERE id_permission = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $id_permission;

            // Bind variables to the prepared statement as parameters
			if (is_int($param_id)) $__vartype = "i";
			elseif (is_string($param_id)) $__vartype = "s";
			elseif (is_numeric($param_id)) $__vartype = "d";
			else $__vartype = "b"; // blob
			mysqli_stmt_bind_param($stmt, $__vartype, $param_id);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value

                    $id_role = $row["id_role"];
					$id_permission = $row["id_permission"];
					$is_allowed = $row["is_allowed"];
					

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.<br>".$stmt->error;
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<?php require_once('navbar.php'); ?>
<body>
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                                <label>Role</label>
                                    <select class="form-control" id="id_role" name="id_role">
                                    <?php
                                        $sql = "SELECT *,id FROM role";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            array_pop($row);
                                            $value = implode(" | ", $row);
                                            if ($row["id"] == $id_role){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_role_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Permission</label>
                                    <select class="form-control" id="id_permission" name="id_permission">
                                    <?php
                                        $sql = "SELECT *,id FROM permission";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            array_pop($row);
                                            $value = implode(" | ", $row);
                                            if ($row["id"] == $id_permission){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_permission_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Is Allowed ?</label>
                                <input type="number" name="is_allowed" class="form-control" value="<?php echo $is_allowed; ?>">
                                <span class="form-text"><?php echo $is_allowed_err; ?></span>
                            </div>

                        <input type="hidden" name="id_permission" value="<?php echo $id_permission; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="role_permission-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
