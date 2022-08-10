<?php

namespace App\Controller;

use App\Entity\Glasses;
use App\Form\GlassesType;
use App\Repository\GlassesRepository;
use App\Search\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/glasses')]
class GlassesController extends AbstractController
{
    #[Route('/', name: 'app_glasses_index', methods: ['GET'])]
    public function index(GlassesRepository $glassesRepository): Response
    {
        return $this->render('glasses/index.html.twig', [
            'glasses' => $glassesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_glasses_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GlassesRepository $glassesRepository): Response
    {
        $glass = new Glasses();
        $form = $this->createForm(GlassesType::class, $glass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $glassesRepository->add($glass, true);

            return $this->redirectToRoute('app_glasses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glasses/new.html.twig', [
            'glass' => $glass,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_glasses_show', methods: ['GET'])]
    public function show(Glasses $glass): Response
    {
        return $this->render('glasses/show.html.twig', [
            'glass' => $glass,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_glasses_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Glasses $glass, GlassesRepository $glassesRepository): Response
    {
        $form = $this->createForm(GlassesType::class, $glass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $glassesRepository->add($glass, true);

            return $this->redirectToRoute('app_glasses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glasses/edit.html.twig', [
            'glass' => $glass,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_glasses_delete', methods: ['POST'])]
    public function delete(Request $request, Glasses $glass, GlassesRepository $glassesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$glass->getId(), $request->request->get('_token'))) {
            $glassesRepository->remove($glass, true);
        }

        return $this->redirectToRoute('app_glasses_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/search', name: 'app_glasses_search', methods: ['GET'])]
    public function search(Request $request, SearchService $glassesSearch): Response
    {
        $q = $request->query->get('query');
        $glasses = $glassesSearch->search($q);

        return $this->render('glasses/search.html.twig', [
            'query' => $q,
            'glasses' => $glasses,
        ]);
    }
}
