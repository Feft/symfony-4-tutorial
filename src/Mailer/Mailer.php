<?php

namespace App\Mailer;


use App\Entity\User;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var \Twig_Environment
     */
    private $twig;
    /**
     * @var string
     */
    private $mailFrom;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     * @param string $mailFrom
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, string $mailFrom)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->mailFrom = $mailFrom;
    }

    public function sendConfirmationEmail(User $user)
    {
        $body = $this->twig->render('email/registration.html.twig', [
            'user' => $user
        ]);

        $message = (new \Swift_Message())
            ->setSubject('Welcome to the micro-post app!')
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body, 'text/html')
//            ->setBody(htmlspecialchars(trim(strip_tags($body))), 'text/plain')
        ;

        $this->mailer->send($message);
    }
}