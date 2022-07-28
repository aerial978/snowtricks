<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '8',
                'maxlength' => '50',
                'placeholder' => 'Username'
            ],
            'label_attr' => [
                'class' => 'form_label fa-solid fa-user'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min'=> 8, 'max'=> 50])
            ]
        ]) 

        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlength' => '2',
                'maxlength' => '180',
                'placeholder' => 'Address email'
            ],
            'label_attr' => [
                'class' => 'form_label fa-solid fa-envelope mt-4'
            ]
        ])  
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            /*'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],*/
            'first_options' => [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Password'
                ],
                'label_attr' => [
                    'class' => 'form_label fa-solid fa-lock mt-4'
                ]    
            ],
            'second_options' => [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Password confirmation'
                ],
                'label_attr' => [
                    'class' => 'form_label fa-solid fa-lock mt-4'
                ]
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 2,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 255,
                ]),
            ],
        ])
            /*->add('picture')*/
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'mt-4'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-info mt-4'
                ],
                'label' => 'Register'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
