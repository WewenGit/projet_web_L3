<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Entity\DemandesContact;
use App\Entity\Auteur;
use App\Controller\Admin\UtilisateurCrudController;
use App\Controller\Admin\DemandesContactCrudController;
use App\Controller\Admin\AuteurCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(UtilisateurCrudController::class)->generateUrl());
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet Web');
    }

    public function configureMenuItems(): iterable
    {
        //https://fontawesome.com/v6/search?m=free pour les icônes 
        
        yield MenuItem::linktoRoute('Retourner au site', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Auteurs', 'fa-solid fa-pen-nib', Auteur::class);
        yield MenuItem::linkToCrud('Demandes de contact', 'fa-solid fa-envelope', DemandesContact::class);
        yield MenuItem::section('Livres');
        yield MenuItem::linkToRoute('Catalogue de livres', 'fa-solid fa-book-open', 'app_livre_index');
        yield MenuItem::linkToRoute('Livres en attente de validation', 'fa-solid fa-book', 'app_livre_valider');
    }
}
