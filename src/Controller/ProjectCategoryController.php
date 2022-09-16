<?php

namespace App\Controller;

use App\Entity\ProjectCategory;
use App\Form\ProjectCategoryType;
use App\Repository\ProjectCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/project/category')]
class ProjectCategoryController extends AbstractController
{
    #[Route('/', name: 'app_project_category_index', methods: ['GET'])]
    public function index(ProjectCategoryRepository $projectCategoryRepository): Response
    {
        return $this->render('project_category/index.html.twig', [
            'project_categories' => $projectCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_project_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProjectCategoryRepository $projectCategoryRepository): Response
    {
        $projectCategory = new ProjectCategory();
        $form = $this->createForm(ProjectCategoryType::class, $projectCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectCategoryRepository->add($projectCategory, true);

            return $this->redirectToRoute('app_project_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project_category/new.html.twig', [
            'project_category' => $projectCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_category_show', methods: ['GET'])]
    public function show(ProjectCategory $projectCategory): Response
    {
        return $this->render('project_category/show.html.twig', [
            'project_category' => $projectCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_project_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProjectCategory $projectCategory, ProjectCategoryRepository $projectCategoryRepository): Response
    {
        $form = $this->createForm(ProjectCategoryType::class, $projectCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectCategoryRepository->add($projectCategory, true);

            return $this->redirectToRoute('app_project_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('project_category/edit.html.twig', [
            'project_category' => $projectCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_category_delete', methods: ['POST'])]
    public function delete(Request $request, ProjectCategory $projectCategory, ProjectCategoryRepository $projectCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projectCategory->getId(), $request->request->get('_token'))) {
            $projectCategoryRepository->remove($projectCategory, true);
        }

        return $this->redirectToRoute('app_project_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
