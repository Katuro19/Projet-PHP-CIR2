<?php

require './database/requests.php';
require './database/databases.php';

/* you can use this variable to display something different if the connexion failed ! */
if(!$databaseConnected){
    echo "oh no";
}
else 
    echo "yipee";




?>