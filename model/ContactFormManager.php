<?php

namespace EricCodron\Blog\Model;

require_once("vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php");

use HTMLPurifier;

class ContactFormManager
{

    // Controls that the contact form fields are not empty and that the email address
    // is well formed, and sends the email if OK. Else, returns false.
    public function controlContactForm($firstname, $lastname, $email, $message)
    {
        if(empty($firstname) ||
        empty($lastname) ||
        empty($email) ||
        empty($message) ||
        !filter_var($email,FILTER_VALIDATE_EMAIL))
        {
         return false;
        }
        
        // Initializing HTMLPurifier with default configuration
        $purifier = new HTMLPurifier();

        $firstname = $purifier->purify($firstname);
        $lastname = $purifier->purify($lastname);
        $email = $purifier->purify($email);
        $message = $purifier->purify($message);

        return self::send($firstname, $lastname, $email, $message);
    }
    
    // Sends an HTML email. We can use basic HTML tags. We have to insert
    // new lines using <br /> or paragraphs. Uses the UTF-8 encoding.
    public function send($firstname, $lastname, $email, $message)
    {
        include("config.php");

        $from = $firstname . ' ' . $lastname . ' <' . $email . '>';
        $header = 'From: ' . $from . "\r\n";
        $header .= 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-Type: text/html; charset="utf-8"' . "\r\n";

        return mb_send_mail($contact_mail_recipient, $contact_mail_subject, $message, $header);
    }

}