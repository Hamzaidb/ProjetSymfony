<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Notification;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/produit/{id}', name: 'product_show')]
    public function show(Produit $produit): Response
    {
        return $this->render('product/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/produit/{id}/acheter', name: 'product_buy', methods: ['POST'])]
    public function buy(Produit $produit, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('danger', 'Vous devez être connecté pour acheter.');
            return $this->redirectToRoute('app_login');
        }

        if (!$user->isActif()) {
            $this->addFlash('danger', 'Votre compte est désactivé, vous ne pouvez pas acheter de produit.');
            return $this->redirectToRoute('product_show', ['id' => $produit->getId()]);
        }

        if ($user->getPoints() < $produit->getPrix()) {
            $this->addFlash('danger', 'Vous n\'avez pas assez de points.');
            return $this->redirectToRoute('product_show', ['id' => $produit->getId()]);
        }

        $user->setPoints($user->getPoints() - $produit->getPrix());
        $em->flush();

        // Notification admin
        $notification = new Notification();
        $notification->setType('achat');
        $notification->setLabel('Achat de produit');
        $notification->setMessage(sprintf(
            'Achat du produit "%s" par %s le %s',
            $produit->getNom(),
            $user->getNom(),
            (new \DateTimeImmutable())->format('d/m/Y H:i')
        ));
        $notification->setUser($user);
        $notification->setCreatedAt(new \DateTimeImmutable());
        $notification->setUpdatedAt(new \DateTimeImmutable());
        $em->persist($notification);
        $em->flush();

        $this->addFlash('success', 'Achat effectué avec succès !');
        return $this->redirectToRoute('product_show', ['id' => $produit->getId()]);
    }
}