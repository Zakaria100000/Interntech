<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$cv = "";
$lm = "";
$id_user = "";
$id_Internship = "";
$id_status = "";

$cv_err = "";
$lm_err = "";
$id_user_err = "";
$id_Internship_err = "";
$id_status_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cv = trim($_POST["cv"]);
		$lm = trim($_POST["lm"]);
		$id_user = trim($_POST["id_user"]);
		$id_Internship = trim($_POST["id_Internship"]);
		$id_status = trim($_POST["id_status"]);
		

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

        $vars = parse_columns('application', $_POST);
        $stmt = $pdo->prepare("INSERT INTO application (cv,lm,id_user,id_Internship,id_status) VALUES (?,?,?,?,?)");

        if($stmt->execute([ $cv,$lm,$id_user,$id_Internship,$id_status  ])) {
                $stmt = null;
                header("location: application-index.php");
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
                                <label>CV</label>
                                <input type="text" name="cv" maxlength="50"class="form-control" value="<?php echo $cv; ?>">
                                <span class="form-text"><?php echo $cv_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Motivation Letter</label>
                                <textarea name="lm" maxlength="50"class="form-control" value="<?php echo $lm; ?>"></textarea>
                                <span class="form-text"><?php echo $lm_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>User</label>
                                    <select class="form-control" id="id_user" name="id_user">
                                    <?php
                                        $sql = "SELECT *,id FROM user";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = $row['email'];
                                            if ($row["id"] == $id_user){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_user_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Internship</label>
                                    <select class="form-control" id="id_Internship" name="id_Internship">
                                    <?php
                                        $sql = "SELECT *,id FROM internship";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = implode(" | ", [$row['id'], $row['title']]);
                                            if ($row["id"] == $id_Internship){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_Internship_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Status</label>
                                    <select class="form-control" id="id_status" name="id_status">
                                    <?php
                                        $sql = "SELECT *,id FROM status";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = implode(" | ", [$row['label'], $row['description']]);
                                            if ($row["id"] == $id_status){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_status_err; ?></span>
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="application-index.php" class="btn btn-secondary">Cancel</a>
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