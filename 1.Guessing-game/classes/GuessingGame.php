<?php

class GuessingGame
{
    public $maxGuesses;
    public $secretNumber;
    public $guesses;
    public $result;

    public function __construct(int $secretNumber, int $maxGuesses = 3)
    {
        // We ask for the max guesses when someone creates a game
        // Allowing your settings to be chosen like this, will bring a lot of flexibility
        $this->maxGuesses = $maxGuesses;

        if(!empty($_SESSION['secretNumber'])){
            $this->secretNumber = $_SESSION['secretNumber'];
        }

        if(!empty($_SESSION['guesses'])){
            $this->guesses = $_SESSION['guesses'];
        }
    }

    public function run()
    {
        // This function functions as your game "engine"
        // It will run every time, check what needs to happen and run the according functions (or even create other classes)

        // Check if a secret number has been generated yet
        // --> if not, generate one and store it in the session (so it can be kept when the user submits the form)
        if(empty($this->secretNumber)){
            $this->generateSecretNumber();
        }

        // Check if the player has submitted a guess
        // --> if so, check if the player won (run the related function) or not (give a hint if the number was higher/lower or run playerLoses if all guesses are used).
        if(!empty($_POST['submit'])){
            $this->guesses++;

            $this->handleGuess();
        }

        $_SESSION['guesses'] = $this->guesses;
    }

    public function generateSecretNumber(){
        $this->secretNumber = rand(1,22);
        $_SESSION['secretNumber'] = $this->secretNumber;
    }

    public function handleGuess(){
        if($_POST['guess'] == $this->secretNumber && $this->guesses <= $this->maxGuesses){
            $this->playerWins(); 
        } else if($_POST['guess'] < $this->secretNumber && $this->guesses < $this->maxGuesses){
            $this->guessHigher();
        } else if($_POST['guess'] > $this->secretNumber && $this->guesses < $this->maxGuesses){
            $this->guessLower();
        } else if($_POST['guess'] != $this->secretNumber && $this->guesses >= $this->maxGuesses){
            $this->playerLoses();
        }
    }

    public function playerWins()
    {
        $this->result = "You win! The secret number was ".$this->secretNumber;
        $this->reset();
    }

    public function playerLoses()
    {
        $this->result = "You lose! The secret number was ".$this->secretNumber;
        $this->reset();
    }

    public function guessHigher()
    {
        $this->result = "Guess higher!";
    }

    public function guessLower()
    {
        $this->result = "Guess lower!";
    }

    public function reset()
    {
        $this->guesses = 0;
        $_SESSION["guesses"] = 0;
        $this->generateSecretNumber();
    }
}