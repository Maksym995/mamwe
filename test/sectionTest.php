<?php

use model\mappingClass\MappingSection;
use model\managerClass\ManagerSection;


// require de la config:
require_once "../config.php";


// require_once "../vendor/autoload.php"; -> Appel des dépendances qui gèrent les mails


// Autoload des classes (/model/) :
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require '../' . $class . '.php';
});

try {
    
    $db = new PDO(DB_TYPE.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset='.DB_CHARSET,DB_LOGIN,DB_PWD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
}catch(Exception $e){
    
    //die($e->getMessage());
    echo $e->getMessage();
    echo "<br>";
}

$test1 = new MappingSection([
    "mwIdSect" => 1,
    "mwTitleSect" => "test",
    "mwContentSect" => "test",
    "mwVisible" => "test",
    "mwPictureMwIdPicture" => 1
]);

try{
    $test2 = new MappingSection([
        "mwTitleSect" => "pipi",
    ]);

}catch (Exception $e){
    echo $e;
}

// var_dump($test1);



$sectionTest = new ManagerSection($db);
$sectionTestRequete = $sectionTest -> getAll();
// var_dump($sectionTestRequete);

foreach($sectionTestRequete as $item){
    echo $item -> getMwIdSect();
    echo $item -> getMwTitleSect();

    if(is_null($item->getPicture())){

        echo "yapa photos";

    }else{
        $picture = $item -> getPicture();
        $pic = explode("|||", $picture);
        echo $pic[0];
        ?>
        <br>
        <img src='<?= $pic[1]?>' width='200px'>
        <?php
        echo "<br>";
    }
}

$sectionInsert4 = $sectionTest-> insertSection("photo1", "https://cdn-s-www.lalsace.fr/images/ED82BE29-CBAC-40EC-B71C-285CD717A43C/NW_raw/la-voiture-noire-de-bugatti-modele-unique-photo-dr-1608828241.jpg", 1, 1, "après après", "petit text", 1);

var_dump($sectionInsert4);