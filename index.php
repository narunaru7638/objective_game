<?php

//ログ出力
ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');//

//セッション使用
session_start();

//モンスターと仕事格納用
$monsters = array();
$jobs = array();

//
class Sex{
    const MAN = 0;
    const WOMAN = 1;
    const NINJA =2;
}

class Species{
    const MONKEY = 0;
    const DOG = 1;
}

//
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

abstract class Job{
    protected $name;
    protected $img;
    protected $volume;
    protected $necessaryPower;
    protected $necessaryCharm;
    protected $necessaryTechnique;
    
    abstract public function reduceVolume();

    public function setName($str){
        $this->name = $str;
    }

    public function getName(){
        return $this->name;
    }

    public function setImg($str){
        $this->img = $str;
    }

    public function getImg(){
        return $this->img;
    }

    
    
    public function setVolume($str){
        $this->volume = $str;
    }
    
    public function getVolume(){
        return $this->volume;
    }
    
    public function setNecessaryPower($str){
        $this->necessaryPower = $str;
    }

    public function getNecessaryPower(){
        return $this->necessaryPower;
    }
    
    public function setNecessaryCharm($str){
        $this->necessaryCharm = $str;
    }

    public function getNecessaryCharm(){
        return $this->necessaryCharm;
    }
    
    public function setNecessaryTechnique($str){
        $this->necessaryTechnique = $str;
    }

    public function getNecessaryTechnique(){
        return $this->necessaryTechnique;
    }
}


//パワー系ジョブクラス
class PowerJob extends Job{
    public function __constract($name, $img, $volume, $necessaryPower, $necessaryCharm, $necessaryTechnique){
        $this->name = $name;
        $this->img = $img;
        $this->volume = $volume;
        $this->necessaryPower = $necessaryPower;
        $this->necessaryCharm = $necessaryCharm;
        $this->necessaryTechnique = $necessaryTechnique;
    }
    public function reduceVolume(){
    }
}


class CharmJob extends Job{
    public function __constract($name, $img, $volume, $necessaryPower, $necessaryCharm, $necessaryTechnique){
        $this->name = $name;
        $this->img = $img;
        $this->volume = $volume;
        $this->necessaryPower = $necessaryPower;
        $this->necessaryCharm = $necessaryCharm;
        $this->necessaryTechnique = $necessaryTechnique;
    }
    public function reduceVolume(){
    }
}

class TechniqueJob extends Job{
    public function __constract($name, $img, $volume, $necessaryPower, $necessaryCharm, $necessaryTechnique){
        $this->name = $name;
        $this->img = $img;
        $this->volume = $volume;
        $this->necessaryPower = $necessaryPower;
        $this->necessaryCharm = $necessaryCharm;
        $this->necessaryTechnique = $necessaryTechnique;
    }
    public function reduceVolume(){
    }
}



//インターフェース（抽象メソッドのみ定義）
interface HistoryInterface{
    public static function set($str);
    public static function clear();
}

//履歴管理クラス(インスタンス化して増やす必要がないのでstatic)
class History implements HistoryInterface{        
    public static function set($str){
        if(empty($_SESSION['history'])) $_SESSION['history'] = '';
        $_SESSION['history'] .= $str.'<br>';
    }
    
    public static function clear(){
        unset($_SESSION['history']);
    }
}

/*====================================
インスタンス生成
====================================*/
//CEOのインスタンス
$ceos[] = new Human('man', 100, 'img/man.png', 20,100, Sex::MAN);
$ceos[] = new Human('woman', 100, 'img/woman.png', 20,100, Sex::WOMAN);
$ceos[] = new Human('ninja', 100, 'img/ninja.png', 20,100, Sex::NINJA);
$ceos[] = new Animal('monkey', 100, 'img/monkey.png', 20,100, Species::MONKEY);
$ceos[] = new Animal('dog', 100, 'img/dog.png', 20,100, Species::DOG);

//モンスターのインスタンス
$monsters[] = new Monster('フランケン', 100, 'img/monster01.png', 20);
$monsters[] = new Monster('ドラキュラ', 100, 'img/monster03.png', 20);
$monsters[] = new Monster('ガイコツ', 100, 'img/monster05.png', 20);
$monsters[] = new Monster('ハンド', 100, 'img/monster06.png', 20);

