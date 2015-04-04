<?php
    require_once  ("Includes/connectDB.php");
    $search_tag = "%" . $_POST['search'] . "%";
    $search_by = $_POST['searchBy'];
    //echo "query=$search_tag and search_by=$search_by";

    if ($search_by == 'Title') {
        $query = "SELECT initiator, pid, title, details, deadline, goal FROM projects WHERE title LIKE ?";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('s', $search_tag);
    } else if ($search_by == 'All'){
        $query = "SELECT initiator, pid, title, details, deadline, goal FROM projects";
        $statement = $databaseConnection->prepare($query);
    } else {
        $search_tag = $_POST['indexSearch'];
        $query = "SELECT initiator, pid, title, details, deadline, goal FROM projects WHERE title=?";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('s', $search_tag);
    }

    $statement->execute();
	$statement->bind_result($initiator, $pid, $title, $details, $deadlines, $goal);
    $data = array();
    while ($statement->fetch()) {
        array_push($data, array("initiator"=>$initiator, "pid"=>$pid, "title"=>$title, "details"=>$details,
        "deadline"=>$deadlines, "goal"=>$goal));
    }
    echo json_encode($data);
?>

