<?php

namespace App\Controller;

use App\Form\CreerListeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ListeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Liste;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $listeRepository = $entityManager->getRepository(Liste::class);
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'utilisateur' => $user,
            'listes' => $listeRepository->findByUser($user),
        ]);
    }
}
