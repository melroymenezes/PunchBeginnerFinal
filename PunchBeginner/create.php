<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 

    if (isset($_POST['submit'])){

        $uid = $_SESSION['userid']; 
        $title = $_POST['title'];
        $details = $_POST['details'];
        $deadline = $_POST['deadline'];
        $goal = $_POST['goal'];

        $query = "INSERT INTO projects (uid, title, details, deadline, goal) VALUES (?, ?, ?, ?, ?)";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('issss', $uid, $title, $details, $deadline, $goal);
        $statement->execute();
        $statement->store_result();

        $creationWasSuccessful2 = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful2)
        {
            
            $pid = $statement->insert_id;

            $addProjToUser = "INSERT INTO user_project (uid, pid) VALUES (?, ?)";
            $addProjToUserStatement = $databaseConnection->prepare($addProjToUser);

            $addProjToUserStatement->bind_param('dd', $uid, $pid);
            $addProjToUserStatement->execute();
            $addProjToUserStatement->close();
            
            
            header ("Location: index.php");
            
        }
        else
        {
            echo "Project Creation Failed";
        }
    }
?>


<div id="main">
        <div id="container">
            <h2>Create a new project:</h2>
            <form name="sugform"action="create.php" method="post">
                <fieldset>
                    <legend>Create a new project</legend>
                            <label for="title">Title:</label> 
                            <input type="text" name="title" value="" id="title" />
                            <label for="details">Details:</label> 
                            <input type="text" name="details" value="" id="details" />
                            <!--<textarea name="details" rows="4" cols="41">Enter the details here</textarea> -->
                            <label for="deadline">Deadline:</label> 
                            <input type="text" name="deadline" value="" id="deadline"
                                   placeholder="MM/DD/YYYY" pattern="(0[1-9]|1[012])[/](0[1-9]|[1-2][0-9]|3[01])[/](19|20)[0-9]{2}" />
                            <label for="goal">Goal:</label> 
                            <input type="text" name="goal" value="" id="goal" />
                    <input type="submit" name="submit" value="Submit" />
                </fieldset>
            </form>
         </div>
         <div id="doThisInstead">
            <p>
                <a href="index.php">Cancel</a>
            </p>
         </div>

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>