<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BlogUpdated;
use App\Mail\BlogUpdatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBlogUpdateNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BlogUpdated $event): void
    {
        //Created User
        $createdUser = $event->blog->user;
        //Updated User
        $updatedBy = $event->updatedBy;

        // Mail::to($createdUser->email)->queue(new BlogUpdatedNotification($event->blog, $updatedBy));
        Mail::to($createdUser->email)->send(new BlogUpdatedNotification($event->blog, $updatedBy));

        // try {
        //     Mail::to($event->blog->user) // User A
        //         ->send(new BlogUpdatedNotification($event->blog, $event->blog->user));
        // } catch (\Exception $e) {
        //     // Log or handle the error
        //     Log::error('Failed to send blog update notification:', ['error' => $e->getMessage()]);
        // }
    }
}
