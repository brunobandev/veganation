<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class NewRecipePublished extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return [FacebookPosterChannel::class];
    }

    public function toFacebookPoster($recipe)
    {
        return (new FacebookPosterPost($recipe->name))
            ->withLink(url('recipes/' . $recipe->slug));
    }
}
