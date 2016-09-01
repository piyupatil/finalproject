<html><body>
<?php
	$para = "hiii, I am nisha kasar ,student of walchand college of engineering sangli. I am from Ichalkaranji.";
	//$words = explode(" ", "Hello world. It's a beautiful day.");
	$words = (explode(" ",$para));
	//print_r (explode(" ",$para));
	$new="";
	foreach ($words as $w) {
		//$acronym .= $w[0];
		if(strlen($w)>6)
		{
			//str_replace($w, "Walchand", $w);
			$new .= "Walchand";
		}
		else
		{
			$new .=$w;
		}
		$new .=" ";
	}
	print_r($new);
?>
</body></html>