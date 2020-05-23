<?php

// Webnotepad mobile

$file = $_GET["file"]; if($file == "") { $file = "todo.txt"; }

print "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
    <title>$file</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\">
    <link rel=\"stylesheet\" href=\"mobile.css\" type=\"text/css\" media=\"screen\">
    <script src=\"http://code.jquery.com/jquery-latest.js\"></script>
    <script>
        $(document).ready(function() {
        $(\"#mail\").load(\"mail.php?file=$file\");
        var refreshId = setInterval(function() {
        $(\"#mail\").load('mail.php?file=$file&?randval='+ Math.random());
        }, 60000); // Refresh every 60 seconds
        });
    </script>
</head>
<body>
<p><center><a href=\"./index.php\" style=\"color: white; font-size: 250%; font-family: sans-serif;\">Switch to desktop version</a>
<br><font color=white style=\"color: white; font-size: 250%; font-family: sans-serif;\">You edit file: ";
print "<a href=mobile.php?file=todo.txt>"; if($file != "todo.txt") { print "todo.txt</a> | "; } else { print "<font color=yellow>todo.txt</font></a> | "; }
print "<a href=mobile.php?file=notepad.txt>"; if($file != "notepad.txt") { print "notepad.txt</a>"; } else { print "<font color=yellow>notepad.txt</font></a>"; }
$file_new = $_POST['file_edited'];
if($file_new != "")
{
	$file_stream = fopen("files/$file", "wt");
	$file_new = str_replace("\r\n", "\n", $file_new);
	$file_new = stripslashes($file_new);
	fwrite($file_stream, $file_new);
	fclose($file_stream);
}
$file_stream = fopen("files/$file", "rt");
$file_notes = fread($file_stream, filesize("files/$file"));
fclose($file_stream);

print "<form width=30% action=mobile.php?file=$file method=POST><center>
<font style=\"font-size: 75%;\">Modified: <font color=yellow>" . date ("D, d.n.y H:i", filemtime("files/$file")) . "</font>
<table><tr><td align=left width=33%><input type=image name=Submit src=\"images/ok.jpg\" height=57pt></td>
<td align=center width=33%><a href=mobile.php?file=$file><img src=\"images/refresh.png\" height=57pt></a></td>
<td align=right width=33%><a href=backup/><img src=\"images/backup.png\" height=57pt></a></td>
</tr></table>
<textarea name=file_edited rows=100 wrap=virtual>$file_notes</textarea>
</form>
</body></html>";

?>
