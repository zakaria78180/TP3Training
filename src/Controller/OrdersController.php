<?php
namespace App\Controller;

use App\Repository\CartRepository;
use App\Repository\CartItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrdersController extends AbstractController
{
    #[Route('/orders', name: 'orders')]
    public function index(CartItemRepository $cartItemRepository): Response
    {
        // Get all CartItem entities where the associated Cart is paid and not validated
        $paidCartItems = $cartItemRepository->findPaidCartItems();

        // Group CartItems by Cart
        $groupedCartItems = [];
        foreach ($paidCartItems as $item) {
            $cartId = $item->getCart()->getId();
            if (!isset($groupedCartItems[$cartId])) {
                $groupedCartItems[$cartId] = [
                    'cart' => $item->getCart(),
                    'items' => []
                ];
            }
            $groupedCartItems[$cartId]['items'][] = $item;
        }

        return $this->render('orders/Commandes.html.twig', [
            'groupedCartItems' => $groupedCartItems,
        ]);
    }

     #[Route('/orders/client', name: 'orders_client')]
    public function ordersClient(CartItemRepository $cartItemRepository, UserInterface $user): Response
    {
        // Get all CartItem entities where the associated Cart is paid, not validated, and belongs to the current user
        $paidCartItems = $cartItemRepository->findPaidCartItemsClient($user);

        // Group CartItems by Cart
        $groupedCartItems = [];
        foreach ($paidCartItems as $item) {
            $cartId = $item->getCart()->getId();
            if (!isset($groupedCartItems[$cartId])) {
                $groupedCartItems[$cartId] = [
                    'cart' => $item->getCart(),
                    'items' => []
                ];
            }
            $groupedCartItems[$cartId]['items'][] = $item;
        }

        return $this->render('orders/CommandesClient.html.twig', [
            'groupedCartItems' => $groupedCartItems,
        ]);
    }

    #[Route('/orders/validate/{id}', name: 'validate_order', methods: ['POST'])]
    public function validateOrder(int $id, CartRepository $cartRepository, EntityManagerInterface $entityManager): Response
    {
        $cart = $cartRepository->find($id);

        if (!$cart) {
            throw $this->createNotFoundException('Cart not found');
        }

        $cart->setValidated(true);
        $entityManager->flush();

        $this->addFlash('success', 'Order has been validated!');

        return $this->redirectToRoute('orders');
    }
}