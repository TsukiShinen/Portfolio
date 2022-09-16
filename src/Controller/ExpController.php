<?php

namespace App\Controller;

use App\Entity\Exp;
use App\Form\ExpType;
use App\Repository\ExpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/experience')]
class ExpController extends AbstractController
{
    #[Route('/', name: 'app_exp_index', methods: ['GET'])]
    public function index(ExpRepository $expRepository): Response
    {
        return $this->render('exp/index.html.twig', [
            'exps' => $expRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_exp_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExpRepository $expRepository): Response
    {
        $exp = new Exp();
        $form = $this->createForm(ExpType::class, $exp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expRepository->add($exp, true);

            return $this->redirectToRoute('app_exp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exp/new.html.twig', [
            'exp' => $exp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exp_show', methods: ['GET'])]
    public function show(Exp $exp): Response
    {
        return $this->render('exp/show.html.twig', [
            'exp' => $exp,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_exp_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exp $exp, ExpRepository $expRepository): Response
    {
        $form = $this->createForm(ExpType::class, $exp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $expRepository->add($exp, true);

            return $this->redirectToRoute('app_exp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exp/edit.html.twig', [
            'exp' => $exp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exp_delete', methods: ['POST'])]
    public function delete(Request $request, Exp $exp, ExpRepository $expRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exp->getId(), $request->request->get('_token'))) {
            $expRepository->remove($exp, true);
        }

        return $this->redirectToRoute('app_exp_index', [], Response::HTTP_SEE_OTHER);
    }
}
