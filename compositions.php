<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar skelettet och uppbyggnaden för kompositionssidan och alla element som ljudmenyn och kompositionesidan kommer att 
innehålla,
Just nu så står alla kompositionsnamn i listan hårdkodade tyvärr, originella tanken är att man ska läsa in alla filer från
mappen där de finns och lägga ut de i listan (likt som jag har gjort i min "journal funktion") men pga tidsbrist så har jag inte 
hunnit implementera detta. (kan dock göras vid behov).

jag har även inkluderat en länk som ger knappar till min ljudmeny, och även skrivit ned sökvägen till filen där alla komposiioner och pdf,filer och 
pdf-bilder finns. Javascriptfilen som hanterar interaktiviteten i ljudmenyn finns även inkluderad i denna fil.


*/

    include("includes/header.php"); 
    
?>

<!-- link to icon buttons for play menu -->
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css"
    />
<div id = "compIntro">
 <h1 ID = "compTitle">Compositions </h1>
    <h3 ID = "compDescr">Feel free to preview some of my work - available as audio and sheet </h3>
</div>


<!-- contains and wraps everything music related in this page --> 
<div class = "musicSection">

    <!-- this div contains all information about the played music, title, etc. -->
     <div class = musicInfo>
        <p id = "pTitle"> Title:  </p>
        <h4 id="musicTitle">Some title</h4> <!-- will be filled dynamically -->
        <P id = "by"> By: </p>
        <h5 id = "composerName"> Kevin Olsson </h4><br><br><hr><br><br>
        

        <!-- this is the list where the audio will be uploaded along with sheets -->
        <ol type = "1" start = "1" class = "musicList">
            <li><p>faith</p>       <a target="_blank" id = "pdfAnchor" href = "pdf/faith.pdf">       <img id = "pdfImg" src = "buttons/score.png"> </a> </li><hr id = "compHr">
            <li><p>lacrimoso</p>   <a target="_blank" id = "pdfAnchor" href = "pdf/lacrimoso.pdf">   <img id = "pdfImg" src = "buttons/score.png"> </a> </li><hr id = "compHr">
            <li><p>melancholia</p> <a target="_blank" id = "pdfAnchor" href = "pdf/melancholia.pdf"> <img id = "pdfImg" src = "buttons/score.png"> </a> </li><hr id = "compHr">
            <li><p>one step</p>    <a target="_blank" id = "pdfAnchor" href = "pdf/one step.pdf">    <img id = "pdfImg" src = "buttons/score.png"> </a> </li><hr id = "compHr">
            <li><p>Ozymandias</p>  <a target="_blank" id = "pdfAnchor" href = "pdf/Ozymandias.pdf">  <img id = "pdfImg" src = "buttons/score.png"> </a> </li><hr id = "compHr">
        </ol>
        
        <div class="trackerBar">
            <div class="musicTracker"></div> <!-- will be filled dynamically -->
        </div>
        <p id = "audioDuration"> 00:00 </p> <!-- will show the duration of the audio -->
        <p id = "audioFulltime"> 100 </p>
    </div>

    
    <audio src = "uploads/lacrimoso.mp3" id = "audioFile"></audio>
    <file src = "pdf/Ozymandias.pdf" id = "pdfFile"> </file>


    <!-- Div for navigation buttons "play", "prev" and "next" -->
    <!-- using (importing) buttons from "font awesome" -->
    <div class="navButtons">

        <!-- play button -->
        <button id="playButton" class = "action-btn action-btn-big"> <!-- måste ändra namnet på klasserna sen så de mer egna -->
            <i class = "fas fa-play"></i> 
        </button>

        <!-- prev button -->
        <button id="prevButton" class = "action-btn">
           <i class = "fas fa-backward"></i>
        </button>

        <!-- next button -->
        <button id="nextButton" class = "action-btn">
            <i class = "fas fa-forward"></i>
        </button>

    </div>
</div>

<script src = "js/main.js"> </script>


<?php if(isset($_SESSION["uid"]) && isset($_SESSION["pwd"])){

        //if admin logged in admin functions add & delete compositions will appear
        echo '<p class = "addCompC"><a id = "addCompA" href = "addComp.php"> Upload new Composition </a> </p> ';
      
       
    }?>