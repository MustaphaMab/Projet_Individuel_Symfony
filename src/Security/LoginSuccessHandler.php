<?php
namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $user = $token->getUser();

        // Redirige en fonction du rôle de l'utilisateur
        if (in_array('ROLE_SUPER_ADMIN', $user->getRoles())) {
            return new RedirectResponse('/super-admin-page');
        } elseif (in_array('ROLE_ADMIN', $user->getRoles())) {
            return new RedirectResponse('/admin-page');
        }

        // Redirection par défaut pour les utilisateurs
        return new RedirectResponse('/user-page');
    }
}
