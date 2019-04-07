<?php

ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');//
session_start();

$human = array();
$monsters = array();
$tasks = array();

class Sex{
    const MAN = 0;
    const WOMAN = 1;
    const NINJA =2;
}

class Species{
    const MONKEY = 0;
    const DOG = 1;
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



$ceos[] = new Human('man', 100, 'img/man.png', 20,100, Sex::MAN);
$ceos[] = new Human('woman', 100, 'img/woman.png', 20,100, Sex::WOMAN);
$ceos[] = new Human('ninja', 100, 'img/ninja.png', 20,100, Sex::NINJA);


$ceos[] = new Animal('monkey', 100, 'img/monkey.png', 20,100, Species::MONKEY);
$ceos[] = new Animal('dog', 100, 'img/dog.png', 20,100, Species::DOG);


$monsters[] = new Monster('フランケン', 100, 'img/monster01.png', 20);
$monsters[] = new Monster('ドラキュラ', 100, 'img/monster03.png', 20);
$monsters[] = new Monster('ガイコツ', 100, 'img/monster05.png', 20);
$monsters[] = new Monster('ハンド', 100, 'img/monster06.png', 20);


function createMonster($str){
    global $monsters;
    $monster = $monsters[$str];
    $_SESSION['monster'] = $monster;
}

function createHuman($str){
    global $humans;
    $human = $humans[$str];
    $_SESSION['human'] = $human;
}

function createAnimal($str){
    global $animals;
    $animal = $animals[$str];
    $_SESSION['animal'] = $animal;
}

function createCeo($str){
    global $ceos;
    $ceo = $ceos[$str];
    $_SESSION['ceo'] = $ceo;
}

//POST送信がされていた場合
if(!empty($_POST)){
    
    $start_flg = (!empty($_POST['start'])) ? true : false;
    $reset_flg = (!empty($_POST['reset'])) ? true : false;
    $ceo_select_flg = (!empty($_POST['ceo-select']));
//    var_dump($_POST);
    
    if($start_flg){
//        createMonster(1);
        
        
        
//        createHuman(Sex::NINJA);
//        createHuman(Sex::MAN);
//        createHuman(Sex::WOMAN);
//        createAnimal(0);
//        createAnimal(1);
    
    } elseif($reset_flg){
        $_SESSION = array();

    
    }else{
        $select_char_no = (int)$_POST['ceo-select'];
        createCeo($select_char_no);
    }
    
    

}


?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charaset = "utf-8">
    <title>勇者とモンスター</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo date("YmdHis"); ?>">


    </head>
    
    
    <body>
        <header>

        </header>
        <div id="main" class="site-width">

            <!-- キャラクター選択画面-->

            <?php if(!empty($_POST['start'])){ ?>

            <div class="characters-select-area" >
            <h1>キャラクターを選んでね</h1>
            
            
            
            
            <form method="post">
           
                <div id="container-top-characters" class="site-width">
                    <label for="man" class="panel panel-ceo js-panel-select">
                    <input type="radio" name="ceo-select" value="0" id="man">
                    <img class="panel-img" src="img/man.png">
                </label>
                    <label for="woman" class="panel panel-ceo js-panel-select">
                    <input type="radio" name="ceo-select" value="1" id="woman">
                    <img class="panel-img" src="img/woman.png">
                </label>
                    <label for="ninja" class="panel panel-ceo js-panel-select">
                    <input type="radio" name="ceo-select" value="2" id="ninja">
                    <img class="panel-img" src="img/ninja.png">
                </label>
            </div>
            
                <div id="container-bottom-characters" class="site-width">
                
                    <label for="monkey" class="panel panel-ceo js-panel-select">
                    <input type="radio" name="ceo-select" value="3" id="monkey">
                    <img class="panel-img" src="img/monkey.png">
                </label>
                <label for="dog" class="panel panel-ceo js-panel-select">
                    <input type="radio" name="ceo-select" value="4" id="dog">
                    <img class="panel-img" src="img/dog.png">
                </label>
            </div>

                      
<!--                <div class="container-btn" class="site-width">-->

                       <input type="submit" class="btn btn-slect js-btn-prohibid" value="選択" disabled="disabled">
<!--            </div>-->
    
                </form>
            </div>

            <!-- 初期画面の処理-->
            <?php }elseif(!empty($_POST['reset'])){ ?>
                <h1>ここには将来かっこいいアニメーションが入ります</h1>
                <form method="post">
                    <input type="submit" name="start" value="start" class="btn">
                </form>
                
                
            <!-- メインのゲーム画面-->
            <?php }else{ ?>
                <h1>ステータス＆アクション画面</h1>
                <div class="container-game-area">
                    
                <div class="ceo-status-area">
                    <img src="<?php echo $_SESSION['ceo']->getImg() ?>" alt="" class="btn">
                    
                    
                    <div>資金：１００円</div>
                    <div>HP：１００</div>
                    
                    
                    <p>今日は何をしますか？</p>

                    <input type="submit" name="work" value="働く" class="btn">
                    
                    <input type="submit" name="employ" value="雇う" class="btn">
                    
                    <input type="submit" name="find-job" value="仕事を探す" class="btn">

                    
                    <input type="submit" name="" value="">
                    <input type="submit" name="" value="">

                    
                </div>
                
                
                </div>

                

            <?php }?>
        </div>

        <footer class="site-width">
            <form method="post">
                <input type="submit" name="reset" value="reset" class="btn">
            </form>
        </footer>
        <script src="js/vendor/jquery-2.2.2.min.js"></script>
        <script>
            
            
            //キャラクター選択
            var $selectPanel = $('.js-panel-select');
            
            $selectPanel.on('click', function(e){
                $selectPanel.css('border', '5px #F9C80E solid');
                $(this).css('border', '5px red solid');
            });
            
            //ボタン活性化
            var $prohibidBtn = $('.js-btn-prohibid');
            
            $selectPanel.on('click', function(e){
                $prohibidBtn.addClass('js-btn-permit').removeClass('js-btn-prohibid').removeAttr('disabled');
            }); 
            
            
        </script>
        

    </body>

</html>

