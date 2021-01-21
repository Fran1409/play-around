<?php

class RockPaperScissors
{
    public $computerPick;
    public $playerPick;
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

    public function getPlayerPick()
    {
        if(!empty($_POST['rock'])){
            $this->playerPick = 'ROCK';
        } else if(!empty($_POST['paper'])){
            $this->playerPick = 'PAPER';
        } else if(!empty($_POST['scissors'])){
            $this->playerPick = 'SCISSORS';
        } else if(!empty($_POST['fire'])){
            $this->playerPick = 'FIRE (beats everything)';
        } 

        return $this->playerPick;
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
        $this->result = 'YOU WIN! You got '.$this->getPlayerPick().' and the other player got '.$this->computerPick.'.';
    }

    public function playerLoses()
    {
        $this->result = 'YOU LOSE! You got '.$this->getPlayerPick().' and the other player got '.$this->computerPick.'.';
    }

    public function playerTies()
    {
        $this->result = "IT'S A TIE!".' You got '.$this->getPlayerPick().' and the other player got also '.$this->computerPick.'.';
    }

    public function playAgain()
    {
        $this->computerPick = '';
        $_SESSION['computerPick'] = '0';
        $this->getComputerPick();
        $this->playerPick = '';
    }
}