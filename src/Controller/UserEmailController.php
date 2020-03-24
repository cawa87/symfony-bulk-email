<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserEmailController extends AbstractController
{
    /**
     * @Route("/user/email", name="user_email_index")
     */
    public function index()
    {
        return $this->render('user_email/index.html.twig', [
            'controller_name' => 'UserEmailController',
        ]);
    }
}
