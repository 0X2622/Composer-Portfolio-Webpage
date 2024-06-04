<?php 


/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.


by this page, with the right password and username, you can login and enter the page by "Admin mode",
while in admin mode, you will have access to change information, add compositions, and journal posts.
If in admin mode - a login button will appear at the header to indicate that it's in admin mode.
if the logout button is not there - it means it's in normal visitor mode. 
if the logout button is pressed the session data will be unsett and you will be redirected to the index page and lose all admin priveledge.

*/

include("includes/header.php");

//if session is already set, you can't enter the login page, because it's  already the right user, and you 
//will get redirected to the main - index page instead.
if(isset($_SESSION["uid"]) || isset($_SESSION["pwd"])){
    header("location:index.php");
    exit();
} 

?>

    <div class = "loginSection"><!-- Using the POST method & POST array, to validate and check the users input -->
        <h1 class = "login"> Login here </h1>
        <form class = "loginForm" action = "includes/loginFunction.php" method = "post">
            <input type = "text" name = "uid" placeholder = "Username(admin).." > <br>
            <input type = "password" name = "pwd" placeholder = "Password(admin).." > <br>
            <button id = "loginButton" type = "submit" name = "login-submit" value ="submit"> Login </button>

            <!-- If the user have entered any input in the text field -> continue to the login function. -->
            <?php if(isset($_POST["uid"]) && isset($_POST["pwd"])){
                header("location:includes/loginFunction.php");
                exit();
            } 
            ?>
        </form> 
    </div>
