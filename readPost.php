<!-- 

Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar det visuela som händer när man går in i sidan "read posts", det inkluderar databasen som sedan kommer att skriva ut de nödvändiga 
funktioner som finns i printpost().

Denna sida hanterar också kontrol av primärnyckeln "ID" som finns i GET-arrayen, som kommer att användas för att både skriva ut ett specifikt inlägg men också
ta bort ett specifikt inlägg.
-->


<p id = "pBack3"><a id = "back3" href = "journal.php"> Back to all posts </a> </p>
<?php 
    
    include("includes/header.php"); 
     //includes the database file and class. Having it in header makes sure that a connection is always established and ready.
     include ("class/journalDbh.php");
     $journalDbh = new Dbh();//Database Object named journalDbh of class Dbh. 

     //If the Admin user have clicked on a post, the $_GET array will have an index called "ID", which will be the
     //primary key of a clicked post (row). This value will be passed in as argument into the function printPost (which prints the selected post).
     //In summary -> Every time that a post is clicked this value will be stored and the post will be printed.
     if(isset($_GET["ID"])){
       $journalDbh->printPost($_GET["ID"]); 
      }

      //Same logic as with print post, but in this case every selected post will be associated by a Delete value, which will be the primary key of the row.
      //it is not possible to delete a post without opening the post. The delete value will be set after the post has been opened. Then the delete value will
      //be set to the primary key, and if clicked -> it will be set in the $_GET array and then passed in as argument to the function Delete Post.
      if(isset($_GET["delete"])){
        $journalDbh->deletePost($_GET["delete"]); 
      }
?>

