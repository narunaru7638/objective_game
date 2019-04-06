<?php

ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');//
session_start();

$human = array();
$monsters = array();
$tasks = array();

class Sex{
    const MAN = 1;
    const WOMAN = 2;
}

class Species{
    const MONKEY = 1;
    const DOG = 2;
}

abstract class Creature{
    
    protected $name;
    protected $hp;
    protected $img;
    protected $processing;
    
    
    public function setName($str){
        $this->name = $str;
    }
    
    public function getName(){
        return $this->name;
    }
    
    
    
    
    
    
    
    public function setHp($str){
        $this->hp = $str;
    }
    
    
    public function getHp(){
        return $this->hp;
    }
    
    
    public function setImg($str){
        $this->img = $str;
    }
    
    
    public function getImg(){
        return $this->img;
    }
    
    public function doTask(){
    }
    
    public function findTask(){
        
    }
    
    
//    abstract public function doTask();

    
    
}

class Ceo extends Creature{
    
    protected $money;
    
    public function __construct($name, $hp, $img, $processing, $money){
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->processing = $processing;
        $this->money = $money;
    }
    
    public function getMoney(){
        return $this->money;
    }
    
    public function setMoney($str){
        $this->money = $str;
    }

    
}

class Human extends Ceo{
    
    protected $sex; 
    public function __construct($name, $hp, $img, $processing, $money, $sex){
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->processing = $processing;
        $this->money = $money;
        $this->sex = $sex;
    }
    
    
    
    public function getSex(){
        return $this->sex;
    }
    
    public function setSex($str){
        $this->sex = $str;
    }

    
//    public function sayCry(){
//        
//    }
////    
//    public function doTask(){
//
//    }
    
}

class Animal extends Ceo{
    
    protected $species;
    public function __constract($name, $hp, $img, $processing, $money, $species){
        $this->name = $name;
        $this->hp - $hp;
        $this->img = $img;
        $this->processing = $processing;
        $this->money = $money;
        $this->species = $species;
    }
    
    public function getSpecies(){
        return $this->species;
    }
    
    public function setSpecies($str){
        $this->species = $str;
    }
    
}


class Monster extends Creature{
    public function __construct($name, $hp, $img, $processing){
        $this->name = $name;
        
        $this->hp = $hp;
        
        $this->img = $img;
        
        $this->processing = $processing;
        
    }
//    public function sayCry(){
//
//    }
////    
//    public function doTask(){
//
//    }


}



$humans[] = new Human('ああああ', 100, 'img/man.png', 20,100, Sex::MAN);
$humans[] = new Human('ミレーユ', 100, 'img/woman.png', 20,100, Sex::WOMAN);
$humans[] = new Human('汚いなさすが忍者きたない', 100, 'img/woman.png', 20,100, Sex::WOMAN);


$animals[] = new Animal('おさるさん', 100, 'img/monkey.png', 20,100, Species::MONKEY);
$animals[] = new Animal('イギー', 100, 'img/dog.png', 20,100, Species::DOG);


$monsters[] = new Monster('フランケン', 100, 'img/monster01.png', 20);
$monsters[] = new Monster('ドラキュラ', 100, 'img/monster03.png', 20);
$monsters[] = new Monster('ガイコツ', 100, 'img/monster05.png', 20);
$monsters[] = new Monster('ハンド', 100, 'img/monster06.png', 20);


function createMonster(){
    global $monsters;
    $monster = $monsters[0];
    $_SESSION['monster'] = $monster;
}

function createHuman(){
    global $humans;
    $human = $humans[1];
    $_SESSION['human'] = $human;
}

function createAnimal(){
    global $animals;
    $animal = $animals[1];
    $_SESSION['animal'] = $animal;
}

if(!empty($_POST)){
    
    $start_flg = (!empty($_POST['start'])) ? true : false;
    
    
    if($start_flg){
        createMonster();
        createHuman();
        createAnimal();
    }
}


?>




<!DOCTYPE html>
<html>
<head>
    <meta charaset = "utf-8">
    <title>勇者とモンスター</title>

    </head>
    <body>
              
       <img src="<?php echo $_SESSION['monster']->getImg(); ?>" alt="">
       <img src="<?php echo $_SESSION['human']->getImg(); ?>" alt="">
        <img src="<?php echo $_SESSION['animal']->getImg(); ?>" alt="">

        <form method="post">
           <input type="submit" name="start" value="start">
        </form>
    </body>

</html>

