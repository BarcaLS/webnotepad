<?php

// Settings (you can specify more than only one mailbox)
$email_to_be_notified = "user@host.com"; // you will receive notification on page tab in your web browser when
                                         // new e-mail will be received on this e-mail address
$email[0] = "user@host.com";
$password[0] = "password";
$host[0] = "mail.host.com";
$port[0] = "143";
$tls[0] = "notls";
$email[1] = "user2@host.com";
$password[1] = "password2";
$host[1] = "mail.host.com";
$port[1] = "143";
$tls[1] = "notls";

// Main part
$file = $_GET["file"]; if($file == "") { $file = "todo.txt"; }
print "<script type=\"text/javascript\">document.title = \"$file\";</script>";
$count = count($email);
print "<table width=95% align=center><tr><td width=1% rowspan=$count>EMAIL</td>";
for($mailbox_number = 0; $mailbox_number < $count; $mailbox_number++) {
	$email_current = $email[$mailbox_number];
	$password_current = $password[$mailbox_number];
	$host_current = $host[$mailbox_number];
	$port_current = $port[$mailbox_number];
	$tls_current = $tls[$mailbox_number];
	$mailbox = imap_open("{{$host_current}:$port_current/$tls_current}INBOX", $email_current, $password_current);
	$check = imap_check($mailbox);
	print("<td align=left><font color=yellow>$email_current</font>: " . $check->Nmsgs . "</td><td>");
	$counter2 = 0;
	if($email_current==$email_to_be_notified) {
		if($counter != 0) { print "Messages on $email_current:<br>"; }
		for($counter = $check->Nmsgs; $counter >= 1; $counter--) {
			$mail_info = imap_fetch_overview($mailbox, $counter, 0);
			foreach($mail_info as $mail_info2) {
				$counter2++;
				print "$counter2) ";
				if(!$mail_info2->seen) {
				    print "<script type=\"text/javascript\">document.title = \"New mail !!!!!!!!!!!!!!!!!!\";</script>";
				    print "<img src=images/new.gif> "; }
				print "Od <font color=yellow>" . iconv_mime_decode($mail_info2->from,0,"UTF-8") . "</font> o tytule <font color=yellow>" . imap_utf8($mail_info2->subject) . "</font> (" . date("d/m/Y H:i",strtotime($mail_info2->date)) . ")<br>";
			}
   		}
	}
	print "</td></tr>";
	imap_close($mailbox);
}
print "</table>";

?>
