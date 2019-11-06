<?php


namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class MainController
 * @package App\Controller
 */
class MainController extends AbstractController
{

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function homeAction(Request $request)
    {
        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('github_repos');
        }
        return $this->render('main/home.html.twig');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function logoutAction(Request $request)
    {
        return $this->redirectToRoute('home');
    }
}

