<?php
include('pokemontypes.php');
header("content-type: text/plain");

//include('simple_html_dom.php');
//$html = file_get_html('https://replay.pokemonshowdown.com/gen41v1-1231369678.log');
// PHP 5.6.30
$samplereplay = 'https://replay.pokemonshowdown.com/gen71v1-1261031806' . '.log'; 
//$samplereplays = ['https://replay.pokemonshowdown.com/gen41v1-1163901063.log', 'https://replay.pokemonshowdown.com/gen41v1-1163899480.log', 'https://replay.pokemonshowdown.com/gen41v1-1163898005.log', 'https://replay.pokemonshowdown.com/gen41v1-1163896676.log', 'https://replay.pokemonshowdown.com/gen41v1-1166066495.log', 'https://replay.pokemonshowdown.com/gen41v1-1166065222.log', 'https://replay.pokemonshowdown.com/gen41v1-1166064380.log', 'https://replay.pokemonshowdown.com/gen41v1-1166062879.log', 'https://replay.pokemonshowdown.com/gen41v1-1165078709.log', 'https://replay.pokemonshowdown.com/gen41v1-1165077765.log', 'https://replay.pokemonshowdown.com/gen41v1-1165076326.log'];
$samplereplays = ['https://replay.pokemonshowdown.com/smogtours-gen41v1-476545.log', 'https://replay.pokemonshowdown.com/smogtours-gen41v1-476543.log', 'https://replay.pokemonshowdown.com/smogtours-gen41v1-476541.log', 'https://replay.pokemonshowdown.com/smogtours-gen41v1-476540.log', 'https://replay.pokemonshowdown.com/smogtours-gen41v1-476539.log', 'https://replay.pokemonshowdown.com/gen41v1-1071819413.log', 'https://replay.pokemonshowdown.com/gen41v1-1071820375.log', 'https://replay.pokemonshowdown.com/gen41v1-1071823859.log', 'https://replay.pokemonshowdown.com/gen41v1-1071825120.log', 'https://replay.pokemonshowdown.com/gen41v1-1075190799-kpkwnfiwowtg56iar3ms7qilbveuyyvpw.log', 'https://replay.pokemonshowdown.com/gen41v1-1075191831-a543hi40aw84rmxd9fhsv4jxg02p3nbpw.log', 'https://replay.pokemonshowdown.com/gen41v1-1075192332-o0hcazw4tuhuh01lz78vz03q091j921pw.log', 'https://replay.pokemonshowdown.com/gen41v1-1075193762-3bvampt2jvv5b7yqzexq6vky5vncvc4pw.log', 'https://replay.pokemonshowdown.com/gen41v1-1075195027-ppnzsujo2dv97y9vhx9vsrq8w4v6fe0pw.log', 'https://replay.pokemonshowdown.com/gen41v1-1079059582.log', 'https://replay.pokemonshowdown.com/gen41v1-1079061358.log', 'https://replay.pokemonshowdown.com/gen41v1-1079062322.log', 'https://replay.pokemonshowdown.com/gen41v1-1083468649-zjdqsy6arx5i9yqhfqsyp1avkd0ei80pw.log', 'https://replay.pokemonshowdown.com/gen41v1-1083470992-us401a5hgqog8km8yn2jiuhviyco6repw.log', 'https://replay.pokemonshowdown.com/gen41v1-1083472022-0ltiaytnjz357dd9ob84rx7fcgixm4upw.log', 'https://replay.pokemonshowdown.com/gen41v1-1083474508-neqq7gk7ry0qto8awyt218ulkfnh1qypw.log', 'https://replay.pokemonshowdown.com/gen41v1-1083477361-ke94q6o0pyrereac785hofygkbtw9pcpw.log', 'https://replay.pokemonshowdown.com/gen41v1-1087425194.log', 'https://replay.pokemonshowdown.com/gen41v1-1087426143.log', 'https://replay.pokemonshowdown.com/gen41v1-1087426621.log', 'https://replay.pokemonshowdown.com/gen41v1-1087427670.log', 'https://replay.pokemonshowdown.com/gen41v1-1095441039-j25hb3abxglg71tir0ugteya5ul5iiepw.log', 'https://replay.pokemonshowdown.com/gen41v1-1095442596-hdi8ifhjdb10yazh3nh287c7qq0evr0pw.log', 'https://replay.pokemonshowdown.com/gen41v1-1095444705-a860tnqzy7e6ejqrpxsmhq44v9vnwhxpw.log', 'https://replay.pokemonshowdown.com/gen41v1-1095446735-ejpbaa6e2gbs7s9uq2ghtffdsvktmc4pw.log', 'https://replay.pokemonshowdown.com/gen41v1-1095449218-jmhwo41pte3ssjquk6fjdbhm0a318tupw.log', 'https://replay.pokemonshowdown.com/gen41v1-1103495094.log', 'https://replay.pokemonshowdown.com/gen41v1-1103496287.log', 'https://replay.pokemonshowdown.com/gen41v1-1103497458.log', 'https://replay.pokemonshowdown.com/gen41v1-1103498951.log', 'https://replay.pokemonshowdown.com/gen41v1-1103500393.log'];

