<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6b773fe9e4.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 5px;
        }
        body {
            font-size: 14px;
        }
    </style>
</head>
<?php require_once('navbar.php'); ?>
<body>
    <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <?php
                    // Include config file
                    require_once "config.php";
                    require_once "helpers.php";
                    require_once('permissions.php');

                    if ($_SESSION['SFx26'] == 0) {
                        header("location:index.php");
                    }

                    echo "<div class='page-header clearfix'>";
                        echo "<h2 class='float-left'>Students Details</h2>";
                        if ($_SESSION['SFx23'] == 1) {
                            echo "<a href='student-create.php' class='btn btn-success float-right'>Add New Student</a>";
                        }
                        echo "<a href='student-index.php' class='btn btn-info float-right mr-2'>Reset View</a>";
                        echo "<a href='index.php' class='btn btn-secondary float-right mr-2'>Back</a>";
                    echo "</div>";
                    
                    echo "<div class='form-row'>";
                        echo "<form action='student-index.php' method='get'>";
                            echo "<div class='col'>";
                            if ($_SESSION['SFx22'] == 1) {
                                echo "<input type='text' class='form-control' placeholder='Search this table' name='search'>";
                            } 
                            echo "</div>";
                        echo "</form>";
                    echo "</div>";
                    echo "<br>"; 

                    //Get current URL and parameters for correct pagination
                    $protocol = $_SERVER['SERVER_PROTOCOL'];
                    $domain     = $_SERVER['HTTP_HOST'];
                    $script   = $_SERVER['SCRIPT_NAME'];
                    $parameters   = $_SERVER['QUERY_STRING'];
                    $protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https')
                                === FALSE ? 'http' : 'https';
                    $currenturl = $protocol . '://' . $domain. $script . '?' . $parameters;

                    //Pagination
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }

                    //$no_of_records_per_page is set on the index page. Default is 10.
                    $offset = ($pageno-1) * $no_of_records_per_page;

                    $total_pages_sql = "SELECT COUNT(*) FROM user";
                    $result = mysqli_query($link,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);

                    //Column sorting on column name
                    $orderBy = array('id', 'firstname', 'lastname', 'email', 'password', 'id_role', 'id_center', 'id_promo');
                    $order = 'id';
                    if (isset($_GET['order']) && in_array($_GET['order'], $orderBy)) {
                            $order = $_GET['order'];
                        }

                    //Column sort order
                    $sortBy = array('asc', 'desc'); $sort = 'asc';
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortBy)) {
                          if($_GET['sort']=='asc') {
                            $sort='desc';
                            }
                    else {
                        $sort='asc';
                        }
                    }

                    // Attempt select query execution
                    $sql = "SELECT u.id as id, u.firstname as firstname, u.lastname as lastname, u.email as email, u.password as password, r.name as role, c.name as center, p.name as promo 
                        FROM user as u
                        INNER JOIN role as r ON u.id_role = r.id
                        INNER JOIN center as c ON u.id_center = c.id
                        INNER JOIN promo as p ON u.id_promo = p.id
                        WHERE u.id_role = 4 
                        ORDER BY $order $sort LIMIT $offset, $no_of_records_per_page";
                    $count_pages = "SELECT * FROM user WHERE id_role = 4";


                    if(!empty($_GET['search'])) {
                        $search = ($_GET['search']);
                        $sql = "SELECT u.id as id, u.firstname as firstname, u.lastname as lastname, u.email as email, u.password as password, r.name as role, c.name as center, p.name as promo 
                            FROM user as u
                            INNER JOIN role as r ON u.id_role = r.id
                            INNER JOIN center as c ON u.id_center = c.id
                            INNER JOIN promo as p ON u.id_promo = p.id
                            WHERE CONCAT_WS (u.id,u.firstname,u.lastname,u.email,u.password,u.id_role,c.name,p.name)
                            LIKE '%$search%' AND u.id_role = 4
                            ORDER BY $order $sort
                            LIMIT $offset, $no_of_records_per_page";
                        $count_pages = "SELECT * FROM user
                            WHERE CONCAT_WS (id,firstname,lastname,email,password,id_role,id_center,id_promo) AND id_role = 4
                            LIKE '%$search%'
                            ORDER BY $order $sort";
                    }
                    else {
                        $search = "";
                    }

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            if ($result_count = mysqli_query($link, $count_pages)) {
                               $total_pages = ceil(mysqli_num_rows($result_count) / $no_of_records_per_page);
                           }
                            $number_of_results = mysqli_num_rows($result_count);
                            echo " " . $number_of_results . " results - Page " . $pageno . " of " . $total_pages;

                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th><a href=?search=$search&sort=&order=firstname&sort=$sort>Firstname</th>";
										echo "<th><a href=?search=$search&sort=&order=lastname&sort=$sort>Lastname</th>";
										echo "<th><a href=?search=$search&sort=&order=email&sort=$sort>Email</th>";
										echo "<th><a href=?search=$search&sort=&order=password&sort=$sort>Password</th>";
										echo "<th><a href=?search=$search&sort=&order=id_role&sort=$sort>Role</th>";
										echo "<th><a href=?search=$search&sort=&order=id_center&sort=$sort>Center</th>";
										echo "<th><a href=?search=$search&sort=&order=id_promo&sort=$sort>Promo</th>";
										
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['firstname'] . "</td>";echo "<td>" . $row['lastname'] . "</td>";echo "<td>" . $row['email'] . "</td>";echo "<td style='-webkit-text-security: disc;'>" . $row['password'] . "</td>";echo "<td>" . $row['role'] . "</td>";echo "<td>" . $row['center'] . "</td>";echo "<td>" . $row['promo'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='student-read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><i class='far fa-eye'></i></a>";
                                            if ($_SESSION['SFx24'] == 1) {
                                                echo "<a href='student-update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='far fa-edit'></i></a>";
                                            }
                                            if ($_SESSION['SFx25'] == 1) {
                                                echo "<a href='student-delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='far fa-trash-alt'></i></a>";
                                            }
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
?>
                                <ul class="pagination" align-right>
                                <?php
                                    $new_url = preg_replace('/&?pageno=[^&]*/', '', $currenturl);
                                 ?>
                                    <li class="page-item"><a class="page-link" href="<?php echo $new_url .'&pageno=1' ?>">First</a></li>
                                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo $new_url ."&pageno=".($pageno - 1); } ?>">Prev</a>
                                    </li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo $new_url . "&pageno=".($pageno + 1); } ?>">Next</a>
                                    </li>
                                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                        <a class="page-item"><a class="page-link" href="<?php echo $new_url .'&pageno=' . $total_pages; ?>">Last</a>
                                    </li>
                                </ul>
<?php
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>