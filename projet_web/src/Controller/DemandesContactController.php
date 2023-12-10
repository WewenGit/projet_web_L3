<?php

namespace App\Controller;

use App\Entity\DemandesContact;
use App\Form\DemandesContactType;
use App\Repository\DemandesContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demandes/contact')]
class DemandesContactController extends AbstractController
{
    #[Route('/new', name: 'app_demandes_contact_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandesContact = new DemandesContact();
        $form = $this->createForm(DemandesContactType::class, $demandesContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandesContact);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demandes_contact/new.html.twig', [
            'demandes_contact' => $demandesContact,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demandes_contact_show', methods: ['GET'])]
    public function show(DemandesContact $demandesContact): Response
    {
        return $this->render('demandes_contact/show.html.twig', [
            'demandes_contact' => $demandesContact,
        ]);
    }

    #[Route('/{id}', name: 'app_demandes_contact_delete', methods: ['POST'])]
    public function delete(Request $request, DemandesContact $demandesContact, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandesContact->getId(), $request->request->get('_token'))) {
            $entityManager->remove($demandesContact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demandes_contact_index', [], Response::HTTP_SEE_OTHER);
    }
}
