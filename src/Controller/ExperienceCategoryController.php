<?php

namespace App\Controller;

use App\Entity\ExperienceCategory;
use App\Form\ExperienceCategoryType;
use App\Repository\ExperienceCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/experience/category')]
class ExperienceCategoryController extends AbstractController
{
    #[Route('/', name: 'app_experience_category_index', methods: ['GET'])]
    public function index(ExperienceCategoryRepository $experienceCategoryRepository): Response
    {
        return $this->render('experience_category/index.html.twig', [
            'experience_categories' => $experienceCategoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_experience_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExperienceCategoryRepository $experienceCategoryRepository): Response
    {
        $experienceCategory = new ExperienceCategory();
        $form = $this->createForm(ExperienceCategoryType::class, $experienceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experienceCategoryRepository->add($experienceCategory, true);

            return $this->redirectToRoute('app_experience_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experience_category/new.html.twig', [
            'experience_category' => $experienceCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_experience_category_show', methods: ['GET'])]
    public function show(ExperienceCategory $experienceCategory): Response
    {
        return $this->render('experience_category/show.html.twig', [
            'experience_category' => $experienceCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_experience_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ExperienceCategory $experienceCategory, ExperienceCategoryRepository $experienceCategoryRepository): Response
    {
        $form = $this->createForm(ExperienceCategoryType::class, $experienceCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experienceCategoryRepository->add($experienceCategory, true);

            return $this->redirectToRoute('app_experience_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experience_category/edit.html.twig', [
            'experience_category' => $experienceCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_experience_category_delete', methods: ['POST'])]
    public function delete(Request $request, ExperienceCategory $experienceCategory, ExperienceCategoryRepository $experienceCategoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experienceCategory->getId(), $request->request->get('_token'))) {
            $experienceCategoryRepository->remove($experienceCategory, true);
        }

        return $this->redirectToRoute('app_experience_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
