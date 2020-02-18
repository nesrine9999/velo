<?php

namespace UserBundle\Controller;

use AppBundle\Entity\Demande_conge;
use AppBundle\Entity\event;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\rendezvous;
use AppBundle\Form\rendezvousType;
use AppBundle\Repository\rendezvousRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use UserBundle\Controller\Symfony\Component\Form\FormBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Gregwar\CaptchaBundle\GregwarCaptchaBundle;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Gregwar\CaptchaBundle\Type\CaptchaType;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@User/Default/index.html.twig');

    }
    public function bootAction()
    {
        return $this->render('@User/Default/boot.html.twig');

    }


    public function inscriptionAction(Request $request)
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('Cin', TextType::class)
            ->add('Nom', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Prenom', TextType::class)
            ->add('Num_tel', TextType::class)
            ->add('Sexe', ChoiceType::class, array('choices' => array('Homme' => 'Homme', 'Femme' => 'Femme')))
            ->add('Date_naissance', DateType::class, array('data' => new \DateTime(), 'widget' => 'single_text'))
            ->add('Adresse', TextType::class)
            ->add('Poste', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Civilite', ChoiceType::class, array('choices' => array('Monsieur' => 'Monsieur', ' Madame' => ' Madame', 'Mademoiselle' => 'Mademoiselle')))
            ->add('Pays', CountryType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Ville', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Code_postal', TextType::class)
            ->add('Photo', FileType::class, array('data_class' => null, 'required' => True))
            ->add('roles', ChoiceType::class, array('multiple' => true, 'choices' => array('Admin' => 'ROLE_ADMIN', 'Acheteur' => 'ROLE_ACHETEUR', 'Vendeur' => 'ROLE_VENDEUR', 'Chef d equipe' => 'ROLE_CHEF_EQUIPE', 'Reparateur' => 'ROLE_Reparateur')))
            ->add('Username', TextType::class, array('attr' => ['pattern' => '[a-zA-Z]*']))
            ->add('Email', EmailType::class)
            ->add('Password', PasswordType::class, ['required' => True])
            ->add('Entrecode', CaptchaType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Photo = $user->getPhoto();
            if ($Photo) {
                $fileName = md5(uniqid()) . '.' . $Photo->guessExtension();

                try {
                    $Photo->move(
                        $this->getParameter('Photo_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                }
                $user->setPhoto($fileName);
            }


            $user->setCin($form['Cin']->getData());
            $user->setNom($form['Nom']->getData());
            $user->setPrenom($form['Prenom']->getData());
            $user->setNumtel($form['Num_tel']->getData());
            $user->setSexe($form['Sexe']->getData());
            $user->setDateNaissance($form['Date_naissance']->getData());
            $user->setAdresse($form['Adresse']->getData());
            $user->setPoste($form['Poste']->getData());
            $user->setCivilite($form['Civilite']->getData());
            $user->setPays($form['Pays']->getData());
            $user->setVille($form['Ville']->getData());
            $user->setCodepostal($form['Code_postal']->getData());
            $user->setPhoto($fileName);
            $user->setRoles($form['roles']->getData());

            $user->setUsername($form['Username']->getData());
            $user->setEmail($form['Email']->getData());
            $user->setPlainPassword($form['Password']->getData());
            $user->setEnabled(true);
            $em = $this->getDoctrine()->getEntityManager();


            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('ecom_homepage'));


        }
        return $this->render('@User/Default/inscription.html.twig', array('form' => $form->createView()));
    }

    public function EspaceAcheteurAction()
    {

        $em = $this->getDoctrine()->getEntityManager();

        $expr = $em->createQueryBuilder()->expr();
        $query = $em->getRepository('AppBundle:User')->createQueryBuilder('u')
            ->where('u.roles LIKE :bo')
            ->setParameters([
                    'bo' => '%"ROLE_REPARATEUR"%']
            )
            ->getQuery();

        $reparateurs = $query->getResult();


        return $this->render('@User/Default/EspaceAcheteur.html.twig', array('Reparateurs' => $reparateurs));


    }


    public function EspaceRdvAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getEntityManager();


        $User = $em->getRepository('AppBundle:User')->find($id);
        $rendezvous = new rendezvous();

        $Form = $this->createForm(rendezvousType::class, $rendezvous);
        $Form->handleRequest($request);
        if ($Form->isSubmitted()) {
            $rendezvous->setUser($User);
            $em->persist($rendezvous);
            $em->flush();
            return $this->redirectToRoute('EspaceAcheteur');
        }
        return $this->render('@User/Default/EspaceRdv.html.twig', array('form' => $Form->createView()));
    }


    public function EspaceReparateurAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();

        $rendezvous = $em->getRepository('AppBundle:rendezvous')->findByUser($user);

        return $this->render('@User/Default/EspaceReparateur.html.twig', array('rendezvous' => $rendezvous));


    }



    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $rendezvous =  $em->getRepository('AppBundle:rendezvous')->findEntitiesByString($requestString);
        if(!$rendezvous) {
            $result['rendezvous']['error'] = "Post Not found :( ";
        } else {
            $result['rendezvous'] = $this->getRealEntities($rendezvous);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($rendezvous){
        foreach ($rendezvous as $rendezvous){
            $realEntities[$rendezvous->getId()] = [$rendezvous>getNom(),$rendezvous->getPrenom()];

        }
        return $realEntities;
    }







}












































