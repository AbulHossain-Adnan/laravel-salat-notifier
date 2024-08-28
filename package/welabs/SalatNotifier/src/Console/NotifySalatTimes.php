<?php 

namespace welabs\SalatNotifier\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use welabs\SalatNotifier\Notifications\SalatTimeNotification;
use welabs\SalatNotifier\SalatTimeManager;


class NotifySalatTimes extends Command
{
    protected $signature = 'salat:notify';
    protected $description = 'Send Slack notifications for Salat times';

    public function handle(SalatTimeManager $manager)
    {
        $salatTimes = $manager->getAllSalatTimes();
    
        foreach ($salatTimes as $salat) {

            $notificationTime = now()->parse($salat->time)->subMinutes(10);

            // Check if the current time is exactly equal to the notification time
            if (now()->format('H:i') === $notificationTime->format('H:i')) {
                Notification::route('slack', config('salatnotifier.slack_webhook'))
                    ->notify(new SalatTimeNotification($salat));
            }
            
        }
    }
}
