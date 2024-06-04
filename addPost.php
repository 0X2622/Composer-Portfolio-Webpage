<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar det visuela och inmatningsfälten för att lägga till posts (journals) i bloggen, och även ser till att
inmatningen hamnar i globala arrayen och sedan startar igång databasens funktioner för att lägga till o skriva ut inlägget. 

*/



    include("includes/header.php"); 
    //includes the database file and class. Having it in header makes sure that a connection is always established and ready.
    include ("class/journalDbh.php");
    $journalDbh = new Dbh();//Database Object named journalDbh of class Dbh. 
?>


<div class = "newPost" > 

  <form action = "addPost.php" method = "post"> <br>
  <input type = "text" name = "postDate" placeholder = "Enter date..." id = "postDate"> <br><hr class = "line">
  <input type = "text" name = "postTitle" placeholder = "Enter title..." id = "postTitle"> <br><hr>
  <textarea cols="40" rows="9" name = "postMessage" id = "postMessage" placeholder = "Enter text..."></textarea><br><hr id = "hr1">
  <button type = "submit" name = "submitPost" id = "submitPost"> Add post </button><br><hr id = "hr3">

</div>





<p><a id = "back" href = "journal.php"> Back to all posts </a> </p> 

<?php //if i submit a post, it will be set in the $_post array and start adding the post to the database.
   
   if(isset($_POST["submitPost"])){
   
        //makes sure that all fields ae filled for a post
        if(isset($_POST["postDate"]) && isset($_POST["postTitle"]) && $_POST["postMessage"]){
        $journalDbh->addPost();
        }
        else{
          header("location: addPost.php");
        }
    }
?>