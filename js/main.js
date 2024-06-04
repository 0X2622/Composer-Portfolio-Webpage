
/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Detta program hanterar interaktiviteten för sidan "Compositions",
för framför allt ljudmenyn, där man kan starta, stoppa, bläda till nästa låt, föregående låt,
och även navigera sig inom en låt med hjälp av musen inom låtens tidslinje.

*/

//information that needs to be bringed in from the .html page
const musicSection = document.querySelector('.musicSection'); //entire composition sectin wrap
const playBtn = document.querySelector('#playButton'); //buttons 
const nextBtn = document.querySelector('#nextButton');
const prevBtn = document.querySelector('#prevButton');
const audio = document.querySelector('#audioFile'); //the audio scr
const musicTracker = document.querySelector('.musicTracker');
const trackerBar = document.querySelector('.trackerBar');
const compositionTitle = document.querySelector('#musicTitle');
const pdfTitle = document.querySelector('#pdfTitle');
const audioDuration = document.querySelector('#audioDuration');
const audioFulltime = document.querySelector('#audioFulltime');



//array that will hold song names. kanske inte behlver, jag vill ha att för varje uppladdning, så skjuts namnen för låtarna in i skriptet
//och just dessa två kommer då laddas upp. Alternativt så kör jag en spottfunktion. Likt i Journals.
// Att vaVje gång COMPOSITIONs öppnas, så kommer allt i mappen per automaik att laddas upp. men jag ska då se till att matchande namn hamnar brevid varandra.
const musicArray = ['faith', 'lacrimoso', 'melancholia', 'one step', 'Ozymandias']; // song titles


//MusicPointer is a value that will keep track of which composition from the musicArray that is being played.
//by default it is = 0, and will point to the first value (index) of the array, and will change when the functions 
//prev and nextcomposition is called.
let musicPointer = 0; 

//så när songindex ändras så kommer låten ändras med, för det ändras index i arrayen, precis. 0 = index 1
//så det blir basically man använder en funktion med en en array som ett argument där arvayen kommer innehålla alla låttitlar
//och sedan sp blir det en index av arrayen som då är en av låtarna.
loadComposition(musicArray[musicPointer]); 


//functions below

//this funktion will load in a specific index from the music array,
//the argument will be the array along with an index, which will then represent a specific song in the folder.
//the source of the composition will be set along with the title name
function loadComposition(composition){


    compositionTitle.innerText = composition;
    audio.src = `../projektarbete/uploads/${composition}.mp3`; //kan ändras till .wav enkelt
    //pdfTitle.src = `../projektarbete/pdf/${composition}.pdf`;
}




//this function will start if the class 'musicSection' does not contain the class 'playButton'.
//in other words - if the song is paused - this function will start and change the pause button to the play button
//by removing the symbol (class) 'fa-play' and adding the symbol (class) 'fa-pause', when the pause button is appearing means that the
//song is currently playing 
function compositionPlay(){
    musicSection.classList.add('playButton');
    playBtn.querySelector('i.fas').classList.remove('fa-play');
    playBtn.querySelector('i.fas').classList.add('fa-pause');

    audio.play();
};



//this function does the reversed operation of playSong() and changes the pause button to the play button, 
//it will start if the class 'musicSection' contains the class 'playButton', if it does 
//it will remove the pause symbol (class 'fa-pause') and then add the play symbol (class 'fa-play'),
//and thus the music will be marken as paused when the play button is appeared. 
function compositionPause(){
    musicSection.classList.remove('playButton');
    playBtn.querySelector('i.fas').classList.remove('fa-pause');
    playBtn.querySelector('i.fas').classList.add('fa-play');

    audio.pause();
};