$winners = [];
global $winners;
$tab = "\t";
global $tab;

function fixstr($samplestr) {
	preg_replace("/[^a-zA-Z0-9]+/", "", $samplestr); $samplestr = strtolower($samplestr);
	return $samplestr;
}

function urlmon($string) { // losercases, also removes random parts from mon names to make it url friendly with no issues
	$key1 = str_replace('-*', '', $string);
	$key2 = str_replace(' ', '-', $key1);
	$key3 = str_replace(':', '', $key2);
	$final = strtolower($key3);
	return($final);
}


// ACTUAL SCOUTING PART STARTS
$nums = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
$teamnumber = 0;
global $teamnumber;

$verifiedreplays = [];
?>
<?php
$newline = "\n";
$suffix1 = ['-Unbound', '-Therian', '-Alola', '-Galar', '-Hisui', '-Black', '-Antique', '-Low-Key', '-Dada'];
$suffix2 = ['-U', '-T', '-A', '-G', '-H', '-B', '', '', ''];



$box = htmlspecialchars($_POST['statsbox']);
if (strlen($box) > 2) {
	$submitreplays = explode('https://', $box);
	foreach ($submitreplays as $key => $value) {
		//echo $value;
		if (strlen($value) > 10) {
			if (substr_count($box, ' ') >= 1) {
				//echo "+<br />";
			}
			if (in_array(substr($value, -1), $nums)) { // weird bug where it kept echoing replay .log instead of replay.log
				$x = "https://" . $value . ".log";
				if (!in_array($x, $verifiedreplays)) { // making sure no duplicates
					array_push($verifiedreplays, $x);
				}
				//echo "-<br />";
				//echo $x . "<br />";
			}
			else {
				$x = "https://" . substr($value, 0, -2) . ".log";
				if (!in_array($x, $verifiedreplays)) { // making sure no duplicates
					array_push($verifiedreplays, $x);
				}
				///echo "*<br />";
				//echo $x . "<br />";
			}
		}
	}

	$lastreplaynum = count($verifiedreplays);
	$lastreplaynum = ($lastreplaynum - 1);
	//echo '$' . strlen(end($verifiedreplays)); debugging
	//if (str_contains(end($verifiedreplays), 'pw')) {
	if (strlen(end($verifiedreplays)) > 70) { // means hidden replay. weird bug if u dont add an exreplaytra newline where it doesnt add the last 
		//echo end($verifiedreplays);
		//echo "stankygooch";
		//echo $verifiedreplays[1];
		//echo $lastreplaynum;
		$prereconstruction = explode ('.l', $verifiedreplays[$lastreplaynum]);
		$verifiedreplays[$lastreplaynum] = $prereconstruction[0] . "pw.l" . $prereconstruction[1];
		//echo $verifiedreplays[$lastreplaynum];
		//echo '-' . $prereconstruction[1] . '-';
	}
}
else {
	echo "u dont have any replays fool";
}
//print_r($submitreplays);
//print_r($verifiedreplays);



