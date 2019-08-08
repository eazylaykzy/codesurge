<?php

    // Get the form fields, removes html tags and whitespace.
    $name = stripslashes(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);
    $findUs = $_POST["find-us"];

    // Check the data.
    /*if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: https://www.codesurge.io/omnifood/index.php?success=-1#form");
        exit;
    }*/

    if (!isset($name) && !isset($email) && isset($message)) {
        die(header("Location: https://www.codesurge.io/omnifood/index.php?success=-1#form"));
    }

    // Set the recipient email address. Update this to YOUR desired email address.
    $recipient = "queries@codesurge.io";

    // Set the email subject.
    $subject = "New message from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";
    $email_content .= "Found Us Through:\n$findUs\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    mail($recipient, $subject, $email_content, $email_headers);

    // Redirect to the index.php page with success code
    header("Location: https://www.codesurge.io/omnifood/index.php?success=1#form");
