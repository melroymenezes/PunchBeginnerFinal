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
        </div>

    </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>