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
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;

class HomePageController extends AbstractController
{

    #[Route('/', name: 'homepage')]
    #[Route('/home', name: 'home')]
    public function firstView(Request $req, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(SearchForm::class);
        $form->handleRequest($req);
        
        $repoBook = $em->getRepository(Livre::class);
        $repoUser = $em->getRepository(Utilisateur::class);
        $repoGenre = $em->getRepository(Genre::class);

        $nbLivresGenre=0;
        //Evite d'afficher une catégorie qui contient 0 livres
        while ($nbLivresGenre == 0) { 
            $nombreAleatoire = rand(1, 4);
            $genre=$repoGenre->createQueryBuilder('g')
            ->where('g.id = :resp')
            ->setParameter('resp', $nombreAleatoire)
            ->getQuery()
            ->getOneOrNullResult();
            
            $nbLivresGenre = $repoBook->createQueryBuilder('livre')
            ->select('count(livre.id)')
            ->where('livre.idGenre = :resp')
            ->setParameter('resp', $genre)
            ->getQuery()
            ->getSingleScalarResult();
        }

        $randomBooks = [];
        if ($genre) {
            $randomBooks = $repoBook->createQueryBuilder('b')
                ->where('b.idGenre = :resp')
                ->setParameter('resp', $genre)
                ->setMaxResults(4)
                ->getQuery()
                ->getResult();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $resp = ($form->getData())['search_input'];

            $repoAuthor = $em->getRepository(Auteur::class);

            $books = $repoBook->createQueryBuilder('b')
            ->where('b.titre LIKE :resp')
            ->setParameter('resp', '%' . $resp . '%')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

            $authors = $repoAuthor->createQueryBuilder('a')
            ->where('a.nom LIKE :resp')
            ->setParameter('resp', '%' . $resp . '%')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

            $users = $repoUser->createQueryBuilder('u')
            ->where('u.pseudo LIKE :resp')
            ->setParameter('resp', '%' . $resp . '%')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

            return $this->render('search/index.html.twig', [
                'books'=>$books,
                'authors'=>$authors,
                'users'=>$users,
                'form'=>$form->createView()
            ]);
        }


        $listBooks = $repoBook->createQueryBuilder('l')
        ->select('l', 'COUNT(listes.id) as listCount')
        ->leftJoin('l.idListe', 'listes')
        ->addGroupBy('l.id')
        ->orderBy('listCount', 'DESC')
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();

        $activeProfiles = $repoUser->createQueryBuilder('u')
        ->select('u', 'COUNT(critique.id) as critCount')
        ->leftJoin('App\Entity\Critique', 'critique', 'WITH', 'u.id = critique.idUtilisateur')
        ->addGroupBy('u.id')
        ->orderBy('critCount', 'DESC')
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();

        return $this->render('base.html.twig', [
            'form' => $form->createView(),
            'genreBooks' => $randomBooks,
            'genre' => $genre,
            'listBooks'=>$listBooks,
            'activeProfiles'=>$activeProfiles,
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