//$scoutedalts0 = ['SECTOR 7 dom', 'fadeonitdom', 'loopedupdom', 'G5 SCRAF dom'];
$scoutedalts0 = ['Synonimous'];
$scoutedalts02 = []; #scoutedalts02 is an old variable i did absolutely nothing with for the longest until i realized all lowercase no spaces names looked ugly on the sheet. i decided to make it a backup list with people's exact ps
$scoutedalts = [];
$opponents = [];
$uniqueopponents = [];
$addedopponents = [];

global $addedopponents;

//print_r($opponents);

foreach ($scoutedalts as $key => $value) {
	array_push($scoutedalts02, $name);
	$name = preg_replace("/[^a-zA-Z0-9]+/", "", $value);
	$name = strtolower($name);
	array_push($scoutedalts, $name);
}
if (isset($_POST['fname'])) { # usernames
	if (substr_count($_POST['fname'], ',') > 0) {
		$namebox = explode(',', $_POST['fname']);
		foreach ($namebox as $key => $value) {
			$adjname = preg_replace("/[^a-zA-Z0-9]+/", "", $value); $adjname = strtolower($adjname);
			array_push($scoutedalts, $adjname);
			///echo $adjname;
		}
	}
	else { // ONE PLAYER
		$namebox = $_POST['fname'];
		$namebox = preg_replace("/[^a-zA-Z0-9]+/", "", $namebox); $namebox = strtolower($namebox);
		///echo $namebox;
		array_push($scoutedalts, $namebox);
	}
}



$allpokemon = [];
$allteams = [];
$nodupespokemon = [];
$firesused = []; $watersused = []; $grassesused = []; $bugsused = []; $darksused = []; $dragonsused = []; $electricsused = []; $fairiesused = []; $fightingsused = []; $flyingsused = []; $ghostsused = []; $groundsused = []; $icesused = []; $normalsused = []; $poisonsused = []; $psychicsused = []; $rocksused = []; $steelsused = [];

function cleanmon($string) {
	if (strpos(substr($string, 1, 20), ',') !== false) { // GENDERED
		$num = (strpos($string, ', ') - 3);
		return substr($string, 3, $num);
	}
	else { // GENDERLESS
		$string2 = substr($string, 3, -1);
		$num = (strpos($string2, '|'));
		//substr($string2, 0, $num);
		return substr($string2, 0, $num);
	}
}

if (strpos($verifiedreplays[1], '1v1')) { // 1v1, 3 pkmn each team
	$replay2 = '1'; // 1v1
	global $replay2;
}
elseif (strpos($verifiedreplays[1], 'gen41v1')) {
	$replay2 = '4'; // dpp 1v1
	global $replay2;
}

elseif (strpos($verifiedreplays[1], 'gen51v1')) {
	$replay2 = '5'; // dpp 1v1
	global $replay2;
}

elseif (strpos($verifiedreplays[1], 'gen41v1')) {
	$replay2 = '4'; // dpp 1v1
	global $replay2;
}

else {
	$replay2 = '0'; // not 1v1
	global $replay2;
}


if (count($verifiedreplays) < 24) {
	echo "Team/Replay Count: " . count($verifiedreplays) . ". Small sheet reccomended.\n\n";
}
elseif (count($verifiedreplays) > 24 and count($verifiedreplays) < 46) {
	echo "Team/Replay Count: " . count($verifiedreplays) . ". Main sheet reccomended.\n\n";
}
elseif (count($verifiedreplays) > 46) {
	echo "Team/Replay Count: " . count($verifiedreplays) . ". Bigger sheet reccomended.\n\n";
}

