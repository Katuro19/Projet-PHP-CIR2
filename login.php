<?php

require './database/requests.php';
require './database/databases.php';

/* you can use this variable to display something different if the connexion failed ! */
if(!$databaseConnected){
    echo "oh no<br>";
}
else 
    echo "yipee<br>";



    


// How a dictionnary is made :
$tempExpert = [
    'id' => 6, 'name' => 'Lazyness professional'

];


$superListOfDictionnary = $Locations->request_all(true,true); //The true true is just to display infos, can be removed

//Lets display every location name :

foreach($superListOfDictionnary as $city ){
    echo "The city is ".$city['name']." and have the postcode ".$city['postcode'].".<br>";
}

?>