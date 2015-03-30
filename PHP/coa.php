<?php

	/*********************************************************************
	**********************************************************************
				   ____ ___    _    
				  / ___/ _ \  / \   
				 | |  | | | |/ _ \  
				 | |__| |_| / ___ \ 
				  \____\___/_/   \_\
	                   Conor's Obfuscation Algorithm
	 
	  Conor Walsh 2014 - 2015
	     Website: http://www.conorwalsh.net
	     GitHub:  https://github.com/conorwalsh
	  
	  Version 2.5
	  
	  First created: 10th August 2014
	  Last modified: 21st March 2015
	  
	 **************************** LICENCE *******************************
	 
	 Copyright (c) 2015 Conor Walsh
	
	 Permission is hereby granted, free of charge, to any person obtaining
	 a copy of this software and associated documentation files (the
	 "Software"), to deal in the Software without restriction, including
	 without limitation the rights to use, copy, modify, merge, publish,
	 distribute, sublicense, and/or sell copies of the Software, and to
	 permit persons to whom the Software is furnished to do so, subject to
	 the following conditions:
	
	 The above copyright notice and this permission notice shall be included
	 in all copies or substantial portions of the Software.
	
	 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
	 OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	 MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
	 IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
	 CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
	 TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
	 SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	  
	**********************************************************************
	*********************************************************************/

	//Decrypt Function
	function COAdecrypt($a, $b) {
	
		//The number the key is multiplied for extra security (Recommended 2 - 13)
		$securitymultiplier = $b;
		//Get the encrypted string
		$dec = $a;
		
		//Replace all non numeric characters with ":"		
		$dec = preg_replace("/[^0-9]/", ":", $dec);
		
		//Array to store idividual encrypted decimal values
		$decarray = array();
		
		//Make an array from the edited string and divide it at every ":" This gives us an array of all the decimals values for all the characters in the original string
		$decarray = explode(':', $dec);		
				
		//Make an array to store the decrypted data
		$asciidec = array();
		
		//The key is the first numerical item in the array it is added to every decimal character number and it is then multiplied by the security multiplier for security
		$key = ($decarray[0]/$securitymultiplier);
		
		//Sometimes the key can be mistakenly placed in the output (but just looks like another random number) this will remove it otherwise we could get a random ascii charcter in the output
		if(($keyitem = array_search($key, $decarray)) !== false) {
		    unset($decarray[$keyitem]);
		}
		
		//For every element in the array except for the first one (which is the key) take away the key to get the original decimal value and convert it to an ascii character
		for($i=1; $i<=count($decarray); $i++){
			array_push($asciidec, chr(($decarray[$i]-$key)));
		}
		
		//Join the decrypted array together into a string
		$asciidecstring = implode("", $asciidec);
		
		//Remove the extra charcters that were automatically placed at the end to ensure accurate encryption and decryption
		$asciidecstring = substr($asciidecstring, 0, -2);
		
		//Return the value
		return $asciidecstring;
		
	}

	//Decrypt Function with debugging information
	function COAdecryptdebug($a, $b) {
	
		//The number the key is multiplied for extra security (Recommended 2 - 13)
		$securitymultiplier = $b;
		//Get the encrypted string
		$dec = $a;
		
		//Replace all non numeric characters with ":"		
		$dec = preg_replace("/[^0-9]/", ":", $dec);
		
		//Array to store idividual encrypted decimal values
		$decarray = array();
		
		//Make an array from the edited string and divide it at every ":" This gives us an array of all the decimals values for all the characters in the original string
		$decarray = explode(':', $dec);		
				
		//Make an array to store the decrypted data
		$asciidec = array();
		
		//The key is the first numerical item in the array it is added to every decimal character number and it is then multiplied by the security multiplier for security
		$key = ($decarray[0]/$securitymultiplier);
		
		//Sometimes the key can be mistakenly placed in the output (but just looks like another random number) this will remove it otherwise we could get a random ascii charcter in the output
		if(($keyitem = array_search($key, $decarray)) !== false) {
		    unset($decarray[$keyitem]);
		}
		
		//For every element in the array except for the first one (which is the key) take away the key to get the original decimal value and convert it to an ascii character
		for($i=1; $i<=count($decarray); $i++){
			array_push($asciidec, chr(($decarray[$i]-$key)));
		}
		
		//Join the decrypted array together into a string
		$asciidecstring = implode("", $asciidec);
		
		//Remove the extra charcters that were automatically placed at the end to ensure accurate encryption and decryption
		$asciidecstring = substr($asciidecstring, 0, -2);
		
		//Return the value and debugging information
		return $asciidecstring . " <br/>Dec: " . $a . " <br/>Key: " . $key . " <br/>Dec Array: " . json_encode($decarray) . " <br/>Ascii Array: " . json_encode($asciidec);
		
	}

	function COAencrypt($a, $b) {
	
		//The number the key is multiplied for extra security (Recommended 2 - 13)
		$securitymultiplier = $b;
		//Get the encrypted string
		$asc = $a . "~";
		
		//The key is the first numerical item in the array it is added to every decimal character number for security
		$key = rand(11, 46);
		
		//Split the unencrypted string into an array with 1 letter per item in the array
		$ascarray = str_split($asc);
		
		//Array of all meaningless characters to be replaced in the string placed between required numerical values
		$letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '_', '>', '<', '~', ',');
		
		//This string will eventually have all the encrypted information but first we add the key which is multiplied by the security multiplier the same as everything else and we also add a spacer from the letters array
		$encryptedstring = strval($key*6) . $letters[rand(0, 58)];
		
		//Converts all the ascii values in the array to their decimal values and add the key
		for($i=0; $i<=(strlen($asc)); $i++){
			if($i==(strlen($asc))){		
				$encryptedstring .= strval(ord($ascarray[$i])+$key);
			}
			else {
				$encryptedstring .= strval(ord($ascarray[$i])+$key) . $letters[rand(0, 58)];
			}
		}
		
		//Return the value
		return $encryptedstring;
		
	}

	function COAencryptdebug($a, $b) {
	
		//The number the key is multiplied for extra security (Recommended 2 - 13)
		$securitymultiplier = $b;
		//Get the encrypted string
		$asc = $a . "~";
		
		//The key is the first numerical item in the array it is added to every decimal character number for security
		$key = rand(11, 46);
		
		//Split the unencrypted string into an array with 1 letter per item in the array
		$ascarray = str_split($asc);
		
		//Array of all meaningless characters to be replaced in the string placed between required numerical values
		$letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '_', '>', '<', '~', ',');
		
		//This string will eventually have all the encrypted information but first we add the key which is multiplied by the security multiplier the same as everything else and we also add a spacer from the letters array
		$encryptedstring = strval($key*6) . $letters[rand(0, 58)];
		
		//Converts all the ascii values in the array to their decimal values and add the key
		for($i=0; $i<=(strlen($asc)); $i++){
			if($i==(strlen($asc))){		
				$encryptedstring .= strval(ord($ascarray[$i])+$key);
			}
			else {
				$encryptedstring .= strval(ord($ascarray[$i])+$key) . $letters[rand(0, 58)];
			}
		}
		
		//Return the value and debugging information
		return $encryptedstring . " <br/>Ascii: " . $dec . " <br/>Key: " . $key . " <br/>Ascii Array: " . json_encode($decarray);
		
	}

?>
