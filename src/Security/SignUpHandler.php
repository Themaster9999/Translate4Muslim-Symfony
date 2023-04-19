<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Badge;
use App\Entity\Verify;
use App\Entity\Profile;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;

class SignUpHandler
{
    public function __construct(private EntityManagerInterface $emi,private MailerInterface $mailer)
    {
    }

    public function push($data): void
    {
        $user = new User();
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword(password_hash($data['password'],PASSWORD_DEFAULT));

        $badge = $this->emi->find(Badge::class,3);

        $profile = new Profile();
        $profile->setEmail($user->getEmail());
        $profile->setUsername($user->getUsername());
        $profile->addBadge($badge);

        $user->setProfile($profile);

        $verify = new Verify();
        $verify->setToken(bin2hex(random_bytes(16))."_".bin2hex(random_bytes(16))."_".bin2hex(random_bytes(16)));
        $verify->setUser($user);

        $this->emi->persist($user);
        $this->emi->persist($profile);
        $this->emi->persist($verify);
        $this->emi->flush();


        $body = "<a href='http://127.0.0.1:8000/verify/".$verify->getToken()."'><h1 style='text-align:center;color:green;font-family:monospace:font-size:32px;'>Verify Account !!</h1></a>";

        $email = (new Email())
            ->from('administrator@translate4muslim.com')
            ->to($data['email'])
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Welcome To Translate4Muslim')
            ->text('Salamu Ailikum !! Please Verify Your Account.')
            ->html($body);

        $this->mailer->send($email);
    }
}