function scoutreplay($replay) {
	$winners = [];
	$guy = [];
	global $scoutedalts, $scoutedalts02, $allpokemon, $allteams, $firetypes, $firesused, $watertypes, $watersused, $grasstypes, $grassesused, $groundtypes, $groundsused, $steeltypes, $steelsused, $fairytypes, $fairiesused, $flyingtypes, $flyingsused, $psychictypes, $psychicsused, $darktypes, $darksused, $dragontypes, $dragonsused, $electrictypes, $electricsused, $fightingtypes, $fightingsused, $ghosttypes, $ghostsused, $icetypes, $icesused, $normaltypes, $normalsused, $poisontypes, $poisonsused, $rocktypes, $rocksused, $bugtypes, $bugsused, $replay2, $winners, $guy, $opponents, $uniqueopponents, $addedopponents;

	$htmlbeta = file_get_contents($replay);

	$html = htmlspecialchars($htmlbeta);
	$dar = explode("|poke|", $html);
	//print_r($dar);
	$frfr = explode("|player|", $dar[0]); // for player

	// player string manipulation, made it all lower case and no spaces or characters for simplicity. i tried making this a function and it just didn't work out, ik it would be cleaner, bitch!
	$playerone = substr($frfr[1], 3); // getting rid of some stupid text idc about
	$playerone = substr($playerone, 0, strpos($playerone, '|'));
	$playerone = $result = preg_replace("/[^a-zA-Z0-9]+/", "", $playerone); $playerone = strtolower($playerone);
	//echo ("<br />" . $playerone);//
	$playertwo = substr($frfr[2], 3); // getting rid of some stupid text idc about
	$playertwo = substr($playertwo, 0, strpos($playertwo, '|'));
	$playertwo = $result = preg_replace("/[^a-zA-Z0-9]+/", "", $playertwo); $playertwo = strtolower($playertwo);

	$chickendinner = explode('|win|', $html);
	//echo $chickendinner[1];
	$winnerwinner = explode('|', $chickendinner[1]);
	$winnername = $winnerwinner[0];
	$winnername = preg_replace("/[^a-zA-Z0-9]+/", "", $winnername); $winnername = strtolower($winnername);
	//echo $winnername . "<br />";
	array_push($winners, $winnername);

	if (in_array($playerone, $scoutedalts)) { # looks for if the alt is a player or not, if not add to opponents list.
		array_push($opponents, $playertwo);
		if (!(array_search($playertwo, $uniqueopponents))) { #i did nothing with this list lol
			array_push($uniqueopponents, $playertwo);
		}
	} 
	elseif (in_array($playertwo, $scoutedalts)) { # same ting
		array_push($opponents, $playerone);
		if (!(array_search($playerone, $uniqueopponents))) {
			array_push($uniqueopponents, $playerone);
		}
	}
	//array_push($guy, $winnername);
	//print_r($winners);  // this shit is art if you uncomment it
	//print_r($guy);


	//echo ("<br />" . $playertwo);//
	//echo "<br />";//
	//comments that end in // are important, made the program what it is
	if (strpos($replay, '1v1')) { // 1v1, 3 pkmn each team
		$teamlist = [cleanmon($dar[1]), cleanmon($dar[2]), cleanmon($dar[3])];
		//print_r($teamlist);//
		$teamlist2 = [cleanmon($dar[4]), cleanmon($dar[5]), cleanmon($dar[6])];
		//print_r($teamlist2);//
	}
	else {
		$teamlist = [cleanmon($dar[1]), cleanmon($dar[2]), cleanmon($dar[3]), cleanmon($dar[4]), cleanmon($dar[5]), cleanmon($dar[6])];
		//print_r($teamlist);
		$teamlist2 = [cleanmon($dar[7]), cleanmon($dar[8]), cleanmon($dar[9]), cleanmon($dar[10]), cleanmon($dar[11]), cleanmon($dar[12])];
		//print_r($teamlist2);
	}
	if (in_array($playerone, $scoutedalts)) {
		//echo 'player1 in list';///
		array_push($allteams, $teamlist);
		foreach ($teamlist as $key => $value) {
			//echo $value;//
			array_push($allpokemon, $value);
			if (in_array($value, $firetypes)) {
			    array_push($firesused, $value);
			}
			if (in_array($value, $watertypes)) {
			    array_push($watersused, $value);
			}
			if (in_array($value, $grasstypes)) {
			    array_push($grassesused, $value);
			}
			if (in_array($value, $groundtypes)) {
			    array_push($groundsused, $value);
			}
			if (in_array($value, $steeltypes)) {
			    array_push($steelsused, $value);
			}
			if (in_array($value, $fairytypes)) {
			    array_push($fairiesused, $value);
			}
			if (in_array($value, $flyingtypes)) {
			    array_push($flyingsused, $value);
			}
			if (in_array($value, $psychictypes)) {
			    array_push($psychicsused, $value);
			}
			if (in_array($value, $darktypes)) {
			    array_push($darksused, $value);
			}
			if (in_array($value, $dragontypes)) {
			    array_push($dragonsused, $value);
			}
			if (in_array($value, $electrictypes)) {
			    array_push($electricsused, $value);
			}
			if (in_array($value, $fightingtypes)) {
			    array_push($fightingsused, $value);
			}
			if (in_array($value, $ghosttypes)) {
			    array_push($ghostsused, $value);
			}
			if (in_array($value, $icetypes)) {
			    array_push($icesused, $value);
			}
			if (in_array($value, $normaltypes)) {
			    array_push($normalsused, $value);
			}
			if (in_array($value, $poisontypes)) {
			    array_push($poisonsused, $value);
			}
			if (in_array($value, $rocktypes)) {
			    array_push($rocksused, $value);
			}
			if (in_array($value, $bugtypes)) {
			    array_push($bugsused, $value);
			}
		}
	}
	elseif (in_array($playertwo, $scoutedalts)) {
		//echo 'player2 in list';//
		array_push($allteams, $teamlist2);
		foreach ($teamlist2 as $key => $value) {
			//echo $value;//
			array_push($allpokemon, $value);
			if (in_array($value, $firetypes)) {
			    array_push($firesused, $value);
			}
			if (in_array($value, $watertypes)) {
			    array_push($watersused, $value);
			}
			if (in_array($value, $grasstypes)) {
			    array_push($grassesused, $value);
			}
			if (in_array($value, $groundtypes)) {
			    array_push($groundsused, $value);
			}
			if (in_array($value, $steeltypes)) {
			    array_push($steelsused, $value);
			}
			if (in_array($value, $fairytypes)) {
			    array_push($fairiesused, $value);
			}
			if (in_array($value, $flyingtypes)) {
			    array_push($flyingsused, $value);
			}
			if (in_array($value, $psychictypes)) {
			    array_push($psychicsused, $value);
			}
			if (in_array($value, $darktypes)) {
			    array_push($darksused, $value);
			}
			if (in_array($value, $dragontypes)) {
			    array_push($dragonsused, $value);
			}
			if (in_array($value, $electrictypes)) {
			    array_push($electricsused, $value);
			}
			if (in_array($value, $fightingtypes)) {
			    array_push($fightingsused, $value);
			}
			if (in_array($value, $ghosttypes)) {
			    array_push($ghostsused, $value);
			}
			if (in_array($value, $icetypes)) {
			    array_push($icesused, $value);
			}
			if (in_array($value, $normaltypes)) {
			    array_push($normalsused, $value);
			}
			if (in_array($value, $poisontypes)) {
			    array_push($poisonsused, $value);
			}
			if (in_array($value, $rocktypes)) {
			    array_push($rocksused, $value);
			}
			if (in_array($value, $bugtypes)) {
			    array_push($bugsused, $value);
			}
		}
	}
	else {
		echo "\nu forgot an alt name, budster";
		echo "'" . $playerone . "' "; echo $playertwo;
		//print_r($scoutedalts);
	}
}
foreach ($verifiedreplays as $key => $value) {
	scoutreplay($value);
}

