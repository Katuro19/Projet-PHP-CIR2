<?php

class db{
    /* This class is made to make db interaction faster
    Each table of your database can have its own instance of this class

    How to create an instance of the class : 

    // Let's imagine our database Users with the table user.
    $Users = new db($conn,'user','id');
    //The $conn is your connection instance and must be created before.
    // The 'user' is my table name.
    // The 'id' is the primary key of my table. this doesn't have to be called id everytime. 
    //If you don't enter the primary key, you may have error if two datas are not unique.

    How to use the class :

    //Folowing our user exemple, if i want all the datas of the user with the primary key (ex, username) being CoolUser19
    $myUser = 'CoolUser19';
    $fetched_data = $User->db_request($myUser); //For those who are asking, what is $User, please read the doc again
    //To display my username :
    echo $fetched_data['username']; //The name between ' must be a valid key.

    / -------------------------------- \
    More info on the class :
    Private variables :

    mainTable : Table choosed in the constructor.
    conn : The connection given.
    primaryKey : The key given.

    Function of the class:

    - __construct (public)
    - request (public)
    - request_if (public)
    - add_with (public)

    \ -------------------------------- /

    */

    private $mainTable;
    private $conn;
    private $primaryKey;

    //CONSTRUCTOR
    public function __construct($connectionInfo, $table, $primaryKey_){
        $this->mainTable = $table;
        $this->conn = $connectionInfo;
        $this->primaryKey = $primaryKey_;
    }



    public function request($id, $verbose = false, $details = false){
        /* Return the line corresponding to the parameter (can lead to fatal error if not unique)
        ARGS : id, verbose=false, details=false
        - Fetched : YES

        In case of failure, return NULL
        Verbose will display informations about the failure
        Details will display informations about the queries
        */

        try {
        $query = "SELECT * FROM ".$this->mainTable." WHERE ".$this->primaryKey." = ?;";
        if($details)
            echo "<br>Requested query : ".$query."<br>ID is ".$id;

        $request = ($this->conn)->prepare($query);
        if($details)
            echo "<br>The prepare is done";

        $request->bindParam(1, $id); 
        if($details)
            echo "<br>ID bind successfull"; 

        $request->execute();

        $result = $request->fetch(PDO::FETCH_ASSOC);
        if($details)
            echo "<br>Request executed and fetched"; 
        
        
        return $result;

        }
        catch(PDOException $e){
            if($verbose)
                echo "Error on request function : ".$e->getMessage();
            return NULL;
        }
    }


    public function request_if($column,$value,$verbose=false,$details=false){
        /* Return an array of array containing all the lines (fetched) of the database that valide the condition
        ARGS : column,value,verbose=false,details=false
        - Fetched : YES

        In case of failure, return an empty array
        Verbose will display informations about the failure
        Details will display informations about the queries
        */
        try {
            
            $query = "SELECT * FROM ".$this->mainTable." WHERE ".$column." = ?;";
            if($details)
            echo "<br>Requested query : ".$query."<br>The column to check the condition on is ".$column." and the condition is =".$value;

            $request = ($this->conn)->prepare($query);
            if($details)
                echo "<br>The prepare is done";

            $request->bindParam(1, $value); 
            if($details)
                echo "<br>".$value." bind successfull"; 

            $request->execute();

            $result = $request->fetchAll(PDO::FETCH_ASSOC);
            if($details)
                echo "<br>Request executed and fetched"; 
            
            
            return $result;
        }
        catch(PDOException $e){
            if($verbose)
                echo "Error on request_if function : ".$e->getMessage();
            return [];            
        } 
    }

    public function add_with($values,$verbose=false,$details=false){
        /* Will add a line in the database with the give values. The given values must be in an dictionnary and in order they want to be inserted
        ARGS : $values,verbose=false,$details=false
        - Fetched : NaN

        Exemple of call :
        $myDatas = [
            "data1" => 1, "data2" => 2            
        ];
        $success = MyDatabase.add_with($myDatas,false,true);
        if($success){
            ... //Code when the datas are added
        }

        In case of failure, return 0, and if case of success, return 1
        Verbose will display informations about the failure
        Details will display informations about the queries
        */
        try {

            // get the columns
            $columns = array_keys($values);
            
            // get the values
            $datas = array_values($values);

            $query = "INSERT INTO ".$this->mainTable." (".implode(',',$columns).") VALUES (".implode(',', $datas).")"; //the implode will cut my array into the values !
            if($details)
            echo "<br>Requested query : ".$query;

            $request->execute();

            $result = $request->fetchAll(PDO::FETCH_ASSOC);
            if($details)
                echo "<br>Request executed and fetched"; 
            
            
            return $result;
            
        }
        catch(PDOException $e){
            if($verbose)
                echo "Error on request_if function : ".$e->getMessage();
            return [];            
        } 
    }




}

?>

