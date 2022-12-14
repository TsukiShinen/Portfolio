<?php

namespace App\Controller;

use App\Repository\ExpRepository;
use App\Repository\ProjectRepository;
use App\Repository\SkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    public function inventory(Request $request, ProjectRepository $projectRepository): JsonResponse {
        $search = $request->get("search");

        $projects = null;
        if ($search == "") {
            $projects = $projectRepository->findBy([], ['date' => 'DESC']);
        } else {
            $projects = $projectRepository->getSearchedProject($search);
        }

        $response = [
            "code" => 200,
            "html" => $this->render('pages/inventory.html.twig', [
                "projects" => $projects,
                "search" => $search
            ])->getContent()
        ];

        return new JsonResponse($response);
    }

    #[Route('/project', name: 'ajax_main_project', methods: "POST")]
    public function project(Request $request, ProjectRepository $projectRepository): JsonResponse {
        $id = $request->get("id");

        $response = [
            "code" => 200,
            "html" => $this->render('pages/project.html.twig', [
                'project' => $projectRepository->find($id)
            ])->getContent()
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
    public function quest(ExpRepository $expRepository): JsonResponse {

        $response = [
            "code" => 200,
            "html" => $this->render('pages/quest.html.twig', [
                "currentQuests" => $expRepository->findBy(["isFinished" => false], ["start" => "DESC"]),
                "finishedQuests" => $expRepository->findBy(["isFinished" => true], ["end" => "DESC"]),
            ])->getContent()
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

    #[Route('/quest-content', name: 'ajax_main_quest_content', methods: "POST")]
    public function questContent(Request $request, ExpRepository $expRepository): JsonResponse {
        $id = $request->get("id");
        $exp = $expRepository->find($id);

        $response = [
            "code" => 200,
            "name" => $exp->getName(),
            "content" => $exp->getContent(),
            "html" => $this->render('pages/contact.html.twig')->getContent()
        ];

        return new JsonResponse($response);
    }

    #[Route('/inventory-search', name: 'ajax_main_inventory_search', methods: "POST")]
    public function inventorySearch(Request $request, ProjectRepository $projectRepository): JsonResponse {
        $search = $request->get("search");

        $projects = null;
        if ($search == "") {
            $projects = $projectRepository->findAll();
        } else {
            $projects = $projectRepository->getSearchedProject($search);
        }

        $response = [
            "code" => 200,
            "html" => $this->render('pages/elements/Project.html.twig', [
                'projects' => $projects
            ])->getContent()
        ];

        return new JsonResponse($response);
    }
}