echo "#TEAMS (DONT FORGET TO PUT INTO PASTEBIN/NOTEPAD FIRST)#\n";
// print_r($opponents);
// print_r($uniqueopponents);

$teamcount = 0;
global $teamcount;

if ($replay2 == 1) { // 1v1, 3 pkmn each team
	foreach ($allteams as $key => $value) {
		// fart
		// WHERE TEAMS START BEING PRINTED
		for ($i=0; $i < 3; $i++) { 
			if ($i == 2) {
				# win
				if (in_array($winners[$teamnumber], $scoutedalts)) {
					echo 'IMAGE("https://www.smogon.com/forums//media/minisprites/' . urlmon($value[$i]) . '.png")' . ',"' . $value[$i] . '",' . 'HYPERLINK("' . substr($verifiedreplays[$key], 0, -4) . '", "W")}' . "\n";
					#echo substr($verifiedreplays[$key], 0, -4)
					//echo $value[$i] . ' (W)' .  "<br />"
					$teamnumber = $teamnumber + 1;
				}
				# loss
				else {
					#echo '=IMAGE("https://www.smogon.com/forums//media/minisprites/' . urlmon($value[$i]) . '.png")' . htmlspecialchars($tab) . $value[$i] . htmlspecialchars($tab) . '=HYPERLINK("' . substr($verifiedreplays[$key], 0, -4) . '", "L")' . "\n";
					echo 'IMAGE("https://www.smogon.com/forums//media/minisprites/' . urlmon($value[$i]) . '.png")' . ',"' . str_replace($suffix1, $suffix2, $value[$i]) . '",' . 'HYPERLINK("' . substr($verifiedreplays[$key], 0, -4) . '", "L")}' . "\n";
					$teamnumber = $teamnumber + 1;
				}
			} 
			# VERSION E E
			elseif ($i == 1) { #second mon
				echo 'IMAGE("https://www.smogon.com/forums//media/minisprites/' . urlmon($value[$i]) . '.png")' . ', "' . str_replace($suffix1, $suffix2, $value[$i]) . '",';
			}
			elseif ($i == 0) { # first mon
				#echo $opponents[$teamcount] . (array_search($opponents[$teamcount], $addedopponents));
				if (array_search($opponents[$teamcount], $addedopponents)) {
					echo '={"' . ' ' . '",IMAGE("https://www.smogon.com/forums//media/minisprites/' . urlmon($value[$i]) . '.png")' . ', "' . str_replace($suffix1, $suffix2, $value[$i]) . '",';
					$teamcount = $teamcount + 1;
				}
				else {
					echo '={"' . ucfirst($opponents[$teamcount]) . '",IMAGE("https://www.smogon.com/forums//media/minisprites/' . urlmon($value[$i]) . '.png")' . ', "' . str_replace($suffix1, $suffix2, $value[$i]) . '",';
					# dood ampersands r glitched grrrr
					//echo 'BALLS ' . $teamcount;
					array_push($addedopponents, $opponents[$teamcount]);
					$teamcount = $teamcount + 1;
				}

			}			
			else { # debug :suar:
				echo "wat";
			}
		}
	}
}

