<?php

include "connect.php";
include "functions.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700;800;900&display=swap" rel="stylesheet">
    <title>task</title>
</head>
<body>


    <?php 
    
        $do = (isset($_GET["do"]))? $_GET["do"] : "manage";


        if($do == "manage") {

            //fetch data from db
            
            $stmt = $db->prepare("SELECT * FROM taskmanager ORDER BY id DESC LIMIT 10");
            $stmt->execute();
            $row = $stmt->fetchAll();
            
            
            ?>

           <div class="container">
                    <h1 class="text-center"> Manage Tasks </h1>
                    <a href="index.php?do=add" class="btn btn-primary manage"><i class="fa fa-plus"></i> Add New Task </a>
                    <div class="table-responsive">
                        <table class="main table table-bordered text-center">
                            <tr>
                                <td>User</td>
                                <td>Description</td>
                                <td>Date</td>
                                <td>Manage</td>
                            </tr>
                            <?php
                                    // loop to display task data from database

                                foreach($row as $rw) {

                                    echo "<tr>";
                                        echo "<td>" . $rw["name"] . "</td>";
                                        echo "<td>" . $rw["description"] . "</td>";
                                        echo "<td>" . $rw["date"] . "</td>";
                                        echo "<td>";
                                                
                                                /* 
                                                    **check  if member status = 0 or not 
                                                    ** 0 means task not completed
                                                    ** 1 means task completed
                                                */

                                                if($rw["status"] == 1) {

                                                    // comoleted

                                                    echo '<span class="complete">Done</span>';
                                                }
                                                else {
                                                    echo "<a href='index.php?do=activate&taskid=" . $rw["id"] . "' class='btn btn-info notsinished'> make as done</a>";
                                                }
                                        echo  "</td>";
                                    echo "</tr>";
                                }

                            ?>
                            
                        </table>
                    </div>
                </div>
        <?php
        }
        elseif($do == "add") {?>
            <div class="container">
                <h1 class="text-center">add task</h1>
                <form  class="form-horizontal" action="?do=insert" method="POST">
                    <div class="form-group">
                        <label class="col-sm-6 offset-sm-3 control-label">assign to</label>
                        <div class="col-sm-6 offset-sm-3">
                            <input type="text" class="form-control" name="name" placeholder="name list" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 offset-sm-3 control-label">deliver date</label>
                        <div class="col-sm-6 offset-sm-3">
                            <input type="text" id="datepicker" class="form-control" name="dating" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-6 offset-sm-3 control-label">description</label>
                        <div class="col-sm-6 offset-sm-3">
                            <input type="text" class="form-control" name="desc" minlength="10" maxlength="100" placeholder="description" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 offset-sm-4">
                            <input type="submit" class="btn btn-primary form-control" value="Add">
                        </div>
                    </div>
                </form>
            </div>
        <?php 
        }
        elseif($do == "insert") {

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $name = $_POST["name"];
                $date = $_POST["dating"];
                $desc = $_POST["desc"];

                $formErrors = array();

                if(empty($name)) {
                    $formErrors[] = "required name";
                }
                if(empty($date)) {
                    $formErrors[] = "required date";
                }
                if(strlen($desc) < 10 && strlen($desc) > 100) {
                    $formErrors[] = "must be within 10 : 100 chars";
                }
                foreach($formErrors as $error) {

                    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                }
                if(empty($formErrors)) {

                    $stmt = $db->prepare("INSERT INTO taskmanager( name, date, description) 
                                        VALUES(:tuser, :tdate, :tdesc ) ");
                        $stmt->execute(array(
                            "tuser"     => $name, 
                            "tdate"     => $date, 
                            "tdesc"     => $desc
                            ));

                    $themsg = '<div class="alert alert-success" role="alert">' . $stmt->rowCount() . "record updated" . '</div>';

                    redirect($themsg);
                }
            }
            else
            {

                echo '<div class="container">';

                // calling redirect function 
                
                $themsg = '<div class="alert alert-danger" role="alert">sorry you aren\'t allowed to be here directly </div>';

                redirect($themsg);

                echo '</div>';
            }
        }
        elseif($do == "edit") {

            $taskid = isset($_GET["taskid"]) && is_numeric($_GET["taskid"]) ? intval($_GET["taskid"]) : 0;


            $stmt = $db->prepare("SELECT 
                                  *
                            FROM
                                  taskmanager 
                            WHERE 
                                  id = ? 
                            LIMIT
                                  1");
            $stmt->execute(array($taskid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();

            if($count > 0 ) { ?>
                <div class="container">

                    <h1 class="text-center">edit task</h1>
                    <form  class="form-horizontal" action="?do=insert" method="POST">
                        <div class="form-group">
                            <label for="">assign to</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $row["name"] ?>" placeholder="name list" required>
                        </div>
                        <div class="form-group">
                            <label for="">deliver date</label>
                            <input type="text" id="datepicker" class="form-control" name="date" value="<?php echo $row["date"] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">description</label>
                            <input type="text" class="form-control" name="desc" value="<?php echo $row["description"] ?>" placeholder="name list" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary form-control" value="Add">
                        </div>
                    </form>
                </div>

            <?php
            }
            else {

                //redirect function

            echo '<div class="container">';

                $themsg = '<div class="alert alert-danger" role="alert">sorry no id here like that</div>';

                redirect($themsg);

            echo '</div>';
        }
            
        }
        elseif($do == "activate") {

            echo '<h1 class="text-center">task completed</h1>';
            echo "<div class='container'>";

                $taskid = isset($_GET["taskid"]) && is_numeric($_GET["taskid"]) ? intval($_GET["taskid"]) : 0;   // if function shortly in one row


                $stmt = $db->prepare("UPDATE taskmanager SET status = 1 WHERE id = ? ");

                $stmt->execute(array($taskid));

                // redirect function

                $themsg = '<div class="alert alert-success" role="alert">' . $stmt->rowCount() . " task completed</div>";

                redirect($themsg);

            echo "</div>";
        }
        else {
    
            echo '<div class="alert alert-danger" role="alert"> Error </div>';
        }
    
    
    ?>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/task.js"></script>
    
</body>
</html>



    
