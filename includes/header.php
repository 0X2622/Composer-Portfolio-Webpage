<!DOCTYPE HTML>
<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar hanterar de övre elementet vid sidhuvet, dvs navigationsmenyn, och även annan viktig
information såsom länk till min .css-fil, bakgrundsbild, configurationssidan, osv.

Denna sida startar även sessionen för att hantera inloggning, osv. och håller även koll på ifall man som användare är inloggad för admin eller inte
- och isåfall markerar detta med utloggningsknappen i högra hörnet.

*/


session_start(); ?>
<!-- Header content for the pages -->
    <html lang="sv">
     <!-- head contains metadata & stylesheet -->   
    <head>
        
        <?php include("includes/config.php");?>
        <title><?= $site_title . $divider . $page_title; ?></title> <!-- titles for the page -->
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        
    
</head>
    <!-- start of the visible body -->
    <body class = "bodyClass">
    <header>

    <!-- container for the top navigation bar -->
    <nav class = "topNav">


        <!-- list of navigation bar with hyperreferense links -->
        <ul class = "list">
            <li><a href = "index.php">Home </a> </li>
            
            <!-- arrow drop down -->
            <li class = "arrow">
                <a class = "About" href = "#About">About </a> 
                <!-- links of the drop down menu -->
                <ul class="dropdown">
                    <li><a href = "biography.php">Biography </a></li>
                    <li><a href = "reviews.php">Reviews</a></li>
                </ul>
           
            </li> 
            
            <li><a href = "compositions.php">Compositions </a> </li>
            <li><a href = "journal.php">Journal </a> </li>
            <li><a href = "contact.php">Contact </a> </li>
           
        </ul>

        <!-- if it's in admin (priveledged) mode, then a logout button will appear as indication on the upper right corner. -->
        <?php if(isset($_SESSION["uid"]) && isset($_SESSION["pwd"])){
        include("includes/logoutButton.php");}
        //header("location:contact.php");

        //if the logout button is found in the $_POST array, means that admin has logged out, and all essential information shal be deleted (unset) 
        //to go back to regular visitor mode. When uid and pwd is unsett all essential admin buttons will also dissapear.
        if(isset($_POST["logout"])){
            unset($_SESSION["uid"]);
            unset($_SESSION["pwd"]);
            unset($_POST["uid"]);
            unset($_POST["pwd"]);
            header("location:index.php");
            exit(); }

        ?>

    
    </nav>


  

    
   
