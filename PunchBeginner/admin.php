<?php
    require_once "Includes/session.php";
    require_once "Includes/connectDB.php";
    include("Includes/header.php"); 


    $res = $databaseConnection->query("SELECT COUNT(*) FROM users");
    $num_users = $res->fetch_row();

    $res1 = $databaseConnection->query("SELECT COUNT(*) FROM projects");
    $num_projects = $res1->fetch_row();

    /*
    $res2 = $databaseConnection->query("SELECT title  FROM projects WHERE total=(SELECT max(total) FROM projects)");
    $popular = $res2->fetch_array();

    $pid = 3;
    //$row = $result->fetch_array(MYSQLI_NUM);
    //$most_popular = implode(',', $res2->fetch_array());

    /*
    $result = mysql_query($databaseConnection,"SELECT count(*) FROM projects WHERE currentfunds >= goal");
    if ($res = $result->fetch_assoc()){
        echo "Total projects funded:";
        echo $res;
    } */
?>

    <div id="main">
        <div id="container">
            <h2><u>Statistics</u></h2>
            <ul>
                <li>Number of users: <?php print $num_users[0];?></li>
                <li>Number of projects: <?php print $num_projects[0];?></li>
                <li>Most Popular: 
                    <ul>
                        <?php
                            $query = "SELECT pid, title FROM projects WHERE total=(SELECT max(total) FROM projects)";
                            $statement = $databaseConnection->prepare($query);
                            $statement->execute();
	                        $statement->bind_result($pid, $title);
                            while ($statement->fetch()) {
                                echo "<li><a href='viewproject.php?pid={$pid}'>$title</a></li>";
                            }        
                        ?>
                    </ul>
                </li>
                <li><?php print "<a href='viewproject.php?pid={$pid}'>"; ?>proj</a></li>
            </ul>
        </div>
    </div>
</div>
<?php
    include ("Includes/closeDB.php");
    include("Includes/footer.php");

?>