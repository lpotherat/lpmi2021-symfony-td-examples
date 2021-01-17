<?php


namespace App\Controller\Forms;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function create(Request $request):Response{
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()){

        } else {
            $this->render('user_create.html.twig', ['form' => $form->createView()]);
        }
    }
}