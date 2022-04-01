<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$title = "";
$duration = "";
$remuneration = "";
$available_places = "";
$skills = "";
$created_time = "";
$id_company = "";
$id_category = "";
$id_type = "";

$title_err = "";
$duration_err = "";
$remuneration_err = "";
$available_places_err = "";
$skills_err = "";
$created_time_err = "";
$id_company_err = "";
$id_category_err = "";
$id_type_err = "";


// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    $title = trim($_POST["title"]);
		$duration = trim($_POST["duration"]);
		$remuneration = trim($_POST["remuneration"]);
		$available_places = trim($_POST["available_places"]);
		$skills = trim($_POST["skills"]);
		$created_time = trim($_POST["created_time"]);
		$id_company = trim($_POST["id_company"]);
		$id_category = trim($_POST["id_category"]);
		$id_type = trim($_POST["id_type"]);
		

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

    $vars = parse_columns('internship', $_POST);
    $stmt = $pdo->prepare("UPDATE internship SET title=?,duration=?,remuneration=?,available_places=?,skills=?,created_time=?,id_company=?,id_category=?,id_type=? WHERE id=?");

    if(!$stmt->execute([ $title,$duration,$remuneration,$available_places,$skills,$created_time,$id_company,$id_category,$id_type,$id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        header("location: internship-read.php?id=$id");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["id"] = trim($_GET["id"]);
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM internship WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $id;

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

                    $title = $row["title"];
					$duration = $row["duration"];
					$remuneration = $row["remuneration"];
					$available_places = $row["available_places"];
					$skills = $row["skills"];
					$created_time = $row["created_time"];
					$id_company = $row["id_company"];
					$id_category = $row["id_category"];
					$id_type = $row["id_type"];
					

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
                                <label>Title</label>
                                <input type="text" name="title" maxlength="50"class="form-control" value="<?php echo $title; ?>">
                                <span class="form-text"><?php echo $title_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Duration (month)</label>
                                <input type="number" name="duration" class="form-control" value="<?php echo $duration; ?>" step="any">
                                <span class="form-text"><?php echo $duration_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Remuneration (DA)</label>
                                <input type="number" name="remuneration" class="form-control" value="<?php echo $remuneration; ?>" step="any">
                                <span class="form-text"><?php echo $remuneration_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Available Places</label>
                                <input type="number" name="available_places" class="form-control" value="<?php echo $available_places; ?>">
                                <span class="form-text"><?php echo $available_places_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Skills</label>
                                <input type="text" name="skills" maxlength="50"class="form-control" value="<?php echo $skills; ?>">
                                <span class="form-text"><?php echo $skills_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Created Time</label>
                                <input type="date" name="created_time" class="form-control" value="<?php echo $created_time; ?>">
                                <span class="form-text"><?php echo $created_time_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Company</label>
                                    <select class="form-control" id="id_company" name="id_company">
                                    <?php
                                        $sql = "SELECT *,id FROM company";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = $row['name'];
                                            if ($row["id"] == $id_company){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_company_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Category</label>
                                    <select class="form-control" id="id_category" name="id_category">
                                    <?php
                                        $sql = "SELECT *,id FROM category";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = $row['name'];
                                            if ($row["id"] == $id_category){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_category_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Type</label>
                                    <select class="form-control" id="id_type" name="id_type">
                                    <?php
                                        $sql = "SELECT *,id FROM type";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = $row['name'];
                                            if ($row["id"] == $id_type){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_type_err; ?></span>
                            </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="internship-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
