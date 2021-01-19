<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Casino royale - guessing game</title>
</head>
<body>
	<div class="container">
        <h3>GUESS THE NUMBER</h3>
        <p>Fill in a number between 1 and 22 in the box below and try to guess the correct number!</p>
        <form method="post">
            <label for="guess">Guess number: </label>
            <input type="text" id="number" name="guess">
            <input type="submit" value="Submit" id="submit" name="submit">
        </form>

        <h4><?php $result ?></h4>
    </div>
</body>
</html>