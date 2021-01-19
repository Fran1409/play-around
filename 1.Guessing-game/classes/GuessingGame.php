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

        // TODO: check if a secret number has been generated yet
        // --> if not, generate one and store it in the session (so it can be kept when the user submits the form)
        if(empty($this->secretNumber)){
            $this->generateSecretNumber();
        }

        echo $this->secretNumber.'<br>';
        echo $_SESSION['secretNumber'];

        // TODO: check if the player has submitted a guess
        // --> if so, check if the player won (run the related function) or not (give a hint if the number was higher/lower or run playerLoses if all guesses are used).
        if(!empty($_POST['submit'])){
            $this->guesses++;

            $this->handleGuess();
        }

        $_SESSION['guesses'] = $this->guesses;
        echo $this->guesses;

        // TODO as an extra: if a reset button was clicked, use the reset function to set up a new game
    }

    public function generateSecretNumber(){
        $this->secretNumber = rand(1,22);
        $_SESSION['secretNumber'] = $this->secretNumber;
    }

    public function handleGuess(){
        if($_POST['guess'] == $this->secretNumber){
            $this->playerWins();
        } else if($_POST['guess'] < $this->secretNumber){
            $this->guessHigher();
        } else if($_POST['guess'] > $this->secretNumber){
            $this->guessLower();
        } else if($_POST['guess'] != $this->secretNumber && $this->guesses >= $this->maxGuesses){
            $this->playerLoses();
        }
    }

    public function playerWins()
    {
        $result = "You win! The secret number was ".$this->secretNumber;
    }

    public function playerLoses()
    {
        $result = "You lose! The secret number was ".$this->secretNumber;
    }

    public function guessHigher()
    {
        $result = "Guess higher!";
    }

    public function guessLower()
    {
        $result = "Guess lower!";
    }

    public function reset()
    {
        // TODO: Generate a new secret number and overwrite the previous one
    }
}