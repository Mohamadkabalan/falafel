<?php
namespace App\Controller;
use App\Entity\Book;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class bookController extends Controller{


    /**
     * @Route("/book", name="book_list")
     * @Method({"GET"})
     */
    public function Books(){
        $books= $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->render('book/index.html.twig', array('books' => $books));
    }
    /**
     * @Route("/new_book", name="new_book")
     * Method({"GET", "POST"})
     */
    public function newbook(Request $request) {
        $book = new Book();
        $form = $this->createFormBuilder($book)
            ->add('Name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Price', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Image', FileType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();
             $form->handleRequest($request);
           if($form->isSubmitted() && $form->isValid()) {
               $book = $form->getData();
               $file=$book->getImage();
               $fileName=md5(uniqid()).'.'.$file->guessExtension();
               $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/brochures';

               $file->move($brochuresDir,$fileName);
               $book->setImage($fileName);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($book);
                $entityManager->flush();
                return $this->redirectToRoute('book_list');
            }
        return $this->render('book/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
    /**
     * @Route("/book/edit/{id}", name="edit_book")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
        $book = new Book();
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $form = $this->createFormBuilder($book)
            ->add('Name', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Price', TextType::class, array('attr' => array('class' => 'form-control')))
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
            return $this->redirectToRoute('book_list');
        }
        return $this->render('book/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/book/{id}", name="book_show")
     */
    public function show($id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        return $this->render('book/show.html.twig', array('book' => $book));
    }

    /**
     * @Route("/book/delete/{id}", name="book_delete")

     */
    public function delete($id) {
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($book);
        $entityManager->flush();
        $response = new Response();
        $response->send();
        return $this->redirectToRoute('book_list');
    }

}

?>