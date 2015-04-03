    <?php 
        require_once ("Includes/simplecms-config.php"); 
        require_once  ("Includes/connectDB.php");
        include("Includes/header.php");         
     ?>


    <div id="main">
        <div id="head">
            <h1>Community Fund</br></h1>
            <h2>Improve Your Community!</br></h2>   
        </div>

        <form id="frmsearch" name="frmSearch" method="post" action="search.php">
            <div class="search" >
                <label>Search for a project here:</label>
                <input type="text" name="indexSearch" id="txtsearch"
                       placeholder="Search..." required />
                <input type="submit" value="Search" name="search" />            
            </div>
        </form>

    </div>

</div> <!-- End of outer-wrapper which opens in header.php -->

<?php 
    include ("Includes/footer.php");
 ?>