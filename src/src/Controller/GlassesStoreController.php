<?php

namespace App\Controller;

use App\Entity\GlassesStore;
use App\Entity\User;
use App\Form\GlassesStoreType;
use App\Repository\GlassesStoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

#[Route('/stores')]
class GlassesStoreController extends AbstractController
{
    /** @var  TokenStorageInterface */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface  $storage
     */
    public function __construct(
        TokenStorageInterface $storage,
    )
    {
        $this->tokenStorage = $storage;
    }

    #[Route('/', name: 'app_glasses_store_index', methods: ['GET'])]
    public function index(GlassesStoreRepository $glassesStoreRepository): Response
    {
        return $this->render('glasses_store/index.html.twig', [
            'glasses_stores' => $glassesStoreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_glasses_store_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GlassesStoreRepository $glassesStoreRepository): Response
    {
        $glassesStore = new GlassesStore();
        $form = $this->createForm(GlassesStoreType::class, $glassesStore);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('new', $glassesStore);

        $token = $this->tokenStorage->getToken();
        if ($token instanceof TokenInterface) {
            /** @var User $user */
            $user = $token->getUser();
            $glassesStore->setOwner($user);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $glassesStoreRepository->add($glassesStore, true);

            return $this->redirectToRoute('app_glasses_store_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glasses_store/new.html.twig', [
            'glasses_store' => $glassesStore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_glasses_store_show', methods: ['GET'])]
    public function show(GlassesStore $glassesStore): Response
    {
        return $this->render('glasses_store/show.html.twig', [
            'glasses_store' => $glassesStore,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_glasses_store_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GlassesStore $glassesStore, GlassesStoreRepository $glassesStoreRepository): Response
    {
        $form = $this->createForm(GlassesStoreType::class, $glassesStore);
        $form->handleRequest($request);
        $this->denyAccessUnlessGranted('edit', $glassesStore);

        if ($form->isSubmitted() && $form->isValid()) {
            $glassesStoreRepository->add($glassesStore, true);

            return $this->redirectToRoute('app_glasses_store_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('glasses_store/edit.html.twig', [
            'glasses_store' => $glassesStore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_glasses_store_delete', methods: ['POST'])]
    public function delete(Request $request, GlassesStore $glassesStore, GlassesStoreRepository $glassesStoreRepository): Response
    {
        $this->denyAccessUnlessGranted('delete', $glassesStore);
        if ($this->isCsrfTokenValid('delete'.$glassesStore->getId(), $request->request->get('_token'))) {
            $glassesStoreRepository->remove($glassesStore, true);
        }

        return $this->redirectToRoute('app_glasses_store_index', [], Response::HTTP_SEE_OTHER);
    }
}
