<?php

namespace AdminBundle\Form\Type;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\OptionsResolver\OptionsResolver;


class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,  array $options){


        $builder
            ->add('title', Type\TextType::class, array(
                'label' => 'Tytuł',
                'attr' => array(
                    'placeholder' => 'Tytuł',
                ),
            ))
            ->add('slug', Type\TextType::class, array(
                'label' => 'Alias',
                'attr' => array(
                    'placeholder' => 'Alias',
                )
            ))
            ->add('link', Type\TextType::class, array(
                'label' => 'Link',
                'attr' => array(
                    'placeholder' => 'Link do projektu',
                )
            ))
            ->add('content', Type\TextareaType::class, array(
                'label' => 'Opis',
                'attr' => array(
                    'rows' => 10,
                    'placeholder' => 'Opis projektu',
                )
            ))
            ->add('thumbnail', Type\FileType::class, array(
                'label' => 'Miniaturka',
            ))
            ->add('publishedDate', Type\DateTimeType::class, array(
                'label' => 'Data publikacji',
                'date_widget' => 'single_text',
                'time_widget' => 'single_text'
            ))
            ->add('homePage', Type\CheckboxType::class, array(
                'label' => 'Strona główna?',
                'required' => false
            ))
            ->add('category', EntityType::class, array(
                'label' => 'Kategoria',
                'class' => 'PortfolioBundle\Entity\Category',
                'choice_label' => 'name',
                'empty_data' => 'Wybierz kategorię'
            ))
            ->add('tags', EntityType::class, array(
                'label' => 'Tagi',
                'class' => 'PortfolioBundle\Entity\Tags',
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => array(
                    'placeholder' => 'Dodaj tagi'
                )
            ))
            ->add('save', SubmitType::class, array('label' => 'Zapisz'))
            ->getForm();

    }

    public function getName()
    {
        return 'project';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PortfolioBundle\Entity\Project',
        ));
    }

}