<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 
    
    $pid = htmlspecialchars($_GET["pid"]);
    echo $pid;

    $query = "SELECT pid, initiator, title, details, deadline, goal, currentFunds FROM projects WHERE pid=?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('i', $pid);

    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows == 1)
        {
            $statement->bind_result($pid, $init, $title, $details, $deadline, $goal, $cf);
            $statement->fetch();
        }
        else
        {
            echo $statement->error;
        }
    
    include("viewproject.html");
    include ("Includes/footer.php");
?>