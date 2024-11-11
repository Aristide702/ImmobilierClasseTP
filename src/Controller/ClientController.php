<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'app_client')]
    public function index(clientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/client/{id}', name: 'client_affichage')]
    public function affichage(Client $client): Response
    {
        return $this->render('client/affichage.html.twig', [
            'controller_name' => 'ClientController',
            'client' => $client,
        ]);
    }
}