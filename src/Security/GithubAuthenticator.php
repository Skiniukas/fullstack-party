<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use KnpU\OAuth2ClientBundle\Client\OAuth2Client;
use KnpU\OAuth2ClientBundle\Security\Authenticator\SocialAuthenticator;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Class GithubAuthenticator
 */
class GithubAuthenticator extends SocialAuthenticator
{
    /**
     * @var ClientRegistry
     */
    private $clientRegistry;

    /**
     * @var RouterInterface
     */
    private $router;

    /** @var EntityManagerInterface */
    private $em;

    /**
     * GithubAuthenticator constructor.
     *
     * @param ClientRegistry $clientRegistry
     * @param RouterInterface $router
     * @param EntityManagerInterface $em
     */
    public function __construct(
        ClientRegistry $clientRegistry, RouterInterface $router, EntityManagerInterface $em)
    {
        $this->clientRegistry = $clientRegistry;
        $this->router = $router;
        $this->em = $em;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === 'github_connect_check';
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return User|UserInterface|null
     * @throws \Exception
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {

        $githubUser = $this->getGithubClient()->fetchUserFromToken($credentials);

        try {

            $user = $userProvider->loadUserByUsername($githubUser->getId());
            $user->setUpdatedAt(new \DateTime());

        } catch (UsernameNotFoundException $e) {

            $githubUserArr = $githubUser->toArray();

            $user = new User($githubUser->getId());
            $user->setGithubUsername($githubUserArr['login']);
            $user->setGithubNickname($githubUserArr['name']);
            $user->setGithubAvatar($githubUserArr['avatar_url']);

            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }

    /**
     * @param Request $request
     *
     * @return AccessToken
     */
    public function getCredentials(Request $request): AccessToken
    {
        return $this->fetchAccessToken($this->getGithubClient());
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('github_repos'));
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());
        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     *
     * @return RedirectResponse
     */
    public function start(Request $request, ?AuthenticationException $authException = null): RedirectResponse
    {
        return new RedirectResponse($this->router->generate('home'));
    }

    /**
     * @return OAuth2Client
     */
    private function getGithubClient(): OAuth2Client
    {
        return $this->clientRegistry->getClient('github');
    }
}