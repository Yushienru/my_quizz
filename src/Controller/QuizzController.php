<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    /**
     * @Route("/", name="show_categorie")
     */
    public function index()
    {
        $repo = $this->getDoctrine()
        ->getRepository(Categorie::class);
        $name = $repo->findAll();
        return $this->render('quizz/index.html.twig', [
            'categories' => $name,
        ]);
    
    }

    /**
     * @Route("/quizz/create", name="quizz_create")
     */
    public function createQuizz(Request $request, ObjectManager $manager) {
        $quizz = new Question();

        $form = $this->createFormBuilder($quizz)
                    ->add('name')
                    ->add('question')
                    ->add('reponse')
                    ->getForm();

        return $this->render('quizz/create.html.twig', [
            'formQuizz' => $form->createView()
        ]);
    }

    /**
     * @Route("/quizz/categorie/{id}", name="categorie_show")
     */
    public function showCategorie($id){
        $repo = $this->getDoctrine()
        ->getRepository(Categorie::class);
        $categorie = $repo->find($id);
        return $this->render('quizz/index.html.twig', [
            'name' => $categorie,
        ]);
    }

    /**
     * @Route("/quizz{id}", name="quizz_show")
     */
    public function showQuizz($id){
        $repo = $this->getDoctrine()
        ->getRepository(Categorie::class);

        $category = $repo->find($id);

        $question = $category->getQuestion();

        return $this->render('quizz/quizz.html.twig', [
            'category' => $category,
            'question' => $question,

        ]);
    }
}