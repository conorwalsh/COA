<html>
	<!--*********************************************************************
	**********************************************************************
				   ____ ___    _    
				  / ___/ _ \  / \   
				 | |  | | | |/ _ \  
				 | |__| |_| / ___ \ 
				  \____\___/_/   \_\
	                  Conor's Obscurification Algorithm
	 
	  Conor Walsh 2014 - 2015
	     Website: http://www.conorwalsh.net
	     GitHub:  https://github.com/conorwalsh
	  
	  Version 1.5
	  
	  VFirst created: 10th August 2014
	  Last modified: 21st March 2015
	  
	  Description: This file is for testing the algorithm	
	  
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
	*******************************************************************-->
	
	<body>
		
		<form method="get"action="">
			<label for="i">Text to encrypt: </label>
			<input type="text" value="<?php echo $_GET["i"]; ?>" name="i" id="i" />
			<button type="submit">Go</button>
		</form>
		
		<?php
		include "coa.php";
		
		  	//The number the key is multiplied for extra security (Recommended 2 - 13) must match the security multiplier on the Arduino or PHP encrypt
			$securitymultiplier = 6;
			//Get the encrypted string
			$original = $_GET["i"];
			
			//Echo the original text
			echo "Original: " . $original . "<br/><br/>";
		
			//$text is equal to the encrypted version of the original
			$text = COAencrypt($original, $securitymultiplier);
			echo "Encrypted text: " . $text . "<br/><br/>";
			
			//$text1 is equal to the decrypted version of $text
			$text1 = COAdecrypt($text, $securitymultiplier);
			echo "Decrypted text: " . $text1 . "<br/><br/>";
			
			//Calculate Percentage Error
			similar_text($original, $text1, $percent); 
			if($original!=""){
				echo "Percentage Error: " . strval(round(100-$percent)) . "%";
			}
			else{
				echo "Percentage Error: 0%";
			}
		?>
		
	</body>
	
</html>
