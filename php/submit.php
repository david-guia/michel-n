<?php


// specify your email here

$to = 'michel.dj.21@orange.fr';



	// Assigning data from $_POST array to variables
    if (isset($_POST['name'])) { $name = $_POST['name']; }
    if (isset($_POST['email'])) { $from = $_POST['email']; }
    if (isset($_POST['company'])) { $company = $_POST['company']; }
    if (isset($_POST['website'])) { $website = $_POST['website']; }
    if (isset($_POST['message'])) { $message = $_POST['message']; }
	
	// Construct subject of the email
	$subject = 'Message de ' . $name;

	// Construct email body
	$body_message .= 'Nom: ' . $name . "\r\n";
	$body_message .= 'Mail: ' . $from . "\r\n";
	$body_message .= 'Téléphone: ' . $company . "\r\n";
	$body_message .= 'Sujet: ' . $website . "\r\n";
	$body_message .= 'Message: ' . $message . "\r\n";

	// Construct headers of the message
	$headers = 'From: ' . $from . "\r\n";
	$headers .= 'Reply-To: ' . $from . "\r\n";

	$mail_sent = mail($to, $subject, $body_message, $headers);

	if ($mail_sent == true){ ?>
<script language="javascript" type="text/javascript">
		window.alert("Sent Successfuly.");
		</script>
<?php } else { ?>
<script language="javascript" type="text/javascript">
                    window.alert("Error! Please Try Again Later.");
                </script>
<?php
	} // End else
    
?>
