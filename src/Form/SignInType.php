<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class ,
            ['label' => false , 'attr' => ['class'=>'input_field' , 'placeholder' => 'Email']])
            ->add('password',PasswordType::class ,
            ['label' => false , 'attr' => ['class'=>'input_field', 'placeholder' => 'Password']])
            ->add('keep',CheckBoxType::class ,
            ['label' => false, 'required' => false, 'invalid_message' => 'Wrong Credentials !', 'attr' => ['class' => 'check_box']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
