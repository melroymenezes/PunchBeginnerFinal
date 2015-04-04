<?php
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    
    $userid = $_SESSION['userid'];
    $amt = $_POST["amount"];
    $projid = $_POST["pid"];

    $query = "UPDATE projects SET currentFunds = currentFunds + ? WHERE pid = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param("di", $amt, $projid);
    if ($statement->execute()){
        echo "success";   
    }
?>
