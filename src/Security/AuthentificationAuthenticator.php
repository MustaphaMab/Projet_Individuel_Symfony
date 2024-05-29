<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class AuthentificationAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function authenticate(Request $request): Passport
    // méthode Passport qui permet de créer et retourne un Passeport, 
    // qui contient les information d'dentitfication de l'utilisateur
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            // UserBadge identifie l'utilisateur par son mail 
            new PasswordCredentials($request->request->get('password', '')),
            // PasswordCredentials gère la vérification du mot de pass 
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
                // Assure la sécurité contre les attaques CSRF  en validant un token CSRF
                new RememberMeBadge(),
                // Active la fonctionnalité "se souvenir de moi" pour les sessions prolongées
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    // onAuthenticationSuccess permet de gérer la redirection de l'utilisateur en fonction de son rôle 
    {
        // dump('onAuthenticationSuccess called');
        // if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
        //     return new RedirectResponse($targetPath);
        // }
        $roles = $token->getRoleNames(); // Récupère les noms de rôles de l'utilisateur connecté

        // Détermine la route de redirection en fonction des rôles de l'utilisateur
        if (in_array('ROLE_SUPER_ADMIN', $roles)) {
            $redirectRoute = 'app_acceuil_super_admin'; 
        } elseif (in_array('ROLE_ADMIN', $roles)) {
            $redirectRoute = 'admin'; 
        } else {
            // Par défaut, redirige les utilisateurs ayant le rôle USER (ou sans rôle spécifique) vers une page d'accueil pour les utilisateurs
            $redirectRoute = 'app_home'; // Remplacer par la route de la page d'accueil de l'utilisateur
        }

        return new RedirectResponse($this->urlGenerator->generate($redirectRoute));


        
        // throw new \Exception('TODO: provide a valid redirect inside ' . __FILE__);
    }

    protected function getLoginUrl(Request $request): string
    // getLoginUrl redirige vers la page de connexion, ex: accés refusé
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
