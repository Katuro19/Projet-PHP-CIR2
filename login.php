<?php

require './database/requests.php';
require './database/databases.php';

/* you can use this variable to display something different if the connexion failed ! */
if(!$databaseConnected){
    echo "oh no<br>";
}
else 
    echo "yipee<br>";


$test = $Patients->request(0);
print_r($test);

$tempExpert = [
    'id' => 6, 'name' => 'Lazyness professional'

];

$addSuccess = $Expertise->add_with($tempExpert,true,true);
if($addSuccess){
    echo "<br>Lets select the id : ";
    print_r($Expertise->request($tempExpert['id']));
    $Expertise->delete($tempExpert['id'],false,true);
    echo "<br> lets re-select to see :";
    print_r($Expertise->request($tempExpert['id']));
}



?>