else { // 6 mon team
	foreach ($allteams as $key => $value) {
		for ($i=0; $i < 6; $i++) { 
			if ($i == 5) {
				echo $value[$i] . "<br />"?></a><?php ;
			}
			else {
				echo $value[$i] . " / ";
			}
		}
	}
}

$countingfreq = array_count_values($allpokemon);
arsort($countingfreq);
//print_r($countingfreq);
//echo $count;

foreach ($allpokemon as $key => $value) {
	//echo $value;
	if (!in_array($value, $nodupespokemon)) {
		//echo $value;
		array_push($nodupespokemon, $value);
	}
}
/*echo "<br />";
echo "Number of Teams: " . count($allteams) . "<br />";
echo "Number of Pokemon: " . count($allpokemon) . "<br />";
echo "Number of Unique Pokemon: " . count($nodupespokemon) . "<br />";*/

if (isset($_POST['altusagebox'])) {
	echo "\n#POKEMON USAGE (TAB 1)#\n";
}
else {
	echo "\n#POKEMON USAGE#\n";
}
// $alternateusage = True; unused beta variable
// global $alternateusage; unused beta variable
// EXPLANATION: IF THE CHECKBOX IS CLICKED FOR 2 TAB USAGE, IT PRINTS THE EVEN NUMBER MONS, THEN DOES A SECOND LOOP FOR THE ODD ONES.
$pkmnusagecount = 0;
global $pkmnusagecount;
$pkmnusagecount2 = 0;
global $pkmnusagecount2;

