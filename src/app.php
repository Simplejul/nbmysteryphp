<h1>Nombre Mystere</h1>

<form action="app.php" method="get">
<label for="choice">
Choisis un nombre entre 0 et 9:
<input type="number" min="0" max="9" name="choice">
</label>
<button type="submit" >Tente ta chance</button>
</form>

<?php
    $tentative = 0;
    $a=$_GET['choice'];
    //$nbRandom;

    class Random
    {
        public $random;

        public function __construct(){
            $this->$random = random_int(0,9);
        }

        public function getRandom(){
            return $this->$random;
        }
    }
    
    class UserChoice
    {
        public $userChoice;
        
        public function __construct(){
            if($_GET['choice'] != null){
                $this->$userChoice = $_GET['choice'];
            }else{
                echo "error to construct object";
            }
        }

        public function getChoice(){
            return $this->$userChoice;
        }
    }

    session_start();

    if (is_null($_SESSION["nbRandom"]) && !isset($a)){
        echo "is not set";
        $newRandom = new Random();
        $nbRandom = $newRandom->getRandom();
        session_start();
        $_SESSION["nbRandom"] = $nbRandom;
        echo "<br />class rd : ".$_SESSION["nbRandom"];
    }else{
        session_start();
        echo "is set : ".$_SESSION["nbRandom"];
    }
    
    if (isset($a) && isset($_SESSION["nbRandom"])){
        session_start();
        $_SESSION['view']=0;

        if(isset($_SESSION['view']) && $_SESSION['view']<3)
        {
            $uChoice = new UserChoice();
            $choice = $uChoice->getChoice();

                if (isset($choice) && $choice === $_SESSION["nbRandom"]){
                    session_start();

                    $_SESSION['view']=$_SESSION['view']+1;
                    echo "Bravo!!! En : ".$_SESSION['view']." tentative(s).";
                }else{
                    $_GET['choice']=null;
                    session_start();

                    $_SESSION['view']=$_SESSION['view']+1;
                    echo "<h3>".$choice."</h3><br />tentative : ".$_SESSION['view'];
                }
        }
    }

?>