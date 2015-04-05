<?php
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    require_once ("Includes/session.php");
    
    $userid = $_SESSION['userid'];
    $projid = $_POST["pid"];

    $samecommunity = "select * from users, projects where id=? AND pid=? AND users.interest=projects.interest";
    $statement = $databaseConnection->prepare($samecommunity);
    $statement->bind_param("ii", $userid, $projid);
    $statement->execute();
    $statement->store_result();

    if ($statement->num_rows == 1) {
        echo "true";
?>


