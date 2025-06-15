<?php

namespace App\Twig;

use App\Repository\NotificationRepository;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class GlobalNotificationsExtension extends AbstractExtension implements GlobalsInterface
{
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function getGlobals(): array
    {
        return [
            'notifications' => $this->notificationRepository->findAll(),
        ];
    }
}