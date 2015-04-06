<?php
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    require_once ("Includes/session.php");

    //echo var_dump($_POST) . "-----" . var_dump($_SESSION);

    //projects
    $query = "SELECT pid, title FROM projects WHERE initiator=?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param("i", $_SESSION["userid"]);
    $statement->execute();
    $statement->bind_result($pid, $title);
    
    $projects = array();
    while ($statement->fetch()) {
        array_push($projects, array("pid"=>$pid, "title"=>$title));
    }
    
    //friends
/*    $query2 = "SELECT username FROM users";
    $result = $databaseConnection->query($query2);
    $friends = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
            array_push($friends, $row["username"]);
        }
    }
*/
    $query3 = "SELECT username FROM users WHERE interest IN (SELECT interest FROM users WHERE id=?)";
    $stmt = $databaseConnection->prepare($query3);
    $stmt->bind_param("i", $_SESSION["userid"]);
    $stmt->execute();
    $stmt->bind_result($f);

    $friends = array();
    while ($stmt->fetch()) {
        array_push($friends, array("friend"=>$f));
    }

    $data = array();
    array_push($data, array("projects"=>$projects, "friends"=>$friends));
    echo json_encode($data);
?>
