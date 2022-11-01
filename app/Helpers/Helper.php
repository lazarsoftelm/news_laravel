<?php

namespace App\Helpers;

use Exception;
use SendGrid\Mail\Mail;

class Helper
{
    public static function email(string $mailTitle, array $sendTos, string $mailText)
    {
        $email = new Mail();
        $email->setFrom("vladanrstcmet@gmail.com", "Mr Vladan Ristic");
        $email->setSubject($mailTitle);
        $email->addTos($sendTos);
        $email->addContent("text/html", $mailText);
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}
