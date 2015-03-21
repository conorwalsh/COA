/*********************************************************************
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
  
  Version 3.2
  
  First created: 10th August 2014
  Last modified: 21st March 2015

  Description: This sample code shows how the alogoritm can be used
               with its PHP companion to more securly send data
               from an Arduino to a MySQL database.
  
 *************************** LICENCE *****************************
 
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
  
******************************************************************
*****************************************************************/

//This is an array of charcters that are used by my encrytion alogritim to generate secure hashes for network communication
const char letters[58] = {'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '!', '_', '>', '<', '~', ','};

void setup() {
  Serial.begin(9600);
  Serial.println("Ready");
  Serial.println(" ");
}

void loop() {
  
  String messagenew = "Hello World!";
  
  String encryptedmessage = COAencrypt(messagenew, 6);
  
  Serial.println("Original: " + messagenew);
  Serial.println("Encrypted: " + encryptedmessage);
  Serial.println("");
  
  delay(5000);
}

String COAencrypt(String messagetext1, int securityMultiplier) {
  
  //Add a character to avoid corruption
  String decryptedText = messagetext1 + "~"; 
  //This key is a random number between 11 and 46 that is used to encrypt the information into a hash
  int key = random(11, 46);
    
  //Create a byte array that has the same number of bytes as the string
  byte textByte[decryptedText.length()];
  //Convert the unencypted information to a byte array that was created in the previous line
  decryptedText.getBytes(textByte, decryptedText.length()); 
  
  //This line creates the string that stores the hash
  //Step 1 of the encryption is to multiply the key by 6 and then add a random letter/symbol stored in the letters array
  //E.g. the start of the encryption looks like this 210x the key is 35 and the random character is x
  String textDec = String(key*securityMultiplier) + letters[random(0, 58)];
  
  //This loop runs once for every charcter in the unencypted array which was converted from the unencrypted string
  for(int i = 0; i <= decryptedText.length(); i++){
    //If it is the last character in the array then run this function
    if(i==decryptedText.length()){
      //Convert the character to decimal value e.g a = 97
      //Add the key to the decimal value e.g. if the key = 35 then a = 132 (97 + 35)
      //Convert the integers to a string
      //Add it to the already encryted data in the string
      textDec = textDec + String(String(textByte[i]).toInt()+key);  
    }
    //If it is not the last character in the array then run this function
    else{
      //Convert the character to decimal value e.g a = 97
      //Add the key to the decimal value e.g. if the key = 35 then a = 132 (97 + 35)
      //Convert the integers to a string
      //Add a random charcter/symbol from the letters array this acts as a spacer for the decrytion algoritim on the server side because the decimal value can...
      //...be 2 or 3 numbers long and it is difficult to seperate otherwise whereas with the character/symbol spacer the alogoritim knows where the decimal values start and end.
      //Add it to the already encryted data in the string
      textDec = textDec + String(String(textByte[i]).toInt()+key) + letters[random(0, 58)];
    }
  }
  //Tell serial the encrypted data that is sent to the server (For debugging)
  return textDec; 
}
