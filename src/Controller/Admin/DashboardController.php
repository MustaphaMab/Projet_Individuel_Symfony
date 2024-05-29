<?php

namespace App\Controller\Admin;
// importation des classes et entités
use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Livraison;
use App\Entity\PaiementCommande;
use App\Entity\Produit;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

// le controller principal DashboardController etend/hérite AbstractDashboardController
class DashboardController extends AbstractDashboardController
{
    //elle redirige l'utilisateur vers le contrôleur CRUD pour les produits dès qu'ils visitent '/admin
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        

       
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProduitCrudController::class)->generateUrl());

       
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard Admin');
    }

    public function configureMenuItems(): iterable
    {
        // definit les liens vers les pages CRUD pour la gestion des entités
        yield MenuItem::linkToCrud('Produits', 'fas fa-box-open', Produit::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-shopping-cart', Commande::class);
        yield MenuItem::linkToCrud('Lignes de Commande', 'fas fa-stream', LigneCommande::class);
        yield MenuItem::linkToCrud('Livraisons', 'fas fa-truck', Livraison::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-tags', Categorie::class);
        yield MenuItem::linkToCrud('Paiements', 'fas fa-credit-card', PaiementCommande::class);
    
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
