<?php
    //echo "hello";
    
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    require_once ("Includes/session.php");
    
    $userid = $_SESSION['userid'];
    $projid = $_POST["pid"];
 
    $query1 = "SELECT interest FROM users WHERE id = ?";
    $query2 = "SELECT interest FROM projects WHERE pid = ?";

    $statement1 = $databaseConnection->prepare($query1);
    $statement1->bind_param("i", $userid);
    $statement2 = $databaseConnection->prepare($query2);
    $statement2->bind_param("i", $projid);
    
    if ($statement1->execute()){
        $statement1->bind_result($u);

        $users = array();
        while ($statement1->fetch()) {
            array_push($users, array("interest"=>$u));
        }
    } else {
        echo $statement1->error;
    }

    if ($statement2->execute()){
        $statement2->bind_result($p);

        $projects = array();
        while ($statement2->fetch()) {
            array_push($projects, array("interest"=>$p));
        }
    } else {
        echo $statement2->error;
    }

    if ($users == $projects){
        echo json_encode(1);
    } else {
        echo json_encode($users) . "-----" . json_encode($projects);
    }
?>


