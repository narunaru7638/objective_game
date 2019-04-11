<?php

//ログ出力
ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');//

//セッション使用
session_start();

//モンスターと仕事格納用
$monsters = array();
$jobs = array();


//=============================================
//クラス生成
//=============================================
//性別クラス
class Sex{
    const MAN = 1;
    const WOMAN = 2;
    const NINJA = 3;
}
//種族クラス
class Species{
    const MONKEY = 1;
    const DOG = 2;
}

//クリチャークラス（抽象クラス）
abstract class Creature{   
    protected $name;
    protected $hp;
    protected $img;
    protected $processing;
    protected $power;
    protected $charm;
    protected $technique;

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
    public function setProcessing($str){
        $this->processing = $str;
    }
    public function getProcessing(){
        return $this->processing;
    }
    public function setPower($str){
        $this->power = $str;
    }
    public function getPower(){
        return $this->power;
    }
    public function setCharm($str){
        $this->charm = $str;
    }
    public function getCharm(){
        return $this->charm;
    }
    public function setTechnique($str){
        $this->technique = $str;
    }
    public function getTechnique(){
        return $this->technique;
    }
    
    abstract public function doJob($select_job_no);
    
}

//CEO(プレイヤーキャラクター)クラス（抽象クラス）
abstract class Ceo extends Creature{
    protected $money;
    
    public function __construct($name, $hp, $img, $processing, $power, $charm, $technique, $money){
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->processing = $processing;
        $this->power = $power;
        $this->charm = $charm;
        $this->technique = $technique;
        $this->money = $money;
    }
    
    public function getMoney(){
        return $this->money;
    }
    public function setMoney($str){
        $this->money = $str;
    }

    //疲れる
    public function tired(){
        $this->setHp( $this->getHp() - mt_rand(5,10));
    }

    //仕事をする
    public function doJob($select_job_no){
        //仕事の残りを減らす
        $_SESSION[$select_job_no]->setVolume( $_SESSION[$select_job_no]->getVolume() - $_SESSION['ceo']->getProcessing() * mt_rand(8, 15) / 10 );

        //能力に応じてさらに仕事を減らす
        $_SESSION[$select_job_no]->reduceVolume($_SESSION['ceo']);

        if($_SESSION[$select_job_no]->getVolume() >= 0){
            History::set($_SESSION[$select_job_no]->getName().'の業務が残り'.$_SESSION[$select_job_no]->getVolume().'%になりました。');
        }


        //体力の残りを減らす
        $_SESSION['ceo']->setHp( $_SESSION['ceo']->getHp() - mt_rand(5,15));
        
        History::set($_SESSION['ceo']->getName().'のHPが残り'.$_SESSION['ceo']->getHp().'になりました。');

        
    }
}

//ヒューマンクラス
class Human extends Ceo{
    protected $sex; 

    public function __construct($name, $hp, $img, $processing, $power, $charm, $technique, $money, $sex){
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->processing = $processing;
        $this->power = $power;
        $this->charm = $charm;
        $this->technique = $technique;
        $this->money = $money;
        $this->sex = $sex;
    }
    
    public function getSex(){
        return $this->sex;
    }
    public function setSex($str){
        $this->sex = $str;
    }    
}

//アニマルクラス
class Animal extends Ceo{
    protected $species;

    public function __constract($name, $hp, $img, $processing, $power, $charm, $technique, $money, $species){
        $this->name = $name;
        $this->hp - $hp;
        $this->img = $img;
        $this->processing = $processing;
        $this->power = $power;
        $this->charm = $charm;
        $this->technique = $technique;
        $this->money = $money;
        $this->species = $species;
    }
    
    public function getSpecies(){
        return $this->species;
    }
    public function setSpecies($str){
        $this->species = $str;
    }
    
    public function doJob($select_job_no){
        //仕事の残りを減らす
        $_SESSION[$select_job_no]->setVolume( $_SESSION[$select_job_no]->getVolume() - $_SESSION['ceo']->getProcessing()* mt_rand(8, 12) / 10);
        //能力に応じてさらに仕事を減らす
        $_SESSION[$select_job_no]->reduceVolume($_SESSION['ceo']);
        
        if($_SESSION[$select_job_no]->getVolume() >= 0){
            History::set($_SESSION[$select_job_no]->getName().'の業務が残り'.$_SESSION[$select_job_no]->getVolume().'%になりました。');
        }

        
        //体力の残りを減らす
        $_SESSION['ceo']->setHp( $_SESSION['ceo']->getHp() - mt_rand(5,10));
        History::set($_SESSION['ceo']->getName().'のHPが残り'.$_SESSION['ceo']->getHp().'になりました。');

    }
}

