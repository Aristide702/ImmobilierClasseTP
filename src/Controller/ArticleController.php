<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Client;

use App\Repository\ArticleRepository;
use App\Form\ArticleType;


use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//#[Route('/article', name: '')]
class ArticleController extends AbstractController
{
       
     //FindAll()
    #[Route('/articles', name: 'article_index')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles'=> $articleRepository->findAll(),
        ]);
    }

    #[Route('/articles/nouveau', name: 'article_nouveau')]
    public function ajoutArticle(Request $request, EntityManagerInterface $manager)
    {
        $article = new Article();
        //$form = $this->createFormBuilder($article)
        $form = $this->createForm(ArticleType::class, $article);

       
        $form->handleRequest($request); // Le Request

        //var_dump($article);

        if ($form->isSubMitted() && $form->isValid()) { // Soumission du Formulaire
            $manager->persist($article); // Persistancede mon article
            $manager->flush(); // Enregistrement de l'article dans la BD

            return $this->redirectToRoute('article_affichage', ['id' => $article->getId()]); // Redirection vers l'article
        }

        return $this->render('article/nouveau.html.twig', [
            'formCreatArticle' => $form->createView(),
        ]);
    }
    
    /*
        #[Route('/articles/{id}', name: 'article_affichage', methods: ['GET'])]
        public function affichage(Article $article): Response
        {
            return $this->render('article/affichage.html.twig', [
                'controller_name' => 'ArticleController',
                'article'=> $article,
            ]);
        } 
    */

    //Find()
    #[Route('/articles/{id}', name: 'article_affichage', methods: ['GET'])]
    public function affichage($id, ArticleRepository $articlerepo ): Response
    {
        $articles = $articlerepo->find($id);
        return $this->render('article/affichage.html.twig', [
            'article'=> $articles,
        ]);

    }


    //FindOneBy()
    #[Route('/articles/liste1', name: 'article_affichage3', methods: ['GET'])]
    public function affichageArticle(ArticleRepository $artrepo)
    {
        $articles = $artrepo->findOneBy(

        ['titre' => 'Maison à louer']);
        
        return $this->render(
            'article/affichage.html.twig', [
            'article' => $articles,
            ]
        );
    }

    
    //FindBy()
    #[Route('/articles/liste2', name: 'article_affichage4', methods: ['GET'])]
    public function affichageArticle2(ArticleRepository $artrepo)
    {
        $articles = $artrepo->findOneBy(
            ['titre' => 'Maison à louer'],
            ['id'=>'ASC']);

        return $this->render(
            'article/affichage.html.twig', [
            'article' => $articles,
            ]
        );
    }


    #[Route('/articles/modif/{id}', name: 'article_modif')]
    public function modifArticle(Request $request, Article $article, EntityManagerInterface $manager)
    {
        $form = $this->createFormBuilder($article)
            ->add('titre')
            ->add('adresse')
            ->add('images')
            ->add('type')
            ->add('surface')
            ->add('prix')
            ->add('owner')
            ->add('owner')
            ->add('gestionnaire')
            ->add('agence')
            ->add('description')
            ->getForm();

        $form->handleRequest($request); 

        if ($form->isSubMitted() && $form->isValid()) { 
            $manager->persist($article); 
            $manager->flush(); 

            return $this->redirectToRoute('article_affichage', ['id' => $article->getId()]);
        }

        return $this->render('article/edit.html.twig', [
            'formCreatArticle' => $form->createView(),
        ]);
    }
  
    public function contact(Request $request)
    {
        //dd('$contact');
        $contact = $request ->attributes->get('contact'); 
        return new Response(" Vous êtes le Cont N° $contact");
        //die(); 
    }

    //#[Route('/location', name: 'location')]
    public function location(): Response
    {
        return $this->render('article/page.html.twig', [
            'controller_name' => 'ArticleController',
            'title'=>'Location de Biens'
        ]);
    }

    #[Route('/terrain', name: 'locationterrain')]
    public function location_terrain(): Response
    {
        return $this->render('article/page.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/location-maison', name: 'locationmaison')]
    public function location_maison(): Response
    {
        return $this->render('article/page.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/location-mappart', name: 'locationapprt')]
    public function location_appart(): Response
    {
        return $this->render('article/page.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    //#[Route('/vente', name: 'vente')]
    public function vente(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/vente-terrainte', name: 'vente_terrain')]
    public function vente_terrain(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/vente-maison', name: 'vente_maison')]
    public function vente_maison(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    #[Route('/vente-appart', name: 'vente_appart')]
    public function vente_appart(): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
}
