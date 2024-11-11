<?php

namespace App\Controller;

use App\Entity\Siege;
use App\Repository\SiegeRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SiegeController extends AbstractController
{
    #[Route('/siege', name: 'app_siege')]
    public function index(SiegeRepository $SiegeRepository): Response
    {
        return $this->render('Siege/index.html.twig', [
            'Sieges' => $SiegeRepository->findAll(),
        ]);
    }

    #[Route('/Siege/{id}', name: 'Siege_affichage')]
    public function affichage(Siege $Siege): Response
    {
        return $this->render('Siege/affichage.html.twig', [
            'Siege' => $Siege,
        ]);
    }
    
}
