<?php

// To do: 
// Hitta ny databas att lagra datan 

class Dbh {

    /*private members for LOCAL database access & connection
    private $hn = 'localhost';        //hostname
    private $un = 'root';        //username
    private $pwd = '';       //password
    private $dbn = 'journal';       //database name
    private $conn;      //connection */


    //private members for PUBLIC database access & connection
    private $hn;        //hostname
    private $un;        //username
    private $pwd;       //password
    private $dbn;       //database name
    private $conn;      //connection

    //values for the database table/relation
    //these values represents the 3 different columns in the relation
    private $postTitle;
    private $postDate;
    private $postMessage;
    

     //Construct, skapar en anslutning till databasen och även en relation.
     public function __construct(){

        //public database
        $this->hn = "studentmysql.miun.se";
        $this->un = "keol1201";
        $this->pwd = "yuw72tip";
        $this->dbn = "keol1201"; 


        // mysqli_connect Opens a new connection to the MySQL server
        $this->conn = mysqli_connect($this->hn, $this->un, $this->pwd, $this->dbn) or die("Connection Failed.");

        //At launch, the table guestbook will be created only if it does not already exist.
        $table = "CREATE TABLE IF NOT EXISTS journal(
            ID int NOT NULL AUTO_INCREMENT,
            name VARCHAR(100),
            Message TEXT,
            Date VARCHAR(100),
            PRIMARY KEY (ID)
        )";

        //query to create table.
        $result = mysqli_query($this->conn, $table);
 
    }

    //takes the values of the private class members and set it to the given values.
    public function addPost(){

        
        $this->postTitle = $_POST["postTitle"];
        $this->postMessage = $_POST["postMessage"];
        $this->postDate = $_POST["postDate"];


        //Inserts data into the relation "guestbook"
        //$query is the sql query to be excecuted.
        $query = "INSERT INTO journal (ID, name, Message, Date)
        VALUES(DEFAULT, '$this->postTitle', '$this->postMessage', '$this->postDate');";

        //making connection to the database with the sql query.
        $result = mysqli_query($this->conn, $query);

        header("location:../projektarbete/postAdded.php"); //ska senare va POST ADDED.php såklart. Parent directory ska även ändras till code
    }

    //function that prints out an induvidual selected post to the user.
    //Since every printed post will be asociated with an ID -> if that ID is set in the $_GET array means that the user have clicked on that specific 
    //post and wants to read it. Then that ID value will be passed in as argument and be a reference to the right post (row) that is to be printed.
    public function printPost($ID){
     
        //makes sure to select the right clicked row in the databe journal:
        $query = "SELECT * FROM journal WHERE ID = '$ID';";
        $result = mysqli_query($this->conn, $query);

        //while there is data to be printed from the result:
        while($post = mysqli_fetch_assoc($result)) {

            echo "<div class = "."viewPost".">";
                echo " <p id = "."pstDate"."> ".$post["Date"]."</p><br>";
                echo " <p id = "."pstName"."> ".$post["name"]."</p><br><hr>";
                echo " <p id = "."postMsg"."> ".$post["Message"]."</p><br>";
       
            echo "</div>";

            echo "<hr id = "."backHr"."><p id = "."pBack3"."><a id = "."back3" ."href = "."../journal.php"."> Back to all posts </a> </p> ";
           
           //additional delete function: if admin is logged in the delete button will appear to be able to delete posts.
            if(isset($_SESSION["uid"]) && isset($_SESSION["pwd"])){
                echo "<hr id = "."hr2"."><p id = "."deletePara"."><a id = "."deleteAnchor"." href='readPost.php?delete=" . $post["ID"] . "'>Delete Post</a></p>";  
            }
            
        }   
    }


    //a function that prints out all existing posts/jounals inside the database into a visible list.
    public function printJournals(){

        $query = "SELECT * FROM journal";                 //select everything from the table guestbook
        $result = mysqli_query($this->conn, $query);
        //$id = 1; //synligt inkrement för varje inlägg.


       
        //While we have results from the database:
        //Row becomes an assosiative array with the database  data.
        while($row = mysqli_fetch_assoc($result)) {
                  
            //Note: evey post will be associated with an "ID", which is the primary key of that induvidual post (row). The ID will be stored in the Global $_GET array
            echo "<li> <a href = "."readPost.php?ID=" . $row["ID"]." ".">".$row["Date"] . ": ". $row["name"] ."</a></li><hr id = " ."postrow" . ">";
          }
    }

    //function that deletes a post (row) from the database relation "journal"
    //if the global $_GET has the name value of "delete", means that the admin have pressed delete post. and this function will start.
    //$ID is the primary key of that induvidual post (which is set in function printPost), with that value the right row will be deleted from the database: 
    public function deletePost($ID){
        
    // Tar bort en rad från journal med hjälp av primärnyckelns index
    $query = "DELETE FROM journal WHERE ID = '$ID';";
    
    $result = mysqli_query($this->conn, $query) or die("Error: Could not perform querry");
    
    //Cleanse the $_GET array from the old delete value.
    //unset($_GET["delete"]);

    
    header("location:../projektarbete/postDeleted.php");
    exit;
    }

    //stänger av databas connection efter körning av skript.
    public function __destruct() {
        $this->conn->close();
    }
}