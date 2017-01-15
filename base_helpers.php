<?



function quotient($dividend, $divisor) {
	
	$remainder = $dividend % $divisor;
	
	$multiple = $dividend - $remainder;
	
	return $multiple/$divisor;
}

function convert_to_base_helper($int, $new_base, $arr) {
	
	if ($new_base <= 0 || !is_int($new_base)) throw new Exception("hey!");
	
	
	
	if ($int < $new_base) {
		
		$arr[] = [0, $int];
		
		return $arr;
	}
	
	$counter = 0;
	
	while (($int / pow($new_base, $counter)) >= $new_base) ++$counter;
	

	$divisor = pow($new_base, $counter);

	$quotient = quotient($int, $divisor);
		

	$arr[] = [$counter, $quotient];

	
	$remainder = $int - $divisor * $quotient;
	
	return convert_to_base_helper($remainder, $new_base, $arr);
}

function convert_to_base_array($int, $new_base) {
	
	$arr = convert_to_base_helper($int, $new_base, []);
	
	$keys = [];
	
	foreach ($arr as $pair) $keys[] = $pair[0];
	
	
	
	$max = 0;
	
	foreach ($keys as $key) {if ($key > $max) $max = $key;}
	
	
		
	for ($i = 0; $i < $max; ++$i) {
		
		if (!in_array($i, $keys)) $arr[] = [$i, 0];
	}
	
	$final_arr = [];
	
	for ($i = $max; $i >= 0; --$i) {
		
		foreach ($arr as $pair) {
			
			if ($pair[0] == $i) $final_arr[] = $pair;
			
			continue;
		}
	}
	
	return $final_arr;
}

//$int must be < 62
function int_to_base_62 ($int) {
	
    switch ($int) :
        
		case 0: return "0";
		case 1: return "1";
		case 2: return "2";
		case 3: return "3";
		case 4: return "4";
		case 5: return "5";
		case 6: return "6";
		case 7: return "7";
		case 8: return "8";
		case 9: return "9";
		case 10: return "a";
		case 11: return "b";
		case 12: return "c";
		case 13: return "d";
		case 14: return "e";
		case 15: return "f";
		case 16: return "g";
		case 17: return "h";
		case 18: return "i";
		case 19: return "j";
		case 20: return "k";
		case 21: return "l";
		case 22: return "m";
		case 23: return "n";
		case 24: return "o";
		case 25: return "p";
		case 26: return "q";
		case 27: return "r";
		case 28: return "s";
		case 29: return "t";
		case 30: return "u";
		case 31: return "v";
		case 32: return "w";
		case 33: return "x";
		case 34: return "y";
		case 35: return "z";
		case 36: return "A";
		case 37: return "B";
		case 38: return "C";
		case 39: return "D";
		case 40: return "E";
		case 41: return "F";
		case 42: return "G";
		case 43: return "H";
		case 44: return "I";
		case 45: return "J";
		case 46: return "K";
		case 47: return "L";
		case 48: return "M";
		case 49: return "N";
		case 50: return "O";
		case 51: return "P";
		case 52: return "Q";
		case 53: return "R";
		case 54: return "S";
		case 55: return "T";
		case 56: return "U";
		case 57: return "V";
		case 58: return "W";
		case 59: return "X";
		case 60: return "Y";
		case 61: return "Z";
		
		default: 
			return null;
        
    endswitch;
}


function to_base_62($int) {
	
	$representation = convert_to_base_array($int, 62);
	
	$str = "";
	
	foreach ($representation as $pair) $str .= int_to_base_62($pair[1]);
	
	return $str;
}



function to_5_char_base_62($int) {
	
	$next = to_base_62($int);
	
	$length = strlen($next);
	
	$needed = 5 - $length;
	
	while ($needed) {
		
		$next = "0" . $next;
		--$needed;
	}
	
	return $next;
}


?>