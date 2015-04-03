<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $interest = $_POST['interest'];

        // check if usernamer already exists
        $check = "SELECT * FROM users WHERE username = ?";
		$statementcheck = $databaseConnection->prepare($check);
		$statementcheck->bind_param('s', $username);
		$statementcheck->execute();
		$statementcheck->store_result();

		if ($statementcheck->num_rows > 0) {
		    echo "Username already taken";
		} else {

            $query = "INSERT INTO users (username, password, email, interest) VALUES (?, SHA(?), ?, ?)";

            $statement = $databaseConnection->prepare($query);
            $statement->bind_param('ssss', $username, $password, $email, $interest);
            $statement->execute();
            $statement->store_result();

            $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
            if ($creationWasSuccessful)
            {
                $userId = $statement->insert_id;

                $addToUserRoleQuery = "INSERT INTO users_in_roles (user_id, role_id) VALUES (?, ?)";
                $addUserToUserRoleStatement = $databaseConnection->prepare($addToUserRoleQuery);

                // TODO: Extract magic number for the 'user' role ID.
                $userRoleId = 2;
                $addUserToUserRoleStatement->bind_param('dd', $userId, $userRoleId);
                $addUserToUserRoleStatement->execute();
                $addUserToUserRoleStatement->close();

                $_SESSION['userid'] = $userId;
                $_SESSION['username'] = $username;
                header ("Location: index.php");
            }
            else
            {
                echo "Failed registration";
            }
        }
    }
?>
<div id="main">
    <div id="container">
        <h2>Register an account</h2>
            <form action="register.php" method="post">
                <fieldset>
                    <legend>Register an account</legend>
                            <label for="email">E-mail:</label> 
                            <input type="text" name="email" value="" id="email" required/>
                            <label for="interests">Add an interest:</label> 
                            <select name="interest" id="dropdown">
                              <option value="Volunteer Abroad">Volunteer Abroad</option>
                              <option value="Startups">Start Ups</option>
                              <option value="Education">Education</option>
                              <option value="Construction">Construction</option>
                              <option value="Health">Health</option>
                            </select>
                            <label for="username">Username:</label> 
                            <input type="text" name="username" value="" id="username" required/>
                            <label for="password">Password:</label>
                            <input type="password" name="password" value="" id="password" required/>
                            <input type="submit" name="submit" value="Register" />
                </fieldset>
            </form>
        </div>
        <div id="doThisInstead">
            <p>
                Already have an account? <a href="logon.php">Log in</a> instead
                or <a href="index.php">Cancel</a>
            </p>
        </div>
     </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>