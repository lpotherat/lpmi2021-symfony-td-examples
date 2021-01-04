<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldController extends AbstractController
{
    /**
     * Controller "hello world", affiche la chaîne "Hello World" dans le navigateur
     * @param string $prenom le prénom à afficher
     * @return Response
     */
    function hello(string $prenom):Response{
        return $this->render('hello.html.twig',[
            'prenom'=>$prenom
        ]);
    }

    /**
     * @return Response
     */
    function helloListe():Response{
        return $this->render('helloliste.html.twig',[
            'liste'=>[
                ['prenom'=>'Patrick','nom'=>'Michoulier'],
                ['prenom'=>'Daniel','nom'=>'Fouetlefoin'],
            ]
        ]);
    }

    /**
     * Affiche un formulaire HTML
     * @return Response
     */
    function form():Response{
        return new Response("<html lang='en'>
        <body>
            <form method='post' action='/form/receive'>
                Nom : <input name='name' />
                <input type='submit'/>
            </form>
        </body>
        </html>");
    }

    /**
     * @param Request $request
     * @return Response
     */
    function formReceive(Request $request):Response{
        $name = $request->request->get('name');

        return new Response("Merci $name");
    }
}