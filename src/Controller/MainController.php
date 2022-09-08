<?php

namespace App\Controller;

use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }
    #[Route('/character', name: 'ajax_main_character', methods: "POST")]
    public function character(): JsonResponse {
        $response = [
            "code" => 200,
            "html" => $this->render('pages/character.html.twig')->getContent()
        ];

        return new JsonResponse($response);
    }

    #[Route('/inventory', name: 'ajax_main_inventory', methods: "POST")]
    public function inventory(): JsonResponse {

        $response = [
            "code" => 200,
            "html" => $this->render('pages/inventory.html.twig')->getContent()
        ];

        return new JsonResponse($response);
    }

    #[Route('/skills', name: 'ajax_main_skills', methods: "POST")]
    public function skills(SkillRepository $skillRepository): JsonResponse {

        $response = [
            "code" => 200,
            "html" => $this->render('pages/skills.html.twig', [
                "skills" => $skillRepository->getSkillTable(),
                "baseSkills" => $skillRepository->getBaseSkill(),
                "passiveSkills" => $skillRepository->getPassiveSkill()
            ])->getContent()
        ];

        return new JsonResponse($response);
    }

    #[Route('/quest', name: 'ajax_main_quest', methods: "POST")]
    public function quest(): JsonResponse {

        $response = [
            "code" => 200,
            "html" => $this->render('pages/quest.html.twig')->getContent()
        ];

        return new JsonResponse($response);
    }

    #[Route('/contact', name: 'ajax_main_contact', methods: "POST")]
    public function contact(): JsonResponse {

        $response = [
            "code" => 200,
            "html" => $this->render('pages/contact.html.twig')->getContent()
        ];

        return new JsonResponse($response);
    }
}
