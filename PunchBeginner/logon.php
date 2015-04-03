<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
    include ("Includes/header.php");

    if (isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT id, username FROM users WHERE username = ? AND password = SHA(?) LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $username, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($_SESSION['userid'], $_SESSION['username']);
            $statement->fetch();
            header ("Location: index.php");
        }
        else
        {
            echo "Username/password combination is incorrect.";
        }
    }
?>
<div id="main">
    <div id="container">
        <h2>Log in</h2>
            <form action="logon.php" method="post">
                <fieldset>
                    <legend>Log in</legend>
                            <label for="username">Username:</label> 
                            <input type="text" name="username" value="" id="username" />
                            <label for="password">Password:</label>
                            <input type="password" name="password" value="" id="password" />
                    <input type="submit" name="submit" value="Log In" />
                </fieldset>
            </form>
        </div>
        <div id="doThisInstead">
            <p>
                Don't have an account? <a href="register.php">Sign up</a> instead
                or <a href="index.php">Cancel</a>
            </p>
        </div>
    </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php include ("Includes/footer.php"); ?>