foreach ($countingfreq as $key => $value) { // the main thing that shows mon: number
	$key1 = str_replace('-*', '', $key);
	$key2 = str_replace(' ', '-', $key1);
	$final = str_replace(':', '', $key2);
	$tab = "\t";
	// mon printing
	?><?php 
	if (!isset($_POST['altusagebox'])) {
		echo '=IMAGE("https://www.smogon.com/forums//media/minisprites/' . strtolower($final) . '.png")' . htmlspecialchars($tab) . str_replace($suffix1, $suffix2, $key) . htmlspecialchars($tab) . substr(strval(($value/count($allteams) * 100)), 0, 5) . '%' . $tab . $value . "\n";
	}
	else {
		if ($pkmnusagecount % 2 == 0) {
			echo '=IMAGE("https://www.smogon.com/forums//media/minisprites/' . strtolower($final) . '.png")' . htmlspecialchars($tab) . str_replace($suffix1, $suffix2, $key) . htmlspecialchars($tab) . substr(strval(($value/count($allteams) * 100)), 0, 5) . '%' . $tab . $value . "\n";
		}
		$pkmnusagecount = $pkmnusagecount + 1;
	}
}

if (isset($_POST['altusagebox'])) {
	echo "#TAB2#\n";
	foreach ($countingfreq as $key => $value) { // the main thing that shows mon: number
		$key1 = str_replace('-*', '', $key);
		$key2 = str_replace(' ', '-', $key1);
		$final = str_replace(':', '', $key2);
		$tab = "\t";	
		if ($pkmnusagecount2 % 2 != 0) {
				echo '=IMAGE("https://www.smogon.com/forums//media/minisprites/' . strtolower($final) . '.png")' . htmlspecialchars($tab) . str_replace($suffix1, $suffix2, $key) . htmlspecialchars($tab) . substr(strval(($value/count($allteams) * 100)), 0, 5) . '%' . $tab . $value . "\n";
		}
		$pkmnusagecount2 = $pkmnusagecount2 + 1;
	}
}


//var_dump($dar);
function typedump($typeused, $tstring) {
	global $allpokemon;
	echo "\n";
	$typecounting = array_count_values($typeused);
	arsort($typecounting);
	$typesum = 0;
	$typecount = 1;
	$strings = [];
	foreach ($typecounting as $key => $value) { 
		if ($typecount !== count($typecounting)) {
			array_push($strings, ($key . ' (' . $value . "), "));
		}
		else {
			array_push($strings, ($key . ' (' . $value . ")"));
		}
		$typesum = $typesum + $value;
		$typecount = $typecount + 1;
	}
	$percentie = substr(strval(($typesum/count($allpokemon) * 100)), 0, 5);
	echo $tstring . " Types Used: " . $typesum . "/" . count($allpokemon) . " (" . $percentie . "%) - ";
	foreach ($strings as $key => $value) {
		$typeicon0 = $value;
		$typeicon0 =  str_replace('Tapu ', 'Tapu-', $typeicon0);
		$typeicon0 =  str_replace('Type: ', 'Type-', $typeicon0);
		$typeicon0 =  str_replace('-*', '', $typeicon0);
		$typeicon = substr(strtolower($typeicon0), 0, strpos($typeicon0, ' '));
		echo $value;
	}

}
?>
<?php
echo "\n#TYPESUSED#\n";


typedump($watersused, "Water");
typedump($firesused, "Fire");
typedump($grassesused, "Grass");
typedump($groundsused, "Ground");
typedump($steelsused, "Steel");
typedump($flyingsused, "Flying");
typedump($fairiesused, "Fairy");
typedump($dragonsused, "Dragon");
typedump($psychicsused, "Psychic");
typedump($darksused, "Dark");
typedump($normalsused, "Normal");
typedump($fightingsused, "Fighting");
typedump($electricsused, "Electric");
typedump($ghostsused, "Ghost");
typedump($poisonsused, "Poison");
typedump($rocksused, "Rock");
typedump($icesused, "Ice");
typedump($bugsused, "Bug");

print_r($addedopponents);

//print_r($watersused);

//$split = explode($html, "|");
//var_dump($split);
?>