<?php
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    require_once ("Includes/session.php");
    
    $userid = $_SESSION['userid'];
    $like = $_POST["like"];
    $projid = $_POST["pid"];

    $likeQuery = "INSERT INTO liked (pid, uid) VALUES (?, ?)";
    $statement = $databaseConnection->prepare($likeQuery);
    $statement->bind_param("ii", $projid, $userid);
    
    if ($statement->execute()){
        if ($like == 1) {
            $query = "UPDATE projects SET likes = likes + 1, total = total + 1 WHERE pid = ?";
        } else {
            $query = "UPDATE projects SET total = total + 1 WHERE pid = ?";
        }
        $statement2 = $databaseConnection->prepare($query);
        $statement2->bind_param("i", $projid);
        if ($statement2->execute()){
            echo "success";
        } else {
            echo $statement2->error;
        }
    } else {
        echo "Already liked";
    }
    
    
?>
