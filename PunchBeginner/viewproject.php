<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 


?>

    <div id="main">
        <div id="view">
            <h1>Title: </h1>
            <p>Details: </p>
            <ul> 
                <li>Deadline: </li>
                <li>Amount Raised: out of </li>
                <li>Rating: </li>
            </ul>
            <div id="buttonHolder">
                <button id="donate" type="button"
                        onclick="location.href = 'donate.php'">
                    Donate
                </button>
                <button id="rate" type="button"
                        onclick="location.href = 'rate.php'">
                    Rate
                </button>
            </div>
             <div id="doThisInstead">
                <p>
                    <a href="index.php">Cancel</a>
                </p>
             </div>
        </div>

    </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>