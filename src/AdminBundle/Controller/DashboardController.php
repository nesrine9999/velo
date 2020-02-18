<?php

namespace AdminBundle\Controller;
use AppBundle\Entity\Actualite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
class DashboardController extends Controller
{
    public function indexAction()
    {




        return $this->render('@Admin/accueil.html.twig');
    }
    public function AfficherUserAction()
    {




        return $this->render('@Admin/Default/user.html.twig');
    }

    public function  AjouterAction(Request $request )
    {
        $actualite = new Actualite();
        $form = $this->createFormBuilder($actualite)

            ->add('titre',TextType::class)
            ->add('image',FileType::class,array('data_class' => null,'required' => true))
            ->add('description',TextAreaType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $Image = $actualite->getImage();
            if($Image){
                $fileName = md5(uniqid()).'.'.$Image->guessExtension();

                try {
                    $Image->move(
                        $this->getParameter('Actualite_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                }
                $actualite->setImage($fileName);
            }

            $actualite->setDatePublication(new \DateTime());



            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($actualite);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success','Actualité ajoutée avec succés');
            return $this->redirect($this->generateUrl('Affiche'));

        }
        return $this->render('@Admin/Default/Ajouter.html.twig',array('form' => $form->createView()));
    }

    public function ReparateursAction()
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


        return $this->render('@Admin/Default/Reparateurs.html.twig', array('Reparateurs' => $reparateurs));


    }






    public function modifieractualiteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $actualite = $em->getRepository('AppBundle:Actualite')->find($id);
        $image = $actualite->getImage();

        $form = $this->createFormBuilder($actualite)

            ->add('titre',TextType::class , array('attr' => ['pattern' => '[a-zA-Z]+\s[a-zA-Z]*']))
            ->add('image',FileType::class,array('data_class' => null,'required' => false))
            ->add('description',TextAreaType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $Image = $actualite->getImage();
            if($Image){
                $fileName = md5(uniqid()).'.'.$Image->guessExtension();

                try {
                    $Image->move(
                        $this->getParameter('Actualite_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                }
                $actualite->setImage($fileName);
            }
            else{
                $actualite->setImage($image);
            }

            $actualite->setDatePublication(new \DateTime());



            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($actualite);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success',' Actualité  modifiée avec succés');
            return $this->redirect($this->generateUrl('Affiche'));
        }


        return $this->render('@Admin/Default/Modifier.html.twig',array('form' => $form->createView()));
    }




    public function AfficheAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $actualites = $em->getRepository('AppBundle:Actualite')->findAll();


        return $this->render('@Admin/Default/Affiche.html.twig',array('actualites'=>$actualites));
    }




    public function SupprimerAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getEntityManager();
        $actualite = $em->getRepository('AppBundle:Actualite')->find($id);
        if (!$actualite) {
            throw $this->createNotFoundException('No actualite found for id '.$id);
        }
        $em->remove($actualite);
        $em->flush();
        $request->getSession()->getFlashBag()->add('success', ' Actualité supprimée avec succés');
        return $this->redirect($this->generateUrl('Affiche'));
    }










}