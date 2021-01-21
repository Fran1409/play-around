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
        

        
        echo $this->computerPick;
        echo $_SESSION['computerPick'];
       
    }

    public function getComputerPick()
    {
        $this->computerPick = rand(1,3);
        $_SESSION['computerPick'] = $this->computerPick;
    }
}