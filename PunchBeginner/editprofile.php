<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 
    /*
 
      */
    if (isset($_POST['submit'])){

        $uid = $_SESSION['userid'];
        $email = $_POST['email'];
        $interest = $_POST['interest'];

        $query = "UPDATE users SET email=?, interest=? WHERE id=?";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ssd', $email, $interest, $uid);
        $statement->execute();
        $statement->store_result();
        //header ("Location: index.php");

        $creationWasSuccessful3 = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful3)
        {            
            header ("Location: index.php");
            
        }
        else
        {
            echo "Failed updating";
        }
    } else {
        $uid = $_SESSION['userid'];
        $sql="SELECT email FROM users WHERE id=?";
        $statement1 = $databaseConnection->prepare($sql);
        $statement1->bind_param('i', $uid);
        $statement1->execute();
	    $statement1->bind_result($cur_email);  
        $statement1->fetch();
    }
?>

<div id="main">
        <div id="container">
            <h2>Edit user information</h2>
            <form name="editthing"action="editprofile.php" method="post">
                <fieldset>
                    <legend>Edit user information</legend>
                            <label for="emails">E-mail:</label> 
                            <input type="text" name="email" value="<?php print $cur_email; ?>" id="email" />
                            <label for="interests">Change interest:</label> 
                            <select name="interest">
                              <option value="volunteer">Volunteer abroad</option>
                              <option value="startups">Start Ups</option>
                              <option value="education">Education</option>
                              <option value="construction">Construction</option>
                              <option value="health">Health</option>
                            </select> 
                    <input type="submit" name="submit" value="Update" />
                </fieldset>
            </form>
         </div>
         <div id="doThisInstead">
            <p>
                <a href="index.php">Cancel</a>
            </p>
         </div>
    </div>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>