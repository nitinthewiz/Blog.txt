<!--
Copyright (c) 2012, Matt Zanchelli
All rights reserved.

Edited by Nitin Khanna
Mar 5 2013

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
	* Redistributions of source code must retain the above copyright
	  notice, this list of conditions and the following disclaimer.
	* Redistributions in binary form must reproduce the above copyright
	  notice, this list of conditions and the following disclaimer in the
	  documentation and/or other materials provided with the distribution.
	* Neither the name of the <organization> nor the
	  names of its contributors may be used to endorse or promote products
	  derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
-->
<?php
	require_once("config.php");
	error_reporting(E_ALL);
	
	if ( isset($_POST["filename"]) && isset($_POST["date"]) && isset($_POST["content"]) && isset($_POST["passkey"]) ) {	// Only works if all four fields are filled out!
		// $dir = "/var/www/emit.nitinkhanna.com/posts";
		
		// $filename = preg_replace("/[^a-zA-Z0-9\._-]/", "", $_POST["filename"]);	// Eh, I'll fix that later
		$filename = $_POST["filename"];	//	(Temporary) Works with spaces
		
		if ( substr($filename, -4) != ".txt" ) {
			$filename .= ".txt";
		}
		if ( $filename == ".txt" ) {	//	Does not create blank '.txt' files
			echo "Must enter a filename!";
			return false;
		}
		$full = $dir . "/" . $filename;	// dir/filename.txt
		$date = $_POST["date"];
		$content = $_POST["content"];
		// getenv('EMITKEY') 
		if ($_SERVER['EMITKEY'] == $_POST["passkey"]){
			if ( file_exists( $full ) ) {	//	Doesn't Overwrite existing file, creates another by that name + 1 (whihc is the wrong implementation)
				$existing = fopen( $full."1", 'w+' );
				if (isset($_POST["url"])){
					fwrite ( $existing, $date . "\n" . "<a href=\"" . $_POST["url"] . "\">" . substr($filename, 0, -4) . "</a>" . "\n" . $content );
				}
				else {
					fwrite ( $existing, $date . "\n" . substr($filename, 0, -4) . "\n" . $content );
				}
				fclose($existing);
				echo "No error "; // . $_SERVER['EMITKEY'] . " is same as " . $_POST["passkey"] . "\n";
				echo "The following got written - " .  $existing, $date . "\n" . "<a href=\"" . $_POST["url"] . "\">" . substr($filename, 0, -4) . "</a>" . "\n" . $content;
				
			} else {
				$new = fopen( $full, 'w+' );	//	Or creates a new file
				if (isset($_POST["url"])){
					fwrite ( $new, $date . "\n" . "<a href=\"" . $_POST["url"] . "\">" . substr($filename, 0, -4) . "</a>" . "\n" . $content );
				}
				else {
					fwrite ( $new, $date . "\n" . substr($filename, 0, -4) . "\n" . $content );
				}
				fclose($new);
				echo "No error "; // . $_SERVER['EMITKEY'] . " is same as " . $_POST["passkey"] . "\n";
				echo "The following got written - " .  $new, $date . "\n" . "<a href=\"" . $_POST["url"] . "\">" . substr($filename, 0, -4) . "</a>" . "\n" . $content;
			}
		}
		else{
			echo "error in password"; //" . $_SERVER['EMITKEY'] . " is not same as " . $_POST["passkey"] . "\n";
		}	
	}
?>
<!doctype html>
<html>
	<head>
		<title>Edit</title>
		<script type="text/javascript">
		function setDate(){
			var m_names = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			
			var now = new Date();
			var curr_date = now.getDate();
			var curr_month = now.getMonth();
			var curr_year = now.getFullYear();
			document.getElementById("a").value= m_names[curr_month] + " " + curr_date + " " + curr_year;
		}
		</script>
		<style>
		body {
			-webkit-font-smoothing: antialiased;
			font: 14px/1.8em "PT Serif", serif;
		}
		textarea {
			padding: 0px;
			padding-left: 2px;
			width: 657.586px;
			font: inherit;
		}
	</style>
	</head>
	
	<body onload="setDate()">
		<form method="POST" name="newPost" action="create.php" enctype="multipart/form-data">
			<textarea id="a" class="editable" name="date" rows="1" style="resize:none;"></textarea><br />
			<textarea id="b" class="editable" name="filename" rows="1" style="resize:none;" placeholder="Title"></textarea><br />
			<textarea id="c" class="editable" name="content" placeholder="Content"></textarea><br />
			<textarea id="d" class="editable" name="passkey" rows="1" style="resize:none;" placeholder="key"></textarea><br />
			<textarea id="e" class="editable" name="url" rows="1" style="resize:none;" placeholder="URL"></textarea><br />
			<input id="submit1" class="editable" type="submit" value="Done" style="resize:resize;" onclick="edit()"/>
		</form>
	</body>
</html>
