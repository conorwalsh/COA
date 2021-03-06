# COA
COA: Conor's Obfuscation Algorithm is a way of obscuring data being sent between an Arduino and a webserver. This is useful as most reversible encryption algorithms won’t run on Arduino and the very few that do are extremely slow. This algorithm can obscure most data on an Arduino in 100 to 300 milliseconds (It takes 400 milliseconds for a human to blink).

You can see the PHP example code in action <a href="http://www.conorwalsh.net/algorithms/coa/" target="_blank">here</a>.

I originally wrote this software as part of an award winning Internet of Things project that I presented at the BT Young Scientist and Technology Exhibition 2015 (Ireland).

Please note that this is not a fully finished piece of software and on some rare occasions artefacts can be left in the decrypted string but this has only happened to me on very rare occasions (with very long strings, it is extremely unlikely to occur in short strings).

Thank you for taking the time to look at this project I hope that it is of use to you,<br/>
<img src="http://conorwalsh.net/sig.png" /><br/>
Conor Walsh.
