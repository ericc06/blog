<?php

namespace EricCodron\Blog\Model;

class ContactFormManager
{

    public function controlContactForm($firstname, $lastname, $email, $message)
    {
        if(empty($firstname) ||
        empty($lastname) ||
        empty($email) ||
        empty($message) ||
        !filter_var($email,FILTER_VALIDATE_EMAIL))
        {
         //echo "Il y a un problème avec les informations saisis.";
         return false;
        }
        
        $firstname = strip_tags(htmlspecialchars($firstname));
        $lastname = strip_tags(htmlspecialchars($lastname));
        $email = strip_tags(htmlspecialchars($email));
        $message = strip_tags(htmlspecialchars($message));

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