//モンスタークラス
class Monster extends Creature{
    public function __construct($name, $hp, $img, $processing, $power, $charm, $technique){
        $this->name = $name;
        $this->hp = $hp;
        $this->img = $img;
        $this->processing = $processing;
        $this->power = $power;
        $this->charm = $charm;
        $this->technique = $technique;
    }
    
    //簡易に描いています
    public function doJob($select_job_no){
        //仕事の残りを減らす
        $_SESSION[$select_job_no]->setVolume( $_SESSION[$select_job_no]->getVolume() - $_SESSION[$_SESSION['select-monster-no']]->getProcessing() * mt_rand(8, 12) / 10);
        //能力に応じてさらに仕事を減らす
        $_SESSION[$select_job_no]->reduceVolume($_SESSION[$_SESSION['select-monster-no']]);

        if($_SESSION[$select_job_no]->getVolume() >= 0){
            History::set($_SESSION[$select_job_no]->getName().'の業務が残り'.$_SESSION[$select_job_no]->getVolume().'%になりました。');
        }

        
        //体力の残りを減らす
        $_SESSION[$_SESSION['select-monster-no']]->setHp( $_SESSION[$_SESSION['select-monster-no']]->getHp() - mt_rand(5,10));

        History::set($_SESSION[$_SESSION['select-monster-no']]->getName().'のHPが残り'.$_SESSION[$_SESSION['select-monster-no']]->getHp().'になりました。');
        
    }
}

//仕事クラス（抽象クラス）
abstract class Job{
    protected $name;
    protected $img;
    protected $volume;
    protected $price;
    
    abstract public function reduceVolume($worker_object);

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
    public function setPrice($str){
        $this->price = $str;
    }
    public function getPrice(){
        return $this->price;
    }
}

//パワー系ジョブクラス
class PowerJob extends Job{
    protected $necessaryPower;
    
    public function __construct($name, $img, $volume, $price, $necessaryPower){
        $this->name = $name;
        $this->img = $img;
        $this->volume = $volume;
        $this->price = $price;
        $this->necessaryPower = $necessaryPower;
    }
    
    public function setNecessaryPower($str){
        $this->necessaryPower = $str;
    }
    public function getNecessaryPower(){
        return $this->necessaryPower;
    }
    
    public function reduceVolume($worker_object){
        if($worker_object->getPower() > $this->getNecessaryPower()){
            $this->setVolume( $this->getVolume() - ($worker_object->getPower() - $this->getNecessaryPower()));
        }
    }
}

// チャーム系ジョブクラス
class CharmJob extends Job{
    protected $necessaryCharm;
    
    public function __construct($name, $img, $volume, $price, $necessaryCharm){
        $this->name = $name;
        $this->img = $img;
        $this->volume = $volume;
        $this->price = $price;
        $this->necessaryCharm = $necessaryCharm;
    }
    
    public function setNecessaryCharm($str){
        $this->necessaryCharm = $str;
    }
    public function getNecessaryCharm(){
        return $this->necessaryCharm;
    }

    public function reduceVolume($worker_object){
        if($worker_object->getCharm() > $this->getNecessaryCharm()){
            $this->setVolume( $this->getVolume() - ($worker_object->getCharm() - $this->getNecessaryCharm()));
        }
    }
}

// テクニック系ジョブクラス
class TechniqueJob extends Job{
    protected $necessaryTechnique;

    public function __construct($name, $img, $volume, $price, $necessaryTechnique){
        $this->name = $name;
        $this->img = $img;
        $this->volume = $volume;
        $this->price = $price;
        $this->necessaryTechnique = $necessaryTechnique;
    }

    public function setNecessaryTechnique($str){
        $this->necessaryTechnique = $str;
    }
    public function getNecessaryTechnique(){
        return $this->necessaryTechnique;
    }

