<?php

namespace App\Service;

use SendGrid\Mail\Mail;

class EmailGenerator
{
    private $email;

    public function __construct(Mail $email)
    {
        $this->email = $email;
    }

    public function generateEmail($subject, $content)
    {
        $this->email->setFrom("soresfarm@gmx.fr", "The Farmer");
        $this->email->setSubject($subject);
        $this->email->addContent("text/plain", $content);

        return $this->email;
    }
}
