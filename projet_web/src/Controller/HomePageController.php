<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            ->andWhere('livre.idGenre = :resp')
            ->setParameter('resp', $genre)
            ->andWhere('livre.valide = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getSingleScalarResult();
        }

        $randomBooks = [];
        if ($genre) {
            $randomBooks = $repoBook->createQueryBuilder('b')
                ->andWhere('b.idGenre = :resp')
                ->setParameter('resp', $genre)
                ->andWhere('b.valide = :val')
                ->setParameter('val', 1)
                ->setMaxResults(4)
                ->getQuery()
                ->getResult();
        }

        $listBooks = $repoBook->createQueryBuilder('l')
        ->select('l', 'COUNT(listes.id) as listCount')
        ->leftJoin('l.idListe', 'listes')
        ->andWhere('l.valide = :val')
        ->setParameter('val', 1)
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