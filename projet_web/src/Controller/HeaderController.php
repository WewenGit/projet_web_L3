<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\SearchForm;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Livre;
use App\Entity\Auteur;
use App\Entity\Utilisateur;
use App\Entity\Genre;

class HeaderController extends AbstractController
{
    public function recherche() {
        $form = $this->createFormBuilder()
        ->setAction($this->generateUrl('handleSearch'))
        ->add('search_input', TextType::class, [
            'label' => 'Recherche : ',
        ])
        ->getForm();
        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/handleSearch', name: 'handleSearch')]
    public function handleSearch(Request $request, EntityManagerInterface $em)
    {
        $query = $request->request->all('form')['search_input'];
        
        $repoBook = $em->getRepository(Livre::class);
        $repoUser = $em->getRepository(Utilisateur::class);
        $repoGenre = $em->getRepository(Genre::class);

        if ($query) {
            $repoAuthor = $em->getRepository(Auteur::class);

            $books = $repoBook->createQueryBuilder('b')
            ->where('b.titre LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

            $authors = $repoAuthor->createQueryBuilder('a')
            ->where('a.nom LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

            $users = $repoUser->createQueryBuilder('u')
            ->where('u.pseudo LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

            return $this->render('search/index.html.twig', [
                'books'=>$books,
                'authors'=>$authors,
                'users'=>$users,
            ]);
        }
    }
}