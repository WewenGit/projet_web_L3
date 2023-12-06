<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\SearchForm;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;

class HomePageController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function firstView(Request $req, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(SearchForm::class);
        $form->handleRequest($req);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $resp = ($form->getData())['search_input'];

            $repoBook = $em->getRepository(Livre::class);
            $repoAuthor = $em->getRepository(Auteur::class);
            $repoUser = $em->getRepository(Utilisateur::class);

            $books = $repoBook->findBy([
                'titre' => $resp, 
            ]);
            $authors = $repoAuthor->findBy([
                'nom' => $resp,

            ]);
            $users = $repoUser->findBy([
                'pseudo' => $resp, 
            ]);

            return $this->render('search/index.html.twig', [
                'searchInput'=>print_r($resp,true),
                'books'=>print_r($books,true),
                'authors'=>print_r($authors,true),
                'users'=>print_r($users,true),
            ]);
        }

        return $this->render('base.html.twig', ['form' => $form->createView(),]);
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