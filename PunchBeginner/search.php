<?php
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    require_once ("Includes/session.php");
    include("Includes/header.php"); 
?>

<div id="body">
    <div id="container">
        <form action="search.php" method = "post">
            <input type="text" name="search"></input>
            <input type="radio" name="searchBy" value="Title">Title
            <input type="radio" name="searchBy" value="All">All
            <input type="submit" name="submit" value="Search"></input>
        </form>
    </div>
        <ul> 
    <?php
        $search_tag = $_POST['search'];
        $search_by = $_POST['searchBy'];

        if ($search_by == 'Title') {
            $query = "SELECT uid, title, details, deadline, goal FROM projects WHERE title=?";
            $statement = $databaseConnection->prepare($query);
            $statement->bind_param('s', $search_tag);
        } else if ($search_by == 'All'){
            $query = "SELECT uid, title, details, deadline, goal FROM projects";
            $statement = $databaseConnection->prepare($query);
        } else {
            $search_tag = $_POST['indexSearch'];
            $query = "SELECT uid, title, details, deadline, goal FROM projects WHERE title=?";
            $statement = $databaseConnection->prepare($query);
            $statement->bind_param('s', $search_tag);
        }
             
        $statement->execute();
	    $statement->bind_result($uid, $title, $details, $deadlines, $goal);
        while ($statement->fetch()) {
            echo "<li><h1>UID: $uid</h1><h2>Title: $title</h2><p>Details: $details</p</br>$deadline Goal: $goal</li>";
        }        
    ?>
    </ul>
    </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>
