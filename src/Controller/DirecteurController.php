<?php

namespace App\Controller;

use App\Entity\Directeur;
use App\Repository\DirecteurRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DirecteurController extends AbstractController
{
    #[Route('/directeur', name: 'app_directeur')]
    public function index(directeurRepository $directeurRepository): Response
    {
        return $this->render('directeur/index.html.twig', [
            'directeurs' => $directeurRepository->findAll(),
        ]);
    }

    #[Route('/directeur/{id}', name: 'directeur_affichage')]
    public function affichage(Directeur $directeur): Response
    {
        return $this->render('directeur/affichage.html.twig', [
            'directeur' => $directeur,
        ]);
    }
}
