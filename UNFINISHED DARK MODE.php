

if (isset($_POST['darkcheck'])) {
	setcookie("CookieName", "Checked", 2147483647);
}
/*elif (!isset($_POST['darkcheck'])) {
	setcookie("CookieName", "Unchecked", 2147483647);
}*/
else {
	setcookie("CookieName", "Unchecked", 2147483647);
	echo "UNCHECKED!";
}


if (isset($_COOKIE["CookieName"])) {
	setcookie("CookieName", "Checked", 2147483647);
	?>
	<style type='text/css'>
	.body {
	  background-color: black;
	  color: white;
	}
	@media screen and (prefers-color-scheme: light) {
	  body {
	    background-color: black;
	    color: #D3D3D3;
	  }
	}
	#statsbox {
		background-color: #808080;
	}
	#fname {
		background-color: #808080;
	}
	#darkcheck {
		background-color: #D3D3D3;
	}
	#poop {
		background-color: #808080;
	}
	</style>
		<?php
}
?>
}
else {
	setcookie("CookieName", "Unchecked", 2147483647);
	?>
	<style type='text/css'>
	.body {
	  background-color: white;
	  color: black;
	}
	body {
	 	background-color: white;
	  	color: black;
	}
	#statsbox {
		background-color: white;
	}
	#fname {
		background-color: white;
	}
	#darkcheck {
		background-color: white;
	}
	#poop {
		background-color: white;
	}
	</style>
}

if (htmlspecialchars($_COOKIE["CookieName"]) === "Checked") {
