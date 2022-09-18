<?php

namespace App\Controller\Admin;

use App\Entity\Exp;
use App\Entity\ExperienceCategory;
use App\Entity\Project;
use App\Entity\ProjectCategory;
use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator) {

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Project');
        yield MenuItem::subMenu('Project', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create a Project', 'fas fa-plus', Project::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show a Project', 'fas fa-eye', Project::class)
        ]);

        yield MenuItem::section('Project Category');
        yield MenuItem::subMenu('Project Category', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create a Project Category', 'fas fa-plus', ProjectCategory::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show a Project Category', 'fas fa-eye', ProjectCategory::class)
        ]);

        yield MenuItem::section('Experience');
        yield MenuItem::subMenu('Experience', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create an Experience', 'fas fa-plus', Exp::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show an Experience', 'fas fa-eye', Exp::class)
        ]);

        yield MenuItem::section('Experience category');
        yield MenuItem::subMenu('Experience category', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create an Experience category', 'fas fa-plus', ExperienceCategory::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show an Experience category', 'fas fa-eye', ExperienceCategory::class)
        ]);

        yield MenuItem::section('Skill');
        yield MenuItem::subMenu('Skill', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Create a Skill', 'fas fa-plus', Skill::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show a Skill', 'fas fa-eye', Skill::class)
        ]);
    }
}
