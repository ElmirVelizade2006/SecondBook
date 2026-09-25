<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Collection;

class NotificationService
{
    /**
     * Send a notification to one user.
     */
    public function send(
        int $userId,
        string $type,
        string $title,
        string $message
    ): Notification {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'read_at' => null,
        ]);
    }

    /**
     * Send a notification to all active admins.
     */
    public function sendToAdmins(
        string $type,
        string $title,
        string $message
    ): Collection {
        $admins = User::query()
            ->where('role', 'admin')
            ->where('status', 'active')
            ->get(['id']);

        return $admins->map(function ($admin) use (
            $type,
            $title,
            $message
        ) {
            return $this->send(
                $admin->id,
                $type,
                $title,
                $message
            );
        });
    }

    /**
     * Send a notification to all active users.
     */
    public function sendToAllUsers(
        string $type,
        string $title,
        string $message
    ): int {
        $users = User::query()
            ->where('status', 'active')
            ->get(['id']);

        $notifications = [];
        $now = now();

        foreach ($users as $user) {
            $notifications[] = [
                'user_id' => $user->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'read_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($notifications)) {
            Notification::insert($notifications);
        }

        return count($notifications);
    }
}