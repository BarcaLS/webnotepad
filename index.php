<?php

// Webnotepad


$file = $_GET["file"]; if($file == "") { $file = "todo.txt"; }

print "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">
<html>
<head>
    <title>$file</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\">
    <link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\" media=\"screen\">
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
<div class=frame><table width=100% align=center><tr>
<td><table width=95% align=center><tr>
<td width=20% align=left><b>Webnotepad</b></td>
<td width=75% align=center><a href=\"./mobile.php\">Switch to mobile version</a></td>
<td width=5%><a href=index.php?file=$file><img src=\"images/refresh.png\" width=50pt></a></td>
</tr></table><br><div id=\"mail\"></div></tr></table></div><div class=frame>You edit file: ";
print "<a href=index.php?file=todo.txt>"; if($file != "todo.txt") { print "todo.txt</a> | "; } else { print "<font color=yellow>todo.txt</font></a> | "; }
print "<a href=index.php?file=notepad.txt>"; if($file != "notepad.txt") { print "notepad.txt</a>"; } else { print "<font color=yellow>notepad.txt</font></a>"; }
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

print "<form width=30% action=index.php?file=$file method=POST><center>
<table><tr><td><input type=image name=Submit src=\"images/ok.jpg\"></td><td align=center>Modified:<br><font color=yellow>" . date ("D, d.n.y H:i", filemtime("files/$file")) . "</font></td>
<td><a href=backup/><img src=\"images/backup.png\" width=40></a></td>
</tr></table>
<textarea name=file_edited rows=25 cols=110 wrap=virtual>$file_notes</textarea>
</form></div>
</body></html>";

?>
