<?php


namespace App\Controller\Forms;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('login',TextType::class);
        $builder->add('password',PasswordType::class);
        $builder->add('firstname',TextType::class);
        $builder->add('lastname',TextType::class);
        $builder->add('birthdate',DateType::class);

    }

}