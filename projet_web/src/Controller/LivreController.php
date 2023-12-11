<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Critique;
use App\Entity\Utilisateur;
use App\Form\LivreType;
use App\Form\CritiqueType;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/livre')]
class LivreController extends AbstractController
{
    #[Route(['/'], name: 'app_livre_index', methods: ['GET'])]
    #[Route(['/valider'], name: 'app_livre_valider', methods: ['GET'])]
    public function index(LivreRepository $livreRepository, Request $request): Response
    {
        $route = $request->attributes->get('_route');
        if ($route == 'app_livre_valider' || $route == 'admin') {
            return $this->render('livre/valider.html.twig', [
                'livres' => $livreRepository->findAValider(),
            ]);
        } else {
            return $this->render('livre/index.html.twig', [
                'livres' => $livreRepository->findValide(),
            ]);
        }
    }

    #[Route('/new', name: 'app_livre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($livre->getCouverture() == null)
                $livre->setCouverture('default.jpg');
            $livre->setValide(1);

            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    #[Route('/suggestion', name: 'app_livre_suggestion', methods: ['GET', 'POST'])]
    public function suggestion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($livre->getCouverture() == null)
                $livre->setCouverture('default.jpg');
            $livre->setValide(0);

            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_livre_show', methods: ['GET'])]
    #[Route('/{id}/v', name: 'app_livre_showv', methods: ['GET'])]
    #[Route('/{id}/s', name: 'app_livre_show_search', methods: ['GET'])]
    #[Route('/{id}/a', name: 'app_livre_show_add', methods: ['GET'])]
    public function show(Livre $livre, Request $request, EntityManagerInterface $em): Response
    {

        $repoCrit = $em->getRepository(Critique::class);
        
        $critiques = $repoCrit->createQueryBuilder('critique')
        ->select('critique', 'utilisateur.pseudo as pseudoUtilisateur')
        ->leftJoin('critique.idUtilisateur', 'utilisateur')
        ->where('critique.idLivre = :idLivre')
        ->setParameter('idLivre', $livre->getId())
        ->getQuery()
        ->getResult();

        $route = $request->attributes->get('_route');
        $form=$this->createForm(CritiqueType::class);
        $form->handleRequest($request);

        if ($route== 'app_livre_show_add') {
            return $this->render('livre/show.html.twig', [
                'livre' => $livre,
                'route' => $route,
                'critiques'=>$critiques,
                'form'=>$form->createView(),
            ]);
        }

        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
            'route' => $route,
            'critiques'=>$critiques,
        ]);
    }

    #[Route('/{id}/ac', name: 'app_livre_show_add_confirm', methods: ['GET','POST'])]
    public function show_add_confirm(Livre $livre, Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $repoCrit = $em->getRepository(Critique::class);
        
        $critiques = $repoCrit->createQueryBuilder('critique')
        ->select('critique', 'utilisateur.pseudo as pseudoUtilisateur')
        ->leftJoin('critique.idUtilisateur', 'utilisateur')
        ->where('critique.idLivre = :idLivre')
        ->setParameter('idLivre', $livre->getId())
        ->getQuery()
        ->getResult();

        $route = $request->attributes->get('_route');
        $form=$this->createForm(CritiqueType::class);
        $form->handleRequest($request);

        if ($route== 'app_livre_show_add_confirm') {
            if ($form->isSubmitted() && $form->isValid()) {
                
                $contenu = $form->get('contenu')->getData();
                $note = $form->get('note')->getData();
                $critique = new Critique();
                $critique->setCommentaire($contenu);
                $critique->setIdLivre($livre);
                $critique->setIdUtilisateur($user);
                $critique->setNote($note);
                $em->persist($critique);
                $em->flush();
        
            }
        }

        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
            'route' => $route,
            'critiques'=>$critiques,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_livre_edit', methods: ['GET', 'POST'])]
    #[Route('/{id}/editv', name: 'app_livre_editv', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $route = $request->attributes->get('_route');
        $this->denyAccessUnlessGranted('ROLE_AUTEUR');
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            if ($route == 'app_livre_editv')
                return $this->redirectToRoute('app_livre_valider', [], Response::HTTP_SEE_OTHER);
            else
                return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,
            'route' => $route,
        ]);
    }

    #[Route('/{id}', name: 'app_livre_delete', methods: ['POST'])]
    #[Route('/{id}/v', name: 'app_livre_deletev', methods: ['POST'])]
    public function delete(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $route = $request->attributes->get('_route');
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        if ($route == "app_livre_deletev")
            return $this->redirectToRoute('app_livre_valider', [], Response::HTTP_SEE_OTHER);
        else
            return $this->redirectToRoute('app_livre_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/validation', name: 'app_livre_validation', methods: ['GET'])]
    public function valider(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $livre->setValide(1);
        $entityManager->flush();

        return $this->redirectToRoute('app_livre_valider', [], Response::HTTP_SEE_OTHER);
    }
}
