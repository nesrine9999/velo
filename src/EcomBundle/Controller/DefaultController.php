<?php

namespace EcomBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Velo;
use AppBundle\Entity\Actualite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function actualiteAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
        $actualites = $em->getRepository('AppBundle:Actualite')->findAll();

        return $this->render('@Ecom/index.html.twig',array('actualites'=>$actualites));
    }


    public function locationAction()
    {
        $em = $this->getDoctrine()->getEntityManager();



        $velo= $em->getRepository('AppBundle:Velo')->findAll();


        return $this->render('@Ecom/Ecom/Location.html.twig',array('velo'=>$velo));
    }
    public function formulaireAction(Request $request)
    {
        $velo = new Velo();
        $form = $this->createFormBuilder($velo)
            ->add('date_circulation', DateType::class, array('data' => new \DateTime(), 'widget' => 'single_text'))
            ->add('datePublication', DateType::class, array('data' => new \DateTime(), 'widget' => 'single_text'))
            ->add('prix')
            ->add('description')
            ->add('localitsation_velo')
            ->add('photo',FileType::class,array('data_class' => null))
            ->add('categories', EntityType::class, array(
                'class' => 'AppBundle:Categories',
                'choice_label' => 'nom',
                'mapped' => false
            ))
            ->add('age', EntityType::class, array(
                'class' => 'AppBundle:Categories',
                'choice_label' => 'age',
                'mapped' => false
            ))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Photo = $velo->getPhoto();
            if ($Photo) {
                $fileName = md5(uniqid()) . '.' . $Photo->guessExtension();

                try {
                    $Photo->move(
                        $this->getParameter('Photo_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                }
                $velo->setPhoto($fileName);
            }
            $velo->setdateCirculation($form['date_circulation']->getData());
            $velo->setdatePublication($form['datePublication']->getData());
            $velo->setprix($form['prix']->getData());
            $velo->setdescription($form['description']->getData());
            $velo->setLocalitsationVelo($form['localitsation_velo']->getData());
            $velo->setphoto($form['photo']->getData());
            $velo->setUser($this->getUser());
            $velo->setcategories($form['categories']->getData());
            $velo->setAgeRecommande($form['age']->getData());

            $velo->setEtatLocation(0);
            $velo->setetatVendu(0);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($velo);
            $em->flush();
            return $this->redirect($this->generateUrl('ecom_location'));


        }
        return $this->render('@Ecom/Ecom/formulaire.html.twig', array('form' => $form->createView()));

    }

}