//
$jobs[] = new PowerJob('データ分析','img/job01.png', 100, 0, 0, 0);
$jobs[] = new PowerJob('プログラミング','img/job02.png', 100, 0, 0, 0);
$jobs[] = new CharmJob('ライブ','img/job03.png', 100, 0, 0, 0);
$jobs[] = new CharmJob('動画配信','img/job04.png', 100, 0, 0, 0);
$jobs[] = new PowerJob('漁業','img/job05.png', 100, 0, 0, 0);
$jobs[] = new PowerJob('登山家','img/job06.png', 100, 0, 0, 0);
$jobs[] = new TechniqueJob('料理','img/job07.png', 100, 0, 0, 0);
$jobs[] = new TechniqueJob('プロレス','img/job08.png', 100, 0, 0, 0);
$jobs[] = new PowerJob('野球','img/job09.png', 100, 0, 0, 0);
$jobs[] = new TechniqueJob('イラスト','img/job10.png', 100, 0, 0, 0);
$jobs[] = new TechniqueJob('執筆','img/job11.png', 100, 0, 0, 0);



    
/*====================================
関数など
====================================*/

function createMonster(){
    global $monsters;
    $monster = $monsters[mt_rand(0, 3)];//４種類からランダムに作成
    
    if(empty($_SESSION['monster1'])){
        $_SESSION['monster1'] = $monster;
    }elseif(empty($_SESSION['monster2'])){
        $_SESSION['monster2'] = $monster;
    }elseif(empty($_SESSION['monster3'])){
        $_SESSION['monster3'] = $monster;
    }else{
        
    }
}

function createCeo($str){
    global $ceos;
    $ceo = $ceos[$str];
    $_SESSION['ceo'] = $ceo;
}

function createJob(){
    global $jobs;
    $job = $jobs[mt_rand(0, 10)];//11種類からランダムに作成

    if(empty($_SESSION['job1'])){
        $_SESSION['job1'] = $job;
    }elseif(empty($_SESSION['job2'])){
        $_SESSION['job2'] = $job;
    }elseif(empty($_SESSION['job3'])){
        $_SESSION['job3'] = $job;
    }else{

    }

    
}

