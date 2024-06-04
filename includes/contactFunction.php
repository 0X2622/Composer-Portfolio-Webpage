<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar logiken för att skicka meddelande till min emailadress.

*/


    //If the name value of the submit button has been set in the $_POST array,
    //means that contact information has been entered from a user and will be processed:
    if(isset($_POST["submit"])){

        //this makes sure that the user have entered all required fields in the contact form. 
        //if not -> the user will be asked to submit all required fields.
        if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subject"]) 
        && $_POST["name"] && $_POST["email"] && $_POST["subject"] != "" ){
        
            //code below is the process of handling and sending email to my adress from the contact form.
            //the information is fetched by the $_POST array, the values is gathered from the contact form in contact.php.
            //the php-function mail() is being used for this. 
            $name = $_POST["name"]; //the name of the sender
            $email = "<".$_POST["email"].">"; //the email of the sender
            $subject = $_POST["subject"]; //the subject that the sender has entered
            //$company = $_POST["company"]; //company or private (information by the sendev ) -> Not needed.
            $message = $_POST["message"]; //message of the sender

            $myEmail = "kev_olsson@hotmail.com"; //my email adress
            $headers = "From: ".$email; //shows from who the email is from (customer email adress)
            $txt = "You have recieved an email from " .$name.".\n\n".$message; 
        
            //the email function -> will have 3 parameters which is the email that the message is sent to (mine), 
            //the subject and also message.
            mail($myEmail, $subject, $txt, $headers);
            header("Location: ../messageSent.php");
        }
        else{
            //If all not fields are filled in, user will be redirected to the same page - and stay in the contact form
            //untill the requirerd fields have been filled.
           header("location: ../contact.php");
        }
    }
?>