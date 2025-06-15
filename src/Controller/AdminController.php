<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Notification;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function dashboard(
        UserRepository $userRepo,
        ProduitRepository $produitRepo,
        NotificationRepository $notifRepo
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/dashboard.html.twig', [
            'users' => $userRepo->findAll(),
            'produits' => $produitRepo->findAll(),
            'notifications' => $notifRepo->findAll(),
        ]);
    }

    #[Route('/admin/produit/new', name: 'admin_produit_new')]
    #[Route('/admin/produit/{id}/edit', name: 'admin_produit_edit')]
    public function editProduit(
        Request $request,
        EntityManagerInterface $em,
        ProduitRepository $produitRepo,
        int $id = null
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $produit = $id ? $produitRepo->find($id) : new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produit->setUser($this->getUser());
            $em->persist($produit);
            $em->flush();

            // Notification
            $label = $id ? 'Modification de produit' : 'Ajout de produit';
            $message = sprintf(
                'Produit "%s" %s par %s le %s',
                $produit->getNom(),
                $id ? 'modifié' : 'ajouté',
                $this->getUser()->getNom(),
                (new \DateTimeImmutable())->format('d/m/Y H:i')
            );
            $notification = new Notification();
            $notification->setType('produit');
            $notification->setLabel($label);
            $notification->setMessage($message);
            $notification->setUser($this->getUser());
            $notification->setCreatedAt(new \DateTimeImmutable());
            $notification->setUpdatedAt(new \DateTimeImmutable());
            $em->persist($notification);
            $em->flush();

            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/produit_form.html.twig', [
            'form' => $form->createView(),
            'produit' => $produit,
        ]);
    }

    #[Route('/admin/produit/{id}/delete', name: 'admin_produit_delete', methods: ['POST'])]
    public function deleteProduit(
        Produit $produit,
        EntityManagerInterface $em
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $nomProduit = $produit->getNom();
        $em->remove($produit);
        $em->flush();

        // Notification
        $label = 'Suppression de produit';
        $message = sprintf(
            'Produit "%s" supprimé par %s le %s',
            $nomProduit,
            $this->getUser()->getNom(),
            (new \DateTimeImmutable())->format('d/m/Y H:i')
        );
        $notification = new Notification();
        $notification->setType('produit');
        $notification->setLabel($label);
        $notification->setMessage($message);
        $notification->setUser($this->getUser());
        $notification->setCreatedAt(new \DateTimeImmutable());
        $notification->setUpdatedAt(new \DateTimeImmutable());
        $em->persist($notification);
        $em->flush();

        return $this->redirectToRoute('admin_dashboard');
    }

    #[Route('/admin/user/{id}/toggle', name: 'admin_user_toggle', methods: ['POST'])]
    public function toggleUser(User $user, EntityManagerInterface $em, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($this->isCsrfTokenValid('toggle-user-' . $user->getId(), $request->request->get('_token'))) {
            $user->setActif(!$user->isActif());
            $em->flush();
            $this->addFlash('success', 'Le statut de l\'utilisateur a été modifié.');
        }
        return $this->redirectToRoute('admin_dashboard');
    }

    #[Route('/admin/users/add-points', name: 'admin_users_add_points', methods: ['POST'])]
    public function addPointsToActiveUsers(
        UserRepository $userRepo,
        EntityManagerInterface $em
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $userRepo->findBy(['actif' => true]);
        foreach ($users as $user) {
            $user->setPoints($user->getPoints() + 1000);
        }
        $em->flush();
        $this->addFlash('success', '1000 points ont été ajoutés à tous les utilisateurs actifs.');
        return $this->redirectToRoute('admin_dashboard');
    }
}