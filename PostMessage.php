<!-- This is an online message board that we did as a class. This exercise is in "PHP Programming with MySQL" chapter 6 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Message Board</title>
</head>
<body>
	<?php
		if(isset($_POST["submit"])) {
			$Subject = stripslashes($_POST["subject"]);
			$Name = stripslashes($_POST["name"]);
			$Message = stripslashes($_POST["message"]);

			// Replace any '~' eith a '-'
			$Subject = str_replace(	"~", "-", $Subject);
			$Name = str_replace(	"~", "-", $Name);
			$Message = str_replace(	"~", "-", $Message);

			// Create a varibale that serves a single line of data for us to save to the file
			$MessageRecord = "$Subject~$Name~$Message\n";

			// open up the file messages.txt and save the file data to a variable
			$MessageFile = fopen("MessageBoard/messages.txt", "ab");

			// check to see if there are issues accessing that file, if so, handle the error, if not, post the message
			if($MessageFile	=== FALSE) {
				echo "There was an error saving your message!\n";
			}
			else {
				fwrite($MessageFile, $MessageRecord);
				fclose($MessageFile);
				echo "Your message has been saved.\n";
			}
		}
	?>	
	<h1>Post New Message</h1>
	<hr/>
	<form action = "PostMessage.php" method = "POST">
		<label style = "font-weight: bold;" for = "subject">Subject:</label>
		<input type = "text" name = "subject" />
		<label style = "font-weight: bold;" for = "name">Name:</label>
		<input type = "text" name = "name" /><br />
		<textarea name = "message" rows = "6" cols = "80"></textarea><br />
		<input type = "submit" name = "submit" value = "Post Message" />
		<input type="reset" name="reset" value = "Reset Form" />
	</form>
	<hr />
	<p><a href = "MessageBoard.php">View Messages</a></p>

</body>
</html>