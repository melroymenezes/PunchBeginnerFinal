<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 
    
    $uid = htmlspecialchars($_GET["uid"]);
    echo $uid;

    $query = "SELECT uid, title, details, deadline, goal, currentFunds FROM projects WHERE uid=?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('i', $uid);

    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows == 1)
        {
            $statement->bind_result($u, $title, $details, $deadline, $goal, $cf);
            $statement->fetch();
        }
        else
        {
            echo $statement->error;
        }
    
    include("viewproject.html");
    include ("Includes/footer.php");
?>