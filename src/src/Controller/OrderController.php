<?php

namespace App\Controller;

use App\Entity\Glasses;
use App\Entity\Order;
use App\Entity\User;
use App\Repository\OrderRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

#[Route('/order')]
class OrderController extends AbstractController
{

    /** @var  TokenStorageInterface */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface $storage
     */
    public function __construct(
        TokenStorageInterface $storage,
    )
    {
        $this->tokenStorage = $storage;
    }

    #[Route('/', name: 'app_order_index', methods: ['GET'])]
    #[IsGranted('ROLE_BUYER')]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_order_new', methods: ['GET', 'POST'])]
    public function new(Glasses $glasses, OrderRepository $orderRepository): Response
    {
        $order = new Order();
        $this->denyAccessUnlessGranted('new', $order);
        $order->setProduct($glasses);

        $token = $this->tokenStorage->getToken();
        if ($token instanceof TokenInterface) {
            /** @var User $user */
            $user = $token->getUser();
            $order->setBuyer($user);
        }

        $orderRepository->add($order, true);

        $this->addFlash(
            'success',
            'You have successfully ordered a glasses.'
        );

        return $this->redirectToRoute('app_order_index');
    }

    #[Route('/{id}', name: 'app_order_show', methods: ['GET'])]
    public function show(Order $order): Response
    {
        $this->denyAccessUnlessGranted('view', $order);
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    #[Route('/{id}', name: 'app_order_delete', methods: ['POST'])]
    public function delete(Request $request, Order $order, OrderRepository $orderRepository): Response
    {
        $this->denyAccessUnlessGranted('delete', $order);
        if ($this->isCsrfTokenValid('delete' . $order->getId(), $request->request->get('_token'))) {
            $orderRepository->remove($order, true);
        }

        return $this->redirectToRoute('app_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
