<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$firstname = "";
$lastname = "";
$email = "";
$password = "";
$id_role = "";
$id_center = "";
$id_promo = "";

$firstname_err = "";
$lastname_err = "";
$email_err = "";
$password_err = "";
$id_role_err = "";
$id_center_err = "";
$id_promo_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname = trim($_POST["firstname"]);
		$lastname = trim($_POST["lastname"]);
		$email = trim($_POST["email"]);
		$password = trim($_POST["password"]);
		$id_role = trim($_POST["id_role"]);
		$id_center = trim($_POST["id_center"]);
		$id_promo = trim($_POST["id_promo"]);
		

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

        $vars = parse_columns('user', $_POST);
        $stmt = $pdo->prepare("INSERT INTO user (firstname,lastname,email,password,id_role,id_center,id_promo) VALUES (?,?,?,?,?,?,?)");

        if($stmt->execute([ $firstname,$lastname,$email,$password,$id_role,$id_center,$id_promo  ])) {
                $stmt = null;
                header("location: delegate-index.php");
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
                                <label>Firstname</label>
                                <input type="text" name="firstname" maxlength="50"class="form-control" value="<?php echo $firstname; ?>">
                                <span class="form-text"><?php echo $firstname_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Lastname</label>
                                <input type="text" name="lastname" maxlength="50"class="form-control" value="<?php echo $lastname; ?>">
                                <span class="form-text"><?php echo $lastname_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" maxlength="50"class="form-control" value="<?php echo $email; ?>">
                                <span class="form-text"><?php echo $email_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" maxlength="50"class="form-control" value="<?php echo $password; ?>">
                                <span class="form-text"><?php echo $password_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Role</label>
                                    <select class="form-control" id="id_role" name="id_role">
                                    <?php
                                        $sql = "SELECT *,id FROM role";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = $row['name'];
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
                                <label>Center</label>
                                    <select class="form-control" id="id_center" name="id_center">
                                    <?php
                                        $sql = "SELECT *,id FROM center";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = $row['name'];
                                            if ($row["id"] == $id_center){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_center_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Promo</label>
                                    <select class="form-control" id="id_promo" name="id_promo">
                                    <?php
                                        $sql = "SELECT *,id FROM promo";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            $value = $row['name'];
                                            if ($row["id"] == $id_promo){
                                            echo '<option value="' . "$row[id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $id_promo_err; ?></span>
                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="delegate-index.php" class="btn btn-secondary">Cancel</a>
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