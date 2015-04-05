<?php
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    require_once ("Includes/session.php");
    
    $userid = $_SESSION['userid'];
    $amt = $_POST["amount"];
    $projid = $_POST["pid"];

    $query = "UPDATE projects SET currentFunds = currentFunds + ? WHERE pid = ?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param("di", $amt, $projid);
    if ($statement->execute()){
        $statement2 = $databaseConnection->prepare("INSERT INTO funders (pid, uid, amount, time) VALUES (?, ?, ?, now())");
        $statement2->bind_param("iid", $projid, $userid, $amt);
        if ($statement2->execute()){
            echo "success";   
        } else {
            echo $statement2->error . var_dump($_SESSION);
        }
    }
?>
