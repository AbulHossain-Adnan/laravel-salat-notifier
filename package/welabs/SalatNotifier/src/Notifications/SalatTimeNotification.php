<?php 

namespace welabs\SalatNotifier\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class SalatTimeNotification extends Notification
{
    protected $salat;

    public function __construct($salat)
    {
        $this->salat = $salat;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content('It\'s almost time for ' . $this->salat->salat . '! The prayer is at ' . $this->salat->time);
    }
}
