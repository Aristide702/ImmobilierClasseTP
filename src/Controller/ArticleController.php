<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/articles', name: '')]
class ArticleController extends AbstractController
{

    #[Route('/', name: 'article_index')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articleRepository->findAll(),
        ]);
    }

    #[Route('/nouveau', name: 'article_nouveau')]
    public function ajoutArticle(Request $request, EntityManagerInterface $manager)
    {
        $article = new Article();
        //$form = $this->createFormBuilder($article)
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request); // Le Request

        if ($form->isSubMitted() && $form->isValid()) { // Soumission du Formulaire
            $manager->persist($article); // Persistance de mon article
            $manager->flush(); // Enregistrement de l'article dans la BD

            return $this->redirectToRoute('article_affichage', ['id' => $article->getId()]); // Redirection vers l'article
        }

        return $this->render('article/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'article_affichage', methods: ['GET'])]
    public function affichage($id, ArticleRepository $articlerepo): Response
    {
        $articles = $articlerepo->find($id); //find($id)
        return $this->render('article/affichage.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
        ]);
    }

    #[Route('/articles/liste', name: 'article_affichage_liste', methods: ['GET'])]
    public function affichageListe(ArticleRepository $artrepo)
    {
        $articles = $artrepo->findOneBy(array('titre' => 'John Doe')); //findOneBy()
        return $this->render(
            'article/affichage.html.twig', [
                'articles' => $articles,
            ]
        );
    }

    #[Route('/articles/liste2', name: 'article_affichage_liste', methods: ['GET'])]
    public function affichageListe2(ArticleRepository $artrepo)
    {
        $articles = $artrepo->findBy(
            ['titre' => 'John Doe', 'id' => 'ASC']); //findBy()

        return $this->render(
            'article/affichage.html.twig', [
                'articles' => $articles,
            ]
        );

    }

    #[Route('/articles/listetitre', name: 'article_affichage_liste', methods: ['GET'])]
    public function findByTitre(ArticleRepository $artrepo)
    {
        $articles = $artrepo->findByTitre(array('maison à louer'));
        return $this->render(
            'article/affichage.html.twig', [
                'articles' => $articles,
            ]
        );
    }

    #[Route('/articles/liste1titre', name: 'article_affichage_liste', methods: ['GET'])]
    public function findOneByTitre(ArticleRepository $artrepo)
    {
        $articles = $artrepo->findByTitre(array('maison à louer'));
        return $this->render(
            'article/affichage.html.twig', [
                'articles' => $articles,
            ]
        );
    }

    #[Route('/modif/{id}', name: 'article_modif')]
    public function modifArticle(Request $request, Article $article, EntityManagerInterface $manager)
    {
        //$form = $this->createFormBuilder($article)
        $form = $this->createForm(ArticleType::class, $article);
        /* ->add('titre')
        ->add('adresse')
        ->add('images')
        ->add('type')
        ->add('surface')
        ->add('prix')
        ->add('owner')
        ->add('owner')
        ->add('employe')
        ->add('agence')
        ->add('description')
        ->getForm();*/

        $form->handleRequest($request);

        if ($form->isSubMitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('article_affichage', ['id' => $article->getId()]);
        }

        return $this->render('article/edit.html.twig', [
            'formCreatArticle' => $form->createView(),
            'article' => $article,
        ]);
    }

    public function contact(Request $request)
    {
        //dd('$contact');
        $contact = $request->attributes->get('contact');
        return new Response(" Vous êtes le Cont N° $contact");
        //die();
    }

//trier les articles par titre
    #[Route('/trie/titre', name: 'article.trier.titre')]
    public function indexArticlesTrierTitre(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findTrieArtcles_AZ();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

//trier les articles par type
    #[Route('/trie/type', name: 'article.trier.type')]
    public function indexArticlesTrierTypee(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findTrietype_AZ();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

//trier les articles par Adresse
    #[Route('/trie/address', name: 'article.trier.adresse')]
    public function indexArticlesTrierAdresse(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findTrieAdresse_AZ();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

//trier les articles par Surface
    #[Route('/trie/surface', name: 'article.trier.surface')]
    public function indexArticlesTrierSurface(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findTrieSurface_AZ();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    // trier par prix croissant
    #[Route('/trie/prix', name: 'article.trier.prix')]
    public function indexArticlesTrierPrix(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findAscPrice();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //trier les articles par categories / Location Appartement
    #[Route('/trie/categorie-apt-loc', name: 'article.trier.location.appart')]
    public function indexArticlesCategorieLocAppt(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findCategorieLocAppart();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //trier les articles par categories Location Maiosn
    #[Route('/trie/categorie-maiosn-loc', name: 'article.trier.location.maison')]
    public function indexArticlesCategorieLocMaisont(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findCategorieLocMaison();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //trier les articles par categories Vente Maison
    #[Route('/trie/categorie-vente-maiosn', name: 'article.trier.vente.maison')]
    public function indexArticlesCategorieVenteMaison(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findCategorieVenteMaison();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //trier les articles par categories Vente Appartement
    #[Route('/trie/categorie-vente-appart', name: 'article.trier.vente.appart')]
    public function indexArticlesCategorieVenteAppart(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findCategorieVenteAppartn();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    #[Route('trie/date', name: 'article.trier.date')]
    public function indexArticlesTrierDate(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findAscCreatedAt();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //trier les articles par ordre croissant par catgorie
    #[Route('/trie/categorie', name: 'article.categorie.nom.ASC')]
    public function indexCategorie(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findAllWithCategorie();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //trier les articles par ordre croissant par Agence
    #[Route('/trie/agence', name: 'article.categorie.agence.ASC')]
    public function indexAgence(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findAllWithAgencyASC();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //Lister les Articles par ordre ASC de gestionnaires
    #[Route('/trie/gestionnaire', name: 'article.categorie.gestionnaire.ASC')]
    public function indexEmploye(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findAllWithGestionnaireASC();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
            ]
        );
    }

    //trier les articles par auteurs
    #[Route('/trie/client', name: 'article.trier.client.ASC')]
    public function indexArticlesTrierAuteur(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->findAllWithGestionnaireASC();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
                // passage du contenu de $location
                'articles' => $articles,
    ]);
    }

    #[Route('/vendre/terrain', name: 'article.vendre.terrain')]
    public function terrainVendre(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->terrainVendre();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
            ]);
    }

    #[Route('/louer/terrain', name: 'article.louer.terrain')]
    public function terrainLouer(ArticleRepository $articleRepository, Request $request)
    {
        $articles = $articleRepository->terrainLouer();
        // Appel de la page pour affichage
        return $this->render(
            'article/index.html.twig', [
            ]);
    }

}