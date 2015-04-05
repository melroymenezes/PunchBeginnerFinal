<?php
    require_once "Includes/session.php";
    require_once "Includes/connectDB.php";
    include("Includes/header.php");
    
    

    
?>
<div id="main">
    <div id="container">
<?php
    $result = mysql_query($databaseConnection,"SELECT count(*) FROM projects WHERE currentfunds >= goal");
    if ($res = $result->fetch_assoc()){
        echo "Total projects funded:";
        echo $res;
    }
?>        
    </div>
</div>
<?php
    include ("Includes/closeDB.php");
    include("Includes/footer.php");

?>