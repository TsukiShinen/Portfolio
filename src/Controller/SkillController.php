<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Skill;
use App\Form\SkillType;
use App\Repository\ImageRepository;
use App\Repository\SkillRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/skill')]
class SkillController extends AbstractController
{
    #[Route('/', name: 'app_skill_index', methods: ['GET'])]
    public function index(SkillRepository $skillRepository): Response
    {
        return $this->render('skill/index.html.twig', [
            'skills' => $skillRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_skill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FileUploader $fileUploader, SkillRepository $skillRepository, ImageRepository $imageRepository): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('icon')->getData();
            if ($image) {
                $imageName = $fileUploader->uploadImage($image);

                $newImage = new Image();
                $newImage->setFileName($imageName);

                $skill->setIcon($newImage);

                $imageRepository->add($newImage);
            }
            $skillRepository->add($skill, true);

            return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('skill/new.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_skill_show', methods: ['GET'])]
    public function show(Skill $skill): Response
    {
        return $this->render('skill/show.html.twig', [
            'skill' => $skill,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FileUploader $fileUploader, Skill $skill, SkillRepository $skillRepository, ImageRepository $imageRepository): Response
    {
        $form = $this->createForm(SkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('icon')->getData();
            if ($image) {
                $imageName = $fileUploader->uploadImage($image);

                $newImage = new Image();
                $newImage->setFileName($imageName);

                $skill->setIcon($newImage);

                $imageRepository->add($newImage);
            }
            $skillRepository->add($skill, true);

            return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('skill/edit.html.twig', [
            'skill' => $skill,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_skill_delete', methods: ['POST'])]
    public function delete(Request $request, Skill $skill, SkillRepository $skillRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $skillRepository->remove($skill, true);
        }

        return $this->redirectToRoute('app_skill_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/remove/icon/{id}', name: 'app_skill_icon_delete', methods: ["DELETE"])]
    public function deleteImage(Image $image, Request $request, SkillRepository $skillRepository, ImageRepository $imageRepository): JsonResponse
    {
        $token = $request->get("token");
        $skillId = $request->get("entityId");
        dump($skillId);

        if($this->isCsrfTokenValid('delete'.$image->getId(), $token))
        {
            $skillRepository->find($skillId)->setIcon(null);
            $nom = $image->getFileName();
            unlink($this->getParameter('images_directory').'/'.$nom);
            $imageRepository->remove($image, true);
            return new JsonResponse(['success' => 1]);
        }
        else {
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}
