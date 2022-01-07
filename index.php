<!DOCTYPE html>
<html>
<head>
	<title>goliadscouter</title>
</head>
<body>

<?php
include 'pokemontypes.php';
//include 'limit.php';

function twoindexes() {
	global $pkmn;
	//echo count($pkmn);

	$rand1 = rand(0, count($pkmn));
	$rand2 = rand(0, count($pkmn));
	return([$pkmn[$rand1], $pkmn[$rand2]]);
}
?>

<center>
<h1 style="display: inline;">
		<img src="https://www.smogon.com/forums//media/minisprites/<?php echo twoindexes()[0]; ?>.png" style="display: inline; position: relative; top: 6px;">goliadscouter<img src="https://www.smogon.com/forums//media/minisprites/<?php echo twoindexes()[1]; ?>.png" style="display: inline; position: relative; top: 6px;">
	</h1>
	<br /><br />
	<u>Replays</u>:<br />
	<form action="scouter.php" method="post">
	<textarea rows="20" cols="60" id="statsbox" name="statsbox"wrap="soft" method="post"></textarea><br />(put newlines after every replay, I'm currently coding it so you can have a space between each <br/> replay but it's not easy fsr)<br />
	
  	<u>Usernames</u>:<br /><input type="text" id="fname" name="fname" method="post"><br />
  	<input type="submit" value="Send" id="poop" name="poop">
	</form>
	<br />
	(check out <a href="http://warpzone.rf.gd/scouter200/guide.txt" target="_blank">guide.txt</a> if you need help)<br />
	more features coming soon, see <a href="http://warpzone.rf.gd/scouter200/todolist.txt" target="_blank">todolist.txt</a> if you wanna see what
</center>
</body>

<?php

//  	Dark Mode:<input type="checkbox" name="darkcheck" id="darkcheck" /><br />
// OR pastebin raw (better on mobile):<br /><input type="text" id="fname" name="fname" method="post"><br />

?>
