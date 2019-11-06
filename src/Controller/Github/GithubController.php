<?php

namespace App\Controller\Github;

use App\Cache\GithubReposCache;
use App\Model\RepoFactory;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GithubController
 * @package App\Controller\Github
 */
class GithubController extends AbstractController
{

    /**
     * @var GithubReposCache
     */
    private $githubApiReposCache;

    /**
     * GithubController constructor.
     *
     * @param GithubReposCache $githubApiCache
     */
    public function __construct(GithubReposCache $githubApiCache)
    {
        $this->githubApiReposCache = $githubApiCache;
    }

    /**
     * @param ClientRegistry $clientRegistry
     *
     * @return RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry
            ->getClient('github')
            ->redirect(['public_profile', 'email']);
    }

    /**
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry): void
    {
        // Using Guard authenticator
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function reposAction(Request $request)
    {
        if ($this->getUser() == null) {
            return $this->redirect($this->generateUrl('home'));
        }
        $repos = RepoFactory::createList(
            $this->githubApiReposCache->getCurrentUserRepos()
        );

        return $this->render('github/repos.html.twig',
            [
                'repos' => $repos
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function profileAction(Request $request)
    {
        if ($this->getUser() == null) {
            return $this->redirect($this->generateUrl('home'));
        }
        return $this->render('github/profile.html.twig',
            [
                'user' => $this->getUser()
            ]
        );
    }
}