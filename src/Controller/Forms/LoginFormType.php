<?php


namespace App\Controller\Forms;



use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //On ajoute les champs du formulaire avec un nom et un type pour chaque
        // <input type="text" name="login" />
        $builder->add('login',TextType::class,
            //On ajoute une contrainte sur le login, il ne doit pas être vide
            ['constraints' => new NotBlank(),]
        );
        // <input type="password" name="password" />
        $builder->add('password',PasswordType::class,[
            //On ajoute deux contraintes sur le champ mot de passe,
            // - Non vide
            // - Longueur comprise entre 3 et 10 caractères
            'constraints' => [
                new NotBlank(),
                //Chaque contrainte peut recevoir des paramètres spécifiques en fonction de ses besoins.
                //Ici, la contrainte Length est paramétrée avec un nombre minimum et un nombre maximum
                //de caractères, puis deux messages personnalisés qui s'afficheront lorsque les contraintes
                //ne sont pas respectées.
                new Length(null,3,10,null,null,null
                    ,"{{ value }} is too short you moron ! Please put more than {{ limit }} characters !"
                    ,"{{ value }} is too long dumb fool... Please put less than {{ limit }} characters !"
                ),
            ]
        ]);
        // <input type="submit" name="submit" />
        $builder->add('submit',SubmitType::class);
    }

}