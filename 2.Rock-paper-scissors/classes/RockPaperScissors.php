<?php

class RockPaperScissors
{
    public $computerPick;
    public $result;

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

        if(!empty($_POST['rock']) || !empty($_POST['paper']) || !empty($_POST['scissors']) || !empty($_POST['fire'])){
            $this->comparePicks();
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

    public function comparePicks()
    {
        switch(true){
            case(!empty($_POST['rock']) && $this->computerPick == 'ROCK'):
                $this->playerTies();
                break;

            case(!empty($_POST['rock']) && $this->computerPick == 'PAPER'):
                $this->playerLoses();
                break;

            case(!empty($_POST['rock']) && $this->computerPick == 'SCISSORS'):
                $this->playerWins();
                break;

            case(!empty($_POST['rock']) && $this->computerPick == 'FIRE'):
                $this->playerLoses();
                break;

            case(!empty($_POST['paper']) && $this->computerPick == 'ROCK'):
                $this->playerWins();
                break;

            case(!empty($_POST['paper']) && $this->computerPick == 'PAPER'):
                $this->playerTies();
                break;

            case(!empty($_POST['paper']) && $this->computerPick == 'SCISSORS'):
                $this->playerLoses();
                break;

            case(!empty($_POST['paper']) && $this->computerPick == 'FIRE'):
                $this->playerLoses();
                break;

            case(!empty($_POST['scissors']) && $this->computerPick == 'ROCK'):
                $this->playerLoses();
                break;

            case(!empty($_POST['scissors']) && $this->computerPick == 'PAPER'):
                $this->playerWins();
                break;

            case(!empty($_POST['scissors']) && $this->computerPick == 'SCISSORS'):
                $this->playerTies();
                break;
            
            case(!empty($_POST['scissors']) && $this->computerPick == 'FIRE'):
                $this->playerLoses();
                break;

            case(!empty($_POST['fire']) && $this->computerPick == 'FIRE'):
                $this->playerTies();
                break;

            case(!empty($_POST['fire'] && $this->computerPick != 'FIRE')):
                $this->playerWins();
                break;
        }
    }

    public function playerWins()
    {
        $this->result = "YOU WIN!";
    }

    public function playerLoses()
    {
        $this->result = "YOU LOSE!";
    }

    public function playerTies()
    {
        $this->result = "IT'S A TIE!";
    }

    public function playAgain()
    {
        $this->computerPick = '';
        $_SESSION['computerPick'] = '0';
        $this->getComputerPick();
    }
}