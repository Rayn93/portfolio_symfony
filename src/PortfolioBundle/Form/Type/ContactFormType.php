<?php


namespace PortfolioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ContactFormType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options){


        $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('massage', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'WYŒLIJ'))
            ->getForm();

    }


}