//when clicked at the button brevious soung, the song index is to be
function prevComposition(){
  
    musicPointer--; //makes sure that song index decrease it's value when prevButton is clicked.
  
    //if song index is at the index 0, at the first song in the list
    //the prev button should lead to the other side of the array (last index - last song)
    if(musicPointer<0){
        musicPointer = musicArray.length - 1; //sets the musicPointer to the last index in the array if the current index is the first one.
    }

    //this makes sure to load the music at the current set index.
    loadComposition(musicArray[musicPointer]); 

    audio.play(); //makes sure that the audio plays automatically when clicking next song
    compositionPlay(); //this makes sure that the pause button appears automatically when the previous song starts play
}




//when the next button is clicked this function will start and it will change the musicPointer (index of the musicArray) to the next value
//and make sure to load in that composition and starts to play it. 
function nextComposition(){
    musicPointer++; //makes sure that song index decrease it's value when prevButton is clicked.
  
    //if song index is at the last index of the array, in other words if it's greater than the last index - 1,
    //then the next button should lead to the first index of the array (First song)
    if(musicPointer > musicArray.length - 1){
        musicPointer = 0; //sets the musicPointer to the last index in the array if the current index is the first one.
    }

    //this makes sure to load the music at the current set index.
    loadComposition(musicArray[musicPointer]); 

    audio.play(); //makes sure that the audio plays automatically when clicking next song
    compositionPlay(); //this makes sure that the pause button appears automatically when the next song starts play
}



//eventlisteners below::

//function that handles interactive switch between play and pause button.
document.getElementById('playButton').addEventListener("click", function(){

    //This will check if the class musicContainer contains the class of 'play', if it does means that the music is curvently playing
    const audioPlaying = musicSection.classList.contains('playButton');

    //if the class "musicSection" does contain a class named 'playButton' -> means that the audio is playing and should be paused:
    if(audioPlaying){
        //function that pauses the song
        compositionPause();
    }
    else{
        //Means that the song was paused and that the classlist did not contain class "play".
        compositionPlay();
    }

});




//this function will return the duration of the currently played song,
//and also the current time of the currently played song.
function audioTracker(e){
    //console.log(e.target.duration);
   
    //this makes sure to pull out the duration & also the current time of the target (objekt) that is being played.
    const {duration, currentTime} = e.target; 
   
    //console.log((currentTime/duration)*100);
    const trackerPrc = (currentTime / duration) * 100; //this returns a decimal that represents the played % of the total duration 
    
    //this will make sure that the current width of the musicTracker will always be equal to the % value of trackerPrc
    musicTracker.style.width = `${trackerPrc}%`; 

    //this makes sure to update the audio duration text at the audio nav menu
    //math.round takes away decimals to only display full integers.
    audioDuration.innerText = Math.round(audio.currentTime) + "s /"; 
    audioFulltime.innerText = Math.round(duration) + " s";   
}



//function that makes it possible to click and navigate in the tracker bar to get to a specific point in the music
function trackPointer(e){
    
    //clientWidth returns the viewable width of the element in pixels,
    const width = this.clientWidth; 

    //returns the X-cordinate of the mountpointer relative to the targeted element e,
    const xAxisClick = e.offsetX;
    
    //returns the complete audio duration.
    const completeDuration = audio.duration;

    //sets the current time of the audio
    audio.currentTime = ((xAxisClick / width) * completeDuration);

}



//timeupdate is an eventlistener that constantly will be called while an audio is being played
//while timeupdate is being called "the trackerFunction" is being called - which will update the tracker bar for the playing composition.
audio.addEventListener('timeupdate', audioTracker);
trackerBar.addEventListener('click', trackPointer);

//this will make sure that when an audio has ended, it will call the function "nextComposition" which starts to immediately play next audio.
//this will always make the audio list keep going and playing.
audio.addEventListener('ended', nextComposition);

//eventlisteners for clicking on both the next button and previous button,
//will start the following functions that changes the musicPointer to next/previous song and starts playing it.
prevBtn.addEventListener('click', prevComposition);
nextBtn.addEventListener('click', nextComposition);
