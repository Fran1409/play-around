<?php

class RockPaperScissors
{
    public $computerPick;

    public function __construct()
    {
        if(!empty($_SESSION['computerPick'])){
            $this->computerPick = $_SESSION['computerPick'];
        }
    }


    public function run()
    {
        // This function functions as your game "engine"
        // Now it's on to you to take the steering wheel and determine how it will work
        
        if(empty($this->computerPick)){
            $this->getComputerPick();
        }
        
        if(!empty($_POST['playagain'])){
            $this->playAgain();
        }

        
        echo $this->computerPick;
        echo $_SESSION['computerPick'];
       
    }

    public function getComputerPick()
    {
        $i = rand(1, 4);
        if ($i == 1){
            $this->computerPick = 'ROCK';
        } else if ($i == 2){
            $this->computerPick = 'SCISSORS';
        } else if ($i == 3){
            $this->computerPick = 'PAPER';
        } else if ($i == 4){
            $this->computerPick = 'FIRE';
        }
        $_SESSION['computerPick'] = $this->computerPick;
    }

    public function playAgain(){
        $this->computerPick = '';
        $_SESSION['computerPick'] = '0';
        $this->getComputerPick();
    }
}