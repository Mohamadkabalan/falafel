<?php
/**
 * Created by PhpStorm.
 * User: mkaba
 * Date: 4/10/2018
 * Time: 12:52 PM
 */

namespace App\Controller;

use App\Entity\Library;
use App\Entity\library_book;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class libraryController  extends Controller
{
    /**
     * @Route("/", name="library_list")
     * @Method({"GET"})
     */
    public function Index(){
        $libraries= $this->getDoctrine()->getRepository(Library::class)->findAll();
        return $this->render('library/index.html.twig', array('libraries' => $libraries));

    }
    /**
     * @Route("/new_library", name="new_library")
     * Method({"GET", "POST"})
     */
    public function new_library(Request $request) {
      $library = new Library();
        $form = $this->createFormBuilder($library)
            ->add('Name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Address', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Image', FileType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
            $form->handleRequest($request);
             if($form->isSubmitted() && $form->isValid()) {
                $library = $form->getData();
                $file=$library->getImage();
                $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/brochures';

                $file->move($brochuresDir,$fileName);
                $library->setImage($fileName);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($library);
                $entityManager->flush();

               return $this->redirectToRoute('library_list');
            }

        return $this->render('library/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/library/edit/{id}", name="edit_library")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $library = new Library();
        $library = $this->getDoctrine()->getRepository(Library::class)->find($id);
        $form = $this->createFormBuilder($library)
            ->add('Name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Address', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Image', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Update',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('library_list');
        }
        return $this->render('library/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
    /**
     * @Route("/library/{id}", name="library_show")
     */
    public function show($id) {
        $library = $this->getDoctrine()->getRepository(Library::class)->find($id);
      
        return $this->render('library/show.html.twig', array('library' => $library));
    }
    /**
     * @Route("/library/delete/{id}", name="library_delete")

     */
    public function delete($id) {
        $library = $this->getDoctrine()->getRepository(Library::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($library);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('library_list');
    }

}