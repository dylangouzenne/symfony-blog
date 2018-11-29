<?php

namespace App\Controller;

//faire appel au model
use App\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//composant pour le formulaire
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

//composant pour utiliser $request
use Symfony\Component\HttpFoundation\Request;




class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        $Article = $this->getDoctrine()
        ->getRepository('App:Article')
        ->findall()
        ;
        
        return $this->render('article/index.html.twig', [
        'Article' => $Article,
        ]);
    }

    /**
     * @Route("/article/new", name="new")
     */
    public function createArticle(Request $request)
    {
    
        // On crée un objet Article
        $article = new Article();

        // On crée le FormBuilder grâce au service form factory
        $form = $this->get('form.factory')->createBuilder(FormType::class, $article)
        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        ->add('nom', TextType::class)
        ->add('contenu', TextareaType::class)
        ->add('created_at', DateTimeType::class)
        ->add('updated_at', DateTimeType::class)
        ->add('envoyer', SubmitType::class)
        ->getForm()
        ;

        // Si la requête est en POST
        if($request->isMethod('POST')) {
        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $article contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
            if ($form->isValid()) {
                // On enregistre notre objet $article dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Article bien enregistrée.');

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
                return $this->redirectToRoute('article', array('id' => $article->getId()));
            }
        }

        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('article/new.html.twig', array(
        'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/article/{{ ?? }})
     */
    public function viewArticle()
    {

    }
}