    public function reduceVolume($worker_object){
        if($worker_object->getTechnique() > $this->getNecessaryTechnique()){
            $this->setVolume( $this->getVolume() - ($worker_object->getTechnique() - $this->getNecessaryTechnique()));
        }
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
$ceos[] = new Human('元伝説の勇者', 100, 'img/man.png', 20, 30, 40, 20, 100, Sex::MAN);
$ceos[] = new Human('元女戦士', 120, 'img/woman.png', 20, 50, 20, 10, 100, Sex::WOMAN);
$ceos[] = new Human('きたない忍者', 80, 'img/ninja.png', 40, 20, 20, 40, 100, Sex::NINJA);
$ceos[] = new Animal('そこらへんの猿', 120, 'img/monkey.png', 10, 20, 50, 30, 100, Species::MONKEY);
$ceos[] = new Animal('イギー', 150, 'img/dog.png', 10, 40, 20, 20, 100, Species::DOG);

//モンスターのインスタンス
$monsters[] = new Monster('フランケン', 50, 'img/monster01.png', 20, 50, 20, 20);
$monsters[] = new Monster('ドラキュラ', 20, 'img/monster03.png', 20, 30, 50, 40);
$monsters[] = new Monster('ガイコツ', 50, 'img/monster05.png', 20, 30, 30, 30);
$monsters[] = new Monster('ハンド', 30, 'img/monster06.png', 20, 20, 20, 60);

//仕事のインスタンス
$jobs[] = new TechniqueJob('データ分析','img/job01.png', 100, 20000, 40);
$jobs[] = new TechniqueJob('プログラミング','img/job02.png', 100, 10000, 20);
$jobs[] = new CharmJob('ライブ','img/job03.png', 50, 10000, 40);
$jobs[] = new CharmJob('動画配信','img/job04.png', 80, 8000, 20);
$jobs[] = new PowerJob('漁業','img/job05.png', 150, 10000, 20);
$jobs[] = new PowerJob('登山家','img/job06.png', 200, 20000, 40);
$jobs[] = new TechniqueJob('料理','img/job07.png', 50, 5000, 10);
$jobs[] = new CharmJob('プロレス','img/job08.png', 100, 5000, 30);
$jobs[] = new PowerJob('野球','img/job09.png', 100, 20000, 30);
$jobs[] = new CharmJob('イラスト','img/job10.png', 80, 5000, 10);
$jobs[] = new TechniqueJob('執筆','img/job11.png', 80, 5000, 20);
    
/*====================================
関数など
====================================*/
function createMonster(){
    global $monsters;
    $monster = $monsters[mt_rand(0, 3)];//４種類からランダムに作成
    
    if(empty($_SESSION['monster1'])){
        $_SESSION['monster1'] = $monster;
        History::set($_SESSION['monster1']->getName().'を雇いました。');
        $_SESSION['ceo']->tired();

    }elseif(empty($_SESSION['monster2'])){
        $_SESSION['monster2'] = $monster;
        History::set($_SESSION['monster2']->getName().'を雇いました。');
        $_SESSION['ceo']->tired();

    }elseif(empty($_SESSION['monster3'])){
        $_SESSION['monster3'] = $monster;
        History::set($_SESSION['monster3']->getName().'を雇いました。');
        $_SESSION['ceo']->tired();

    }else{
        History::set('これ以上雇えないよ。');
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
        History::set($_SESSION['job1']->getName().'の仕事を依頼されました。');
        $_SESSION['ceo']->tired();

    }elseif(empty($_SESSION['job2'])){
        $_SESSION['job2'] = $job;
        History::set($_SESSION['job2']->getName().'の仕事を依頼されました。');
        $_SESSION['ceo']->tired();

    }elseif(empty($_SESSION['job3'])){
        $_SESSION['job3'] = $job;
        History::set($_SESSION['job3']->getName().'の仕事を依頼されました。');
        $_SESSION['ceo']->tired();

    }else{
        History::set('これ以上仕事は引き受けられないよ。
        ');
    }
}



//モンスターのHPが0になったときの処理
function monsterHpCheck($monster_no){
    if(!empty($_SESSION[$monster_no]) && $_SESSION[$monster_no]->getHp() <= 0){
        History::set($_SESSION[$monster_no]->getName().'は失踪した');
        $_SESSION[$monster_no] = '';
    }
}

//仕事のボリュームが0になったときの処理
function jobVolumeCheck($job_no){
    if(!empty($_SESSION[$job_no]) && $_SESSION[$job_no]->getVolume() <= 0){
        $income = $_SESSION[$job_no]->getPrice() * mt_rand(8, 12) / 10;
        $_SESSION['ceo']->setMoney( $_SESSION['ceo']->getMoney() + $income);
        History::set($_SESSION[$job_no]->getName().'の仕事が完了しました。');
        History::set($_SESSION[$job_no]->getName().'の仕事で'.$income.'ギル手に入れた');
        $_SESSION[$job_no] = '';
    }
}

//プレイヤーキャラクターの体力が0になったときの処理
function ceoHpCheck($obj_ceo){
    if($obj_ceo->getHp() <= 0){
        $gameover_flg = true;
    }
    return $gameover_flg;
}

//条件分岐のためのフラグを無くす関数
function deleteFlg(){
    $reset_flg = false;
    $ceo_select_flg = false;
    $work_flg = false;
    $employ_flg = false;
    $find_job_flg = false;
    $direct_flg = false;
    //フラグとして使ったセッションを空にする
    $_SESSION['work-select-check'] = '';
    $_SESSION['direct-check'] = '';
    $_SESSION['monster-select-check'] = '';
    $_SESSION['select-monster-no'] = '';


}

//ゲームをリセットする関数
function gameReset(){
    $_SESSION = array();
    deleteFlg();
}

//==========================================
//POST送信がされていた場合
//==========================================
if(!empty($_POST)){
    History::clear();

    //リセットボタンをおしたときのフラグ
    $reset_flg = (!empty($_POST['reset'])) ? true : false;
    //プレイヤーキャラクターを選択したときの不タグ
    $ceo_select_flg = (!empty($_POST['ceo-select'])) ? true : false;
    //働くを押したときのフラグ
    $work_flg = (!empty($_POST['work'])) ? true : false;
    //雇うを押したときのフラグ
    $employ_flg = (!empty($_POST['employ'])) ? true : false;
    //仕事探しを押したときのフラグ
    $find_job_flg = (!empty($_POST['find-job'])) ? true : false;
    //指示するを押したときのフラグ
    $direct_flg = (!empty($_POST['direct'])) ? true : false;
    
    if(!empty($_POST['select-monster'])){
        $select_monster_no = $_POST['select-monster'];
    }

    
    //リセットボタンを押した場合
    if($reset_flg){
        gameReset();

    //プレイヤーキャラクターを決定した場合
    }elseif($ceo_select_flg){
        $select_char_no = (int)$_POST['ceo-select']-1;
        createCeo($select_char_no);
        deleteFlg();

    //雇うを選択した場合
    }elseif($employ_flg){
        History::set('モンスターを雇うのですね。');
        createMonster();
        deleteFlg();

    //仕事探しを選択した場合
    }elseif($find_job_flg){
        History::set('仕事を探すのですね。');
        createJob();
        deleteFlg();

    //働くを選択した場合
    }elseif($work_flg){
        History::set('ご自身で働くのですね。');
        //仕事がない場合
        if(empty($_SESSION['job1']) && empty($_SESSION['job2']) && empty($_SESSION['job3'])){
        History::set('仕事がありません。');
        History::set('まずは仕事を探してみましょう。');
        deleteFlg();
        //仕事がある場合
        }elseif(!empty($_SESSION['job1']) || !empty($_SESSION['job2']) || !empty($_SESSION['job3'])){
        History::set('どの仕事をしましょうか？');
            $_SESSION['work-select-check'] = true;//仕事選択中のフラグを立てる
        }else{
            History::set('エラーが発生しました。');
            deleteFlg();

        }
        
    //仕事選択中のフラグが立っているとき
    }elseif($_SESSION['work-select-check']){
        //仕事を選択した場合
        if(!empty($_POST['select-job'])){
            History::set($_SESSION[$_POST['select-job']]->getName().'の仕事をしました。');
            //仕事をするメソッド
            $_SESSION['ceo']->doJob($_POST['select-job']);
            //フラグとして使ったセッションを空にする
//            $_SESSION['work-select-check'] = '';
            deleteFlg();

        //仕事以外を選択した場合
        }else{
            History::set('それは選択できないよ。');
            History::set('「働く」から押し直してね。');
            //フラグとして使ったセッションを空にする
//            $_SESSION['work-select-check'] = '';
            deleteFlg();

        }
    //指示するを選択した場合
    }elseif($direct_flg){
        History::set('モンスターに指示をするのですね。');

        //モンスターがいない場合
        if(empty($_SESSION['monster1']) && empty($_SESSION['monster2']) && empty($_SESSION['monster3'])){
            History::set('指示できるモンスターがいません。');
            History::set('まずはモンスターを雇ってみましょう。');
            deleteFlg();

        //仕事がない場合
        }elseif((!empty($_SESSION['monster1']) || !empty($_SESSION['monster2']) || !empty($_SESSION['monster3'])) && (empty($_SESSION['job1']) && empty($_SESSION['job2']) && empty($_SESSION['job3']))){
            History::set('モンスターができる仕事がありません。');
            History::set('まずは仕事を探してみましょう。');
            deleteFlg();

        //モンスターも仕事もある場合
        }elseif((!empty($_SESSION['monster1']) || !empty($_SESSION['monster2']) || !empty($_SESSION['monster3'])) && (!empty($_SESSION['job1']) || !empty($_SESSION['job2']) || !empty($_SESSION['job3']))){
//            History::clear();
            History::set('どのモンスターに指示を出しますか？');
            //モンスターに指示可能状態のフラグを立てる
            $_SESSION['direct-check'] = true;

        }else{
            History::set('エラーが発生しました。');
            deleteFlg();

        }
    //モンスターに指示可能状態のフラグが立っているとき
    }elseif($_SESSION['direct-check']){
        //モンスターを選択した場合
        if(!empty($_POST['select-monster'])){
            History::set($_SESSION[$_POST['select-monster']]->getName().'は何をしましょうか？');
            //どのモンスターに指示を出そうとしているかの情報をセッションに格納
            $_SESSION['select-monster-no'] = $_POST['select-monster'];
            //選んだモンスターが仕事可能状態のフラグを立てる
            $_SESSION['monster-select-check'] = true;
            
        //選んだモンスターが仕事可能状態のフラグが立っている
        }elseif($_SESSION['monster-select-check']){
            //仕事を選択した場合
            if(!empty($_POST['select-job'])){
                History::set($_SESSION[$_SESSION['select-monster-no']]->getName().'は'.$_SESSION[$_POST['select-job']]->getName().'の仕事をしました。');

                //指示した分プレイヤーは披露
                $_SESSION['ceo']->tired();
                //モンスターが仕事をするメソッド
                $_SESSION[$_SESSION['select-monster-no']]->doJob($_POST['select-job']);
                
                //使ったセッションを空にする
                deleteFlg();
            //仕事以外を選択した場合
            }else{
                History::set('それは選択できないよ。');
                History::set('「指示する」から押し直してね。');
                //使ったセッションを空にする
                deleteFlg();
            }
        //モンスター以外を選択した場合
        }else{
            History::set('それは選択できないよ。');
            History::set('「指示する」から押し直してね。');
            //フラグとして使ったセッションを空にする
            deleteFlg();
        }
    }else{
        History::set('それは選択できないよ');
        deleteFlg();
    }
}
//=======================================    
//ターン終了時の判定
//=======================================    
    

    //モンスターのHPが0かチェック
    monsterHpCheck('monster1');
    monsterHpCheck('monster2');
    monsterHpCheck('monster3');

    //仕事のボリュームが0かチェック
    jobVolumeCheck('job1');
    jobVolumeCheck('job2');
    jobVolumeCheck('job3');

    //プレイヤーのHPが0かチェック
    if(!empty($_SESSION['ceo'])){
        $gameover_flg = ceoHpCheck(($_SESSION['ceo']));
    }




?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charaset = "utf-8">
    <title>勇者とモンスター</title>
    <link rel="stylesheet" type="text/css" href="style.css?<?php echo date("YmdHis"); ?>">
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
    
    
    <body>
        <header>

        </header>
        <div id="main" class="site-width">

            <!-- キャラクター選択画面-->

            <?php if(!empty($_POST['reset'])){ ?>

            <div class="characters-select-area" >
                <h1>キャラクターせんたく</h1>
                <div class="charcter-profile-area">
                    
                    
                    
                </div>
                <form method="post">
                    
                    <div id="container-top-characters" class="site-width">
                        <label for="man" class="panel panel-ceo js-panel-select">
                            <input type="radio" name="ceo-select" value="1" id="man">
                            <img class="panel-img" src="img/man.png">
                        </label>
                        <label for="woman" class="panel panel-ceo js-panel-select">
                            <input type="radio" name="ceo-select" value="2" id="woman">
                            <img class="panel-img" src="img/woman.png">
                        </label>
                        <label for="ninja" class="panel panel-ceo js-panel-select">
                            <input type="radio" name="ceo-select" value="3" id="ninja">
                            <img class="panel-img" src="img/ninja.png">
                        </label>
                    </div>
            
                    <div id="container-bottom-characters" class="site-width">
                
                        <label for="monkey" class="panel panel-ceo js-panel-select">
                            <input type="radio" name="ceo-select" value="4" id="monkey">
                            <img class="panel-img" src="img/monkey.png">
                        </label>
                        <label for="dog" class="panel panel-ceo js-panel-select">
                            <input type="radio" name="ceo-select" value="5" id="dog">
                            <img class="panel-img" src="img/dog.png">
                        </label>
                    </div>

                      
                    <input type="submit" class="btn btn-slect js-btn-prohibid" value="選択" disabled="disabled">
                </form>
            </div>

           
            <!-- ゲームオーバー画面の処理-->
            <?php }elseif($gameover_flg){ ?>
            <div class="gameover-screen" >
                <h1>ゲームオーバー</h1>
                <p><?php echo$_SESSION['ceo']->getName(); ?>のHPが0になりました。</p>
                <p>あなたの記録は<i class="fas fa-coins"></i><?php echo$_SESSION['ceo']->getMoney(); ?>ギルです。</p>
                <p>遊んでくれてありがとう！また遊んでね！</p>

                
            </div>

                
            <!-- メインのゲーム画面-->
            <?php }else{ ?>
                <div class="container-game-area">

                     <h1>ステータス＆アクション</h1>
                    
                    <!-- プレイヤーステータス -->
                    <div class="ceo-status-area">
                        <img src="<?php echo $_SESSION['ceo']->getImg() ?>" alt="" class="btn">
                        <div class="status-area">
                            <div class="status-area-top">
                                <div><?php echo $_SESSION['ceo']->getName() ?></div>
                            </div>
                            <div class="status-area-bottom">
                                <div><i class="fas fa-coins"></i>：<?php echo $_SESSION['ceo']->getMoney() ?>ギル</div>
                                <div><i class="fas fa-heart"></i>：<?php echo $_SESSION['ceo']->getHp() ?></div>
                            </div>
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
                                <?php 
                                    if(!empty($_SESSION["monster1"])){
                                        $img_monster1 = $_SESSION["monster1"]->getImg();
                                    }else{
                                        $img_monster1 = 'img/lock2.png';
                                    }
                                ?>
                                <?php     if(!empty($_SESSION["monster1"])): 
                                ?>
                                <input class=input-monster-img type="submit" name="select-monster" alt="送信する" value="monster1">
                                <?php 
                                endif;
                                ?>
                                <img src="<?php echo $img_monster1; ?>" alt="">
                                
                                
                                
                                <div class="monster-hp"><?php if(!empty($_SESSION["monster1"])) echo $_SESSION["monster1"]->getName()."&nbsp;HP:".$_SESSION["monster1"]->getHp() ?></div>
                            </form>
                            <form method="post">
<!--                                <input type="hidden" name="select-monster" value="2">-->
                                <?php 
                                    if(!empty($_SESSION["monster2"])){
                                        $img_monster2 = $_SESSION["monster2"]->getImg();
                                    }else{
                                        $img_monster2 = 'img/lock2.png';
                                    }
                                ?>
                                
                                <?php     if(!empty($_SESSION["monster2"])): 
                                ?>
                                <input class=input-monster-img type="submit" name="select-monster" alt="送信する" value="monster2">
                                <?php 
                                endif;
                                ?>

                                
                                
                                <img src="<?php echo $img_monster2; ?>" alt="">

                                <div class="monster-hp"><?php if(!empty($_SESSION["monster2"])) echo $_SESSION["monster2"]->getName()."&nbsp;HP:".$_SESSION["monster2"]->getHp() ?></div>

                            </form>
                            <form method="post">
<!--                                <input type="hidden" name="select-monster" value="3">-->
                                <?php 
                                    if(!empty($_SESSION["monster3"])){
                                        $img_monster3 = $_SESSION["monster3"]->getImg();
                                    }else{
                                        $img_monster3 = 'img/lock2.png';
                                    }
                                ?>
                                
                                
                                <?php     if(!empty($_SESSION["monster3"])): 
                                ?>
                                <input class=input-monster-img type="submit" name="select-monster" alt="送信する" value="monster3">
                                <?php 
                                endif;
                                ?>

                                
                                <img src="<?php echo $img_monster3; ?>" alt="">

                                <div class="monster-hp"><?php if(!empty($_SESSION["monster3"])) echo $_SESSION["monster3"]->getName()."&nbsp;HP:".$_SESSION["monster3"]->getHp() ?></div>


                            </form>
                        </div>

                    </div>
                    <!-- ジョブ選択-->
                    <div class="job-area">
                        <div class="job-form-container">
                            <form method="post">

<!--                                <input type="hidden" name="select-job" value="1">-->
                                
                                <?php 
                                    if(!empty($_SESSION["job1"])){
                                        $img_job1 = $_SESSION["job1"]->getImg();
                                    }else{
                                        $img_job1 = 'img/lock1.png';
                                    }
                                ?>


                                
                                <?php     if(!empty($_SESSION["job1"])): 
                                ?>
                                <input type="submit" name="select-job" alt="送信する" value="job1">
                                <?php 
                                endif;
                                ?>

                                
                                
                                
                                <img src="<?php echo $img_job1; ?>" alt="">

                                <div class="job-volume"><?php if(!empty($_SESSION["job1"])) echo $_SESSION["job1"]->getName()."&nbsp;残り:".$_SESSION["job1"]->getVolume()."%" ?></div>

                            </form>

                            <form method="post">

<!--                                <input type="hidden" name="select-job" value="2">-->
                                
                                <?php 
                                    if(!empty($_SESSION["job2"])){
                                        $img_job2 = $_SESSION["job2"]->getImg();
                                    }else{
                                        $img_job2 = 'img/lock1.png';
                                    }
                                ?>

                                
                                <?php     if(!empty($_SESSION["job2"])): 
                                ?>
                                <input type="submit" name="select-job" alt="送信する" value="job2">
                                <?php 
                                endif;
                                ?>
                                <img src="<?php echo $img_job2; ?>" alt="">

                                
                                <div class="job-volume"><?php if(!empty($_SESSION["job2"])) echo $_SESSION["job2"]->getName()."&nbsp;残り:".$_SESSION["job2"]->getVolume()."%" ?></div>

                            </form>

                            <form method="post">

<!--                                <input type="hidden" name="select-job" value="3">-->
                                
                                <?php 
                                    if(!empty($_SESSION["job3"])){
                                        $img_job3 = $_SESSION["job3"]->getImg();
                                    }else{
                                        $img_job3 = 'img/lock1.png';
                                    }
                                ?>


                                <?php     if(!empty($_SESSION["job3"])): 
                                ?>
                                <input type="submit" name="select-job" alt="送信する" value="job3">
                                <?php 
                                endif;
                                ?>
                                <img src="<?php echo $img_job3; ?>" alt="">

                                
                                <div class="job-volume"><?php if(!empty($_SESSION["job3"])) echo $_SESSION["job3"]->getName()."&nbsp;残り:".$_SESSION["job3"]->getVolume()."%" ?></div>


                            </form>
                        </div>
                    </div>
                
                </div>

                

            <?php }?>
        </div>

        <footer id="footer" class="site-width">
            <form method="post">
                <input type="submit" name="reset" value="reset" class="btn">
            </form>
        </footer>
        <script src="js/vendor/jquery-2.2.2.min.js"></script>
        <script>
            // フッターの高さを揃える
            $(function(){
                var $ftr = $('#footer');
                if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
                    $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
                }
            });
            
            //キャラクター選択
            var $selectPanel = $('.js-panel-select');
            
            $selectPanel.on('click', function(e){
                $selectPanel.css('border', '5px rgba(0,0,0,0) solid');
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

