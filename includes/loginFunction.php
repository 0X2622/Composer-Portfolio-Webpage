<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar inloggningsformuläret för adminfunktionerna. använder sig av post-metden och sätter även in 
inloggningsuppgifterna i $_SESSION. Användarnamn och lösenord finns hårdkodade och synliga.

*/


session_start(); ?>

<!-- function that will handle the login for the user -->
<?php
    //hard coded variables that is used for the Name and Password validation.
    $uid = "admin";
    $pwd = "admin";

    //Checks whether the Users Username and Password is correct, if it is,
    //Put the value inside the Session Array, and continue to the Index Page.
    //The index page will now let the user pass to the main page.
    if($_POST["uid"] == $uid && $_POST["pwd"]== $pwd){
        $_SESSION["uid"] = $uid;
        $_SESSION["pwd"] = $pwd;
        header("location:../index.php");
        exit();
              
    }
    else{
        //If the Username & Password was not correct, the user will be redirected to the login screen.
        header("location:../loginpage.php");
        exit();
    }