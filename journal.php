<?php 


/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida är skelettet för alla bloginlägg, och ger en plattform där de kan läggas upp. databasen som sedan kommer att sköta logiken och skriva ut
alla inlägg inkluderas här med.

*/




include("includes/header.php");

    //includes the database file and class. Having it in header makes sure that a connection is always established and ready.
    include ("class/journalDbh.php");
    $journalDbh = new Dbh();//Database Object named journalDbh of class Dbh. 
?>
    <h1 id = "journal"> Journal <h1>
    
    <div class = "verticalMenu"> 
        <ul class = "menuItems">
            <?php  $journalDbh->printJournals();  //make sure to print posts titles if exists in database. ?>                               
        </ul> 
    </div>



<div class = "anchor">
    <?php 
        //if admin is logged in then admin function "add post" will appear
        if(isset($_SESSION["uid"]) && isset($_SESSION["pwd"])){
            echo '<p><a id = "addPost" href = "addPost.php"> Add new post </a></p> ';
        }
    ?>

</div>