//POST送信がされていた場合
if(!empty($_POST)){
    
    $start_flg = (!empty($_POST['start'])) ? true : false;
    $reset_flg = (!empty($_POST['reset'])) ? true : false;
    $ceo_select_flg = (!empty($_POST['ceo-select'])) ? true : false;
    $work_flg = (!empty($_POST['work'])) ? true : false;
    $employ_flg = (!empty($_POST['employ'])) ? true : false;
    $find_job_flg = (!empty($_POST['find-job'])) ? true : false;
    $direct_flg = (!empty($_POST['direct'])) ? true : false;
    

    var_dump($_SESSION['monster1']);
    var_dump($_SESSION['monster2']);
    var_dump($_SESSION['monster3']);

    var_dump($_SESSION['job1']);
    var_dump($_SESSION['job2']);
    var_dump($_SESSION['job3']);

    
    
    if($start_flg){
    
    } elseif($reset_flg){
        $_SESSION = array();

    
    }elseif($ceo_select_flg){
        $select_char_no = (int)$_POST['ceo-select'];
        createCeo($select_char_no);
    }elseif($work_flg){
        History::set('働くのですね！どの仕事をしようか？');
        
        $_SESSION['work-select-check'] = true;

        
        
    }elseif($employ_flg){
        History::set('モンスターを雇うのですね');
        createMonster();
        
        
        
    }elseif($find_job_flg){
        History::set('仕事を探してこよう');
        createJob();

    }elseif($direct_flg){
        History::set('どのモンスターに指示を出しますか？');
        $_SESSION['direct-check'] = true;
    
    }elseif($_SESSION['direct-check']){
        $select_monster_flg = (!empty($_POST['select-monster'])) ? true : false;
        History::set('モンスターは何をしようか？');
        $_SESSION['direct-check'] = '';
        $_SESSION['monster-select-check'] = true;

    }elseif($_SESSION['work-select-check'] || $_SESSION['monster-select-check']){
        $select_job_flg = (!empty($_POST['select-job'])) ? true : false;

        if($select_job_flg){
            History::set('仕事をします');
            $_SESSION['monster-select-check'] = '';
            $_SESSION['work-select-check'] = '';
        }
        



//        $_SESSION['monster-select-check'] = true;

    }else{
        History::set('aaaa');

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
                <div class="charcter-profile-area">
                    
                    
                    
                </div>
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

                      
                    <input type="submit" class="btn btn-slect js-btn-prohibid" value="選択" disabled="disabled">
                </form>
            </div>

            <!-- 初期画面の処理-->
            <?php }elseif(!empty($_POST['reset'])){ ?>
                <div class="initial-screen" >
                    <h1>ここには将来かっこいいアニメーションが入ります</h1>
                    <form method="post">
                        <input type="submit" name="start" value="start" class="btn">
                    </form>
                </div>
                
            <!-- メインのゲーム画面-->
            <?php }else{ ?>
                <div class="container-game-area">

                     <h1>ステータス＆アクション画面</h1>
                    
                    <!-- プレイヤーステータス -->
                    <div class="ceo-status-area">
                        <img src="<?php echo $_SESSION['ceo']->getImg() ?>" alt="" class="btn">
                        <div class="status-area">
                            <div class="status-area-top">
                                <div><?php echo $_SESSION['ceo']->getName() ?></div>
                                <div>残り期間</div>
                            </div>
                            <div>資金：<?php echo $_SESSION['ceo']->getMoney() ?>円</div>
                            <div>HP：<?php echo $_SESSION['ceo']->getHp() ?></div>
                        </div>
                    </div>

                    <!-- メッセージエリア -->
                    <div class="message-area js-auto-scroll">
                            <p>今日は何をしますか？</p>

                        <p><?php echo (!empty($_SESSION['history'])) ? $_SESSION['history'] : ''; ?></p>
                    </div>

                    <!-- コマンド選択-->
                    <div class="container-command">
                        <form method="post">
                            <input type="submit" name="work" value="働く" class="btn">

                            <input type="submit" name="employ" value="雇う" class="btn">

                            <input type="submit" name="find-job" value="仕事探し" class="btn">
                            
                            
                            <input type="submit" name="direct" value="指示する" class="btn">

                        </form>

                    </div>
                    <!-- モンスター選択-->
                    <div class="monster-area">
                        <div class="monster-form-container"> 
                            <form method="post">
                               <input type="hidden" name="select-monster" value="1">

                                <input type="image" src="<?php if(!empty($_SESSION["monster1"])) echo $_SESSION["monster1"]->getImg() ?>" name="select-monster" alt="送信する" value="test">
                            </form>
                            <form method="post">
                                <input type="hidden" name="select-monster" value="2">

                                <input type="image" src="<?php if(!empty($_SESSION["monster2"])) echo $_SESSION["monster2"]->getImg() ?>" name="select-monster" alt="送信する" value="test">
                            </form>
                            <form method="post">
                                <input type="hidden" name="select-monster" value="3">

                                <input type="image" src="<?php if(!empty($_SESSION["monster3"])) echo $_SESSION["monster3"]->getImg() ?>" name="select-monster" alt="送信する" value="test">

                            </form>
                        </div>

                    </div>
                    <!-- ジョブ選択-->
                    <div class="job-area">
                        <div class="job-form-container">
                            <form method="post">

                                <input type="hidden" name="select-job" value="1">

                                <input type="image" src="<?php if(!empty($_SESSION["job1"])) echo $_SESSION["job1"]->getImg() ?>" name="select-job" alt="送信する" value="test">
                            </form>

                            <form method="post">

                                <input type="hidden" name="select-job" value="2">

                                <input type="image" src="img/job04.png" name="select-job" alt="送信する" value="test">
                            </form>

                            <form method="post">

                                <input type="hidden" name="select-job" value="3">

                                <input type="image" src="img/job10.png" name="select-job" alt="送信する" value="test">

                            </form>
                        </div>
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
            
            
            //自動スクロール
            var $scrollAuto = $('.js-auto-scroll');
            $scrollAuto.animate({scrollTop: $scrollAuto[0].scrollHeight}, 'fast');
//            height = $('.js-auto-scroll')[0].scrollHeight;
            height = $scrollAuto[0].scrollHeight;

        </script>
        

    </body>

</html>

