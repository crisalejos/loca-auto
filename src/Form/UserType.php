<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',  EmailType::class, [
                'label' => 'Email : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                'label_format' => 'form.address.%name%',
                'help' => 'Ecrivez votre email avec @'              
            ])
            //->add('roles')
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('firstname',  TextType::class, [
                'label' => 'Prénom : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                'help' => 'Ecrivez votre prénom avec des lettres'
            ])
            ->add('lastname',  TextType::class, [
                'label' => 'Nom : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                'help' => 'Ecrivez votre nom avec des lettres'
            ])
            ->add('birthdate',  BirthdayType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'mt-3 mb-3 combinedPickerInput'],              
            ])
            ->add('phone',  NumberType::class, [
                'label' => 'Numéro de téléphone : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                'label_format' => '00000000000',
                'help' => 'Ecrivez le numéro avec 11 chiffres'
            ])
            ->add('card',  TextType::class, [
                'label' => 'Carte d\'identité : ',
                'label_attr'=>['class' => 'form-label'],
                'attr'=>['class' => 'form-control'],
                //'help' => 'Ecrivez votre carte avec des lettres'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
