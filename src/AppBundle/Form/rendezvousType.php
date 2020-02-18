<?php

namespace AppBundle\Form;

use AppBundle\AppBundle;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Exp\CommunBundle\Form\DataTransformer\StringToDateTransformer;
use Exp\Diagnostic\CoreBundle\Entity\Liste\Laboratoire;
use Exp\Diagnostic\CoreBundle\Form\Type\DiagnosticGeneralType;
use Exp\Diagnostic\DrippComplementaireBundle\Entity\DrippComplementaire;
use Exp\Diagnostic\DrippComplementaireBundle\Form\Type\DrippComplementaireTypeGestionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class rendezvousType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('prenom' )
            ->add('email')
            ->add('adresse')
            ->add('message')
            ->add('typepanne', ChoiceType::class,array('choices'=>array('Contrôleur'=>'Contrôleur',' Connectique'=>' Connectique','Capteur de pédalage'=>'Capteur de pédalage','Display au guidon'=>'Display au guidon')))
            ->add('numtel')





            ->add('Ajouter', SubmitType::class);


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\rendezvous'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_rendezvous';
    }


}
