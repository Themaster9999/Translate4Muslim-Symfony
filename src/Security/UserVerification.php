<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Verify;
use Doctrine\ORM\EntityManagerInterface;

class UserVerification
{
    public function __construct(private EntityManagerInterface $emi)
    {
    }

    public function verify($token): void
    {
        $verify = $this->emi->getRepository(Verify::class)->findOneBy(['token' => $token]);

        if(!$verify->isUsed())
        {
            if($verify->getUser() && !$verify->getUser()->isVerified())
            {
                if($token == $verify->getUser()->getVerify()->getToken())
                    $this->VerificationSuccess($verify->getUser()); 
                else
                    dd("error");
            }
        }
        else
            dd("Link Already Used or User Is Already Verified");
    }

    protected function VerificationSuccess(?User $user)
    {
        if($user)
        {
            $user->setVerified(true);
            $user->getVerify()->setUsed(true);
            $this->emi->persist($user);
            $this->emi->flush();
        }
    }
}

?>