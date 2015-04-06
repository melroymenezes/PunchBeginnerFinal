<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 

    $uid = $_SESSION['userid'];
    $query = "SELECT username, email, interest FROM users WHERE id=?";
    $statement = $databaseConnection->prepare($query);
    $statement->bind_param('d', $uid);
    $statement->execute();
	$statement->bind_result($username, $email, $interest);
    $statement->fetch();
?>

    <div id="main">
        <div id="view">
            <h1><?php echo $username ?></h1>
            <p>Email: <?php echo $email ?></p>
            <p>Current Interest: <?php echo $interest ?></p>
            <ul>
                <li>My projects: </li>
                <?php
                    $uid = $_SESSION['userid'];
                    $query1 = "SELECT pid, title FROM users, projects WHERE id=initiator AND id=?";
                    $statement1 = $databaseConnection->prepare($query1);
                    $statement1->bind_param('d', $uid);
                    $statement1->execute();
	                $statement1->bind_result($pid, $title);
                    while ($statement1->fetch()) {
                        echo "<li>$title</li>";
                        //echo "<li><a href='viewproject.php?pid={$pid}'>$title</a></li>";
                    }        
                ?>
            </ul>
                
        </div>

    </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>