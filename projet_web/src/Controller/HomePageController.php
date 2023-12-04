<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function notifications(): Response
    {

        // the template path is the relative file path from `templates/`
        return $this->render('base.html.twig', []);
    }

    #[Route('/search', name: 'app_search', methods:['GET'])]
    public function search(Request $req): Response
    {
        $mink=$req->query->get('minkm');
        $maxk=$req->query->get('maxkm');
        $priceOrder=$req->query->get('triprix');
        $brand=$req->query->get('brandSelect');
        
        $vehic = $vehiculeRepository->filterCars($mink, $maxk, $priceOrder,$brand);

        return $this->render('vehicule/index.html.twig', [
            'vehicules' => $vehic,
            'kMax' => $maxk,
            'kMin' => $mink,
            'priceOrder' => $priceOrder,
        ]);
    }

    #[Route('/profil_detail', name: 'app_profil_detail')]
    public function profil_detail(): Response
    {

        // the template path is the relative file path from `templates/`
        return $this->render('base.html.twig', []);
    }

    #[Route('/liste_livres', name: 'app_liste_livres')]
    public function liste_livres(): Response
    {

        // the template path is the relative file path from `templates/`
        return $this->render('base.html.twig', []);
    }
}