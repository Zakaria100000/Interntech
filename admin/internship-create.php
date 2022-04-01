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
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = trim($_POST["title"]);
		$duration = trim($_POST["duration"]);
		$remuneration = trim($_POST["remuneration"]);
		$available_places = trim($_POST["available_places"]);
		$skills = trim($_POST["skills"]);
		$created_time = trim($_POST["created_time"]);
		$id_company = trim($_POST["id_company"]);
		$id_category = trim($_POST["id_category"]);
		$id_type = trim($_POST["id_type"]);
		

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
          exit('Something weird happened'); //something a user can understand
        }

        $vars = parse_columns('internship', $_POST);
        $stmt = $pdo->prepare("INSERT INTO internship (title,duration,remuneration,available_places,skills,created_time,id_company,id_category,id_type) VALUES (?,?,?,?,?,?,?,?,?)");

        if($stmt->execute([ $title,$duration,$remuneration,$available_places,$skills,$created_time,$id_company,$id_category,$id_type  ])) {
                $stmt = null;
                header("location: internship-index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<?php require_once('navbar.php'); ?>
<body>
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add a record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="internship-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>