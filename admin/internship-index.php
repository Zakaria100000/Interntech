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

                    echo "<div class='page-header clearfix'>";
                        echo "<h2 class='float-left'>Internships Details</h2>";
                        if ($_SESSION['SFx9'] == 1) {
                            echo "<a href='internship-create.php' class='btn btn-success float-right'>Add New Internship</a>";
                        }
                        echo "<a href='internship-index.php' class='btn btn-info float-right mr-2'>Reset View</a>";
                        echo "<a href='index.php' class='btn btn-secondary float-right mr-2'>Back</a>";
                    echo "</div>";
                    
                    echo "<div class='form-row'>";
                        echo "<form action='internship-index.php' method='get'>";
                            echo "<div class='col'>";
                            if ($_SESSION['SFx8'] == 1) {
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

                    $total_pages_sql = "SELECT COUNT(*) FROM internship";
                    $result = mysqli_query($link,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);

                    //Column sorting on column name
                    $orderBy = array('id', 'title', 'duration', 'remuneration', 'available_places', 'skills', 'created_time', 'id_company', 'id_category', 'id_type');
                    $order = 'id';
                    if (isset($_GET['order']) && in_array($_GET['order'], $orderBy)) {
                            $order = $_GET['order'];
                        }

                    //Column sort order
                    $sortBy = array('asc', 'desc'); $sort = 'desc';
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortBy)) {
                          if($_GET['sort']=='asc') {
                            $sort='desc';
                            }
                    else {
                        $sort='asc';
                        }
                    }

                    // Attempt select query execution
                    $sql = "SELECT i.id,i.title,i.duration,i.remuneration,i.available_places,i.skills,i.created_time,comp.name as company_name,cat.name as category_name,t.name as type_name
                    FROM internship i 
                        INNER JOIN company comp ON i.id_company = comp.id
                        INNER JOIN category cat ON i.id_category = cat.id 
                        INNER JOIN type t ON i.id_type = t.id
                        ORDER BY $order $sort LIMIT $offset, $no_of_records_per_page";
                    $count_pages = "SELECT * FROM internship";


                    if(!empty($_GET['search'])) {
                        $search = ($_GET['search']);
                        $sql = "SELECT i.id,i.title,i.duration,i.remuneration,i.available_places,i.skills,i.created_time,comp.name as company_name,cat.name as category_name,t.name as type_name 
                            FROM internship i 
                            INNER JOIN company comp ON i.id_company = comp.id
                            INNER JOIN category cat ON i.id_category = cat.id
                            INNER JOIN type t ON i.id_type = t.id
                            WHERE CONCAT_WS (i.id,i.title,i.duration,i.remuneration,i.available_places,i.skills,i.created_time,id_company,id_category,id_type)
                            LIKE '%$search%'
                            ORDER BY $order $sort
                            LIMIT $offset, $no_of_records_per_page";
                        $count_pages = "SELECT * FROM internship
                            WHERE CONCAT_WS (id,title,duration,remuneration,available_places,skills,created_time,id_company,id_category,id_type)
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
                                        echo "<th><a href=?search=$search&sort=&order=id&sort=$sort>No</th>";
										echo "<th><a href=?search=$search&sort=&order=title&sort=$sort>Title</th>";
										echo "<th><a href=?search=$search&sort=&order=duration&sort=$sort>Duration (month)</th>";
										echo "<th><a href=?search=$search&sort=&order=remuneration&sort=$sort>Remuneration (DA)</th>";
										echo "<th><a href=?search=$search&sort=&order=available_places&sort=$sort>Available Places</th>";
										echo "<th><a href=?search=$search&sort=&order=skills&sort=$sort>Skills</th>";
										echo "<th><a href=?search=$search&sort=&order=created_time&sort=$sort>Created Time</th>";
										echo "<th><a href=?search=$search&sort=&order=id_company&sort=$sort>Company</th>";
										echo "<th><a href=?search=$search&sort=&order=id_category&sort=$sort>Category</th>";
										echo "<th><a href=?search=$search&sort=&order=id_type&sort=$sort>Type</th>";
										
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";echo "<td>" . $row['title'] . "</td>";echo "<td>" . $row['duration'] . "</td>";echo "<td>" . $row['remuneration'] . "</td>";echo "<td>" . $row['available_places'] . "</td>";echo "<td>" . $row['skills'] . "</td>";echo "<td>" . $row['created_time'] . "</td>";echo "<td>" . $row['company_name'] . "</td>";echo "<td>" . $row['category_name'] . "</td>";echo "<td>" . $row['type_name'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='internship-read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><i class='far fa-eye'></i></a>";
                                            if ($_SESSION['SFx10'] == 1) {
                                                echo "<a href='internship-update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='far fa-edit'></i></a>";
                                            }
                                            if ($_SESSION['SFx11'] == 1) {
                                                echo "<a href='internship-delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='far fa-trash-alt'></i></a>";
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