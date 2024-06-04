<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar kontaktformuläret där man som besökare kan skicka meddelande till min personliga email.
När inmatningsfälten är ifyllda så används post metoden för att föra vidare datan till funktionen som sköter logiken 
om hur meddelandet skickas vidare


*/

include("includes/header.php");?>

<h1 id = "contactTitle"> Contact </h1>
<h3 id = "info"> If you have an inquiry, request or just want to talk music, <br> feel free to reach out with the form below! </h3>
<p id = "inputInfo"> Input your information below... </p>

<div class = "contactInfo">
    
    <!-- contact form -->
    
    <form class = "contactForm" action = "includes/contactFunction.php" method = "post"> <br>
    <input type = "text" name = "name" placeholder = "Fullname..." id = "fullName"> <br>
    <input type = "text" name = "email" placeholder = "Your email..." id = "userEmail"> <br>
    <input type = "text" name = "subject" placeholder = "Subject/Inquiry..." id = "inquiry"> <br>
    <!--<input type = "text" name = "company" placeholder = "Company/private"> -->
    <br><br>

    <p id = "messageP" style = "color:white;">Message:</p>
    <textarea cols="40" rows="5" name = "message" id = "fullMessage" placeholder = "Message along with company name if exist..."></textarea><br>
    <button type = "submit" name = "submit" id = "submitButton"> Send message </button><br><br>
    
    <?php 
        if(!isset($_POST["submit"])){
            echo"  <h3 style = 'color:white'><em> Please fill in all fields to submit a post</em></h3> ";
        }
        else {
            //if post submitted the contact function is included and will validate if the post was correct or needs further completion.
            include("includes/contactFunction.php");
        }
    ?>

</div>