<?php

namespace App\Security;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SignInAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;
    private $token;

    public const LOGIN_ROUTE = 'index';

    public function __construct(private UrlGeneratorInterface $urlGenerator, private SignUpHandler $suh)
    {
    }

    public function check(Request $request): ?array
    {
        $this->token = $request->request->get('_csrf_token');

        if($data = $request->request->all('sign_in'))
        {
            $request->getSession()->set(Security::LAST_USERNAME, $data['email']);

            return $data;
        }
        else if($data = $request->request->all('sign_up'))
        {
            $data = $request->request->all('sign_up');
            $this->suh->push($data);

            return $data;
        }     

        return null;
    }

    public function authenticate(Request $request): Passport
    {
        if($data = $this->check($request))
        {   
            return new Passport(
                new UserBadge($data['email']),
                new PasswordCredentials($data['password']),               
                [
                    new CsrfTokenBadge('authenticate', $this->token),
                ]);
        }
        else
        {
            return new Passport(
                new UserBadge(''),
                new PasswordCredentials(''),               
                [
                    new CsrfTokenBadge('authenticate', ''),
                ]);
        }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {

            return new RedirectResponse($targetPath);
        }

        // For example:
        return new RedirectResponse($this->urlGenerator->generate('dashboard'));
        //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
