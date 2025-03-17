<?php

namespace App\Manager;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Bougie;
use App\Entity\ObjetDecoration;
use App\Entity\Poudre;
use App\Entity\Fondant;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartManager
{
    private $session;
    private $entityManager;

    public function __construct(SessionInterface $session, EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public function getCurrentCart(): Cart
    {
        $cartId = $this->session->get('cart_id', null);
        if ($cartId) {
            $cart = $this->entityManager->getRepository(Cart::class)->find($cartId);
            if ($cart) {
                return $cart;
            }
        }

        $cart = new Cart();
        $this->entityManager->persist($cart);
        $this->entityManager->flush();
        $this->session->set('cart_id', $cart->getId());

        return $cart;
    }

    public function addProductToCart(Cart $cart, $produit, int $quantity): void
    {
        $cartItem = $this->findCartItem($cart, $produit);

        if ($cartItem) {
            $cartItem->setQuantity($cartItem->getQuantity() + $quantity);
        } else {
            $cartItem = new CartItem();
            $cartItem->setCart($cart);
            $cartItem->setQuantity($quantity);

            if ($produit instanceof Bougie) {
                $cartItem->setBougie($produit);
            } elseif ($produit instanceof ObjetDecoration) {
                $cartItem->setObjectDecoration($produit);
            } elseif ($produit instanceof Poudre) {
                $cartItem->setPoudre($produit);
            } elseif ($produit instanceof Fondant) {
                $cartItem->setFondant($produit);
            }

            $this->entityManager->persist($cartItem);
        }

        $this->entityManager->flush();
    }

    public function removeProductFromCart(Cart $cart, CartItem $cartItem): void
    {
        $cart->getItems()->removeElement($cartItem);
        $this->entityManager->remove($cartItem);
        $this->entityManager->flush();
    }

    public function payCart(Cart $cart, User $user): void
    {
        
        // Mark the current cart as paid and set the user
        $cart->setPaid(true);
        $cart->setUser($user);
        $this->entityManager->flush();

        // Create a new cart and set it as the current cart
        $newCart = new Cart();
        $this->entityManager->persist($newCart);
        $this->entityManager->flush();
        $this->session->set('cart_id', $newCart->getId());
    }

    private function findCartItem(Cart $cart, $produit): ?CartItem
    {
        foreach ($cart->getItems() as $item) {
            if ($produit instanceof Bougie && $item->getBougie() === $produit) {
                return $item;
            }
            if ($produit instanceof ObjetDecoration && $item->getObjectDecoration() === $produit) {
                return $item;
            }
            if ($produit instanceof Poudre && $item->getPoudre() === $produit) {
                return $item;
            }
            if ($produit instanceof Fondant && $item->getFondant() === $produit) {
                return $item;
            }
        }

        return null;
    }
}