
<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar det visuella för menyn och inmatningsfälten där man som admin kan välja att lägga till en komposition.
Och även ser till att inmatningsdatan kommer in i $_POSt array.

*/

    include("includes/header.php"); 
    
?>

<!-- title for the page -->
<div id = "compIntro">
 <h1 ID = "compTitle"> Add Composition </h1>
</div>


<div class = "uploadComp">
<!-- enctype multipart/form/data is added for the purpose of being able to upload files -->
    <form action = "includes/addcompFunc.php" method = "post" enctype = "multipart/form-data" > 
        <input type = "file" id = "audioFile" name = "audioFile" placeholder = "Choose Audiofile"> <br><br>
        <input type = "file" id = "sheetFile" name = "sheetFile" placeholder = "Choose Sheet/Score"> <br><br>
       
        <button type = "submit" name = "addComposition" id = "addComposition"> Add Composition </button><br><br>

    </form>
</div>

