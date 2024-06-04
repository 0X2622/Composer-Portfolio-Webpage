
<?php 

/* 
Namn: Kevin Olsson
skol id: keol1201
kurs: DT100G - Webbprogrammering
Proggram: Civilingenjör Datateknik.

Denna sida hanterar inlägg av ljudfiler till mappen "uploads", som sedan kommer att användas för att lägga upp kompositioner i hemsidan.
det är tänkt att som inloggad admin, så ska de va möjligt att direkt lägga in kompisitioner via hemsidan.

*/


        //It is possible to upload files through the website, but only as admin, this function makes it possible.
        //This function works with the $_FILES array, which hold attributes of the uploaded files, such as filename, file size, file type, error, etc.
        //if the submit button was pressed the following code is to be validated:
        if(isset($_POST["addComposition"])){ 
            $audioF_Name = $_POST["audioFile"];
             
            //the first bracket is the name (index) of the array, and the second bracket is the attritue from the array that we are extracting.
            //audioFile array:
            $audioF_Name = $_FILES["audioFile"]["name"];
            $audioF_Temp = $_FILES["audioFile"]["tmp_name"]; 
            $audioF_Error = $_FILES["audioFile"]["error"]; 
            $audioF_Type = $_FILES["audioFile"]["type"];  

            //sheetFile array:
            $sheetF_Name = $_FILES["sheetFile"]["name"];
            $sheetF_Temp = $_FILES["sheetFile"]["tmp_name"];
            $sheetF_Error = $_FILES["sheetFile"]["error"];
            $sheetF_Type = $_FILES["sheetFile"]["type"];

            //this will sepparate the file name, along with it's extension -> filename.mp3 becomes filename mp3.
            //explode is a php function that "explodes" and sepparates the string in this case by the "." mark.
            $audio_Ext = explode('.',$audioF_Name);
            $sheet_Ext = explode('.',$sheetF_Name);

            // the function strtolower is used to make sure that all letters from the extension is lowercase.
            //end() gets the last piece of data from an array, in this case the string from our explode, which is equal to the extension.
            $audio_Ext_LowerC = strtolower(end($audio_Ext)); 
            $sheet_Ext_LowerC = strtolower(end($sheet_Ext)); 

            //all the allowed filetypes for the website - only mp3 and pdf (I leave .wav there because in the future i want it to take .wav as well)
            $allowedExt = array('mp3', 'wav', 'pdf');

            //checks if the extension of the file has an allowed extension,
            //it is done by checking if the extension from the audio file is found in allowedExt, for both audio and sheet.
            if(in_array($audio_Ext_LowerC, $allowedExt) && in_array($sheet_Ext_LowerC, $allowedExt)){
                
                //Error check, 0 in the Global array means that there is no error. 0 = No error.
                if($audioF_Error === 0 && $sheetF_Error === 0){

                    //this sets the destination path for the files, where "uploads" is the folder, and the variable after is the extracted name of the 
                    //file. Together it gives a complete path (destination) to the uploaded file.
                    $audioFile_Path = "../uploads/".$audioF_Name;
                    $sheetFile_Path = "../pdf/".$sheetF_Name;
                    move_uploaded_file($audioF_Temp, $audioFile_Path);
                    move_uploaded_file($sheetF_Temp, $sheetFile_Path);

                  
                    header("location:../compositionAdded.php");
                    exit();
                    }                                      
                


                //Error SECTION:
                //If != 0 -> there has been an error:
                else{
                    echo'There has been an error trying to upload the file (value = 0)';
                }
            }
            //output if the extension is not allowed.
            else{
                echo 'The Filetype (extension) that you have tried to upload is not allowed, please select another filetype';
            }
        }
        else{
            //if the value is not properly set.
            header("location: ../addComp.php");
            exit();
        } 
?> 

