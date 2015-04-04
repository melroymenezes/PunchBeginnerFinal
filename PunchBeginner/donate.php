<?php
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    
    $userid = $_SESSION['userid'];
    $amt = $_POST["amount"];
    $projid = $_POST["uid"];

    $query = "UPDATE projects SET currentFunds = currentFunds + ? WHERE uid = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param("di", $amt, $projid);
    if ($statement->execute()){
        echo "success";   
    }
?>
