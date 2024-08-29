<?php 

namespace welabs\SalatNotifier\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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

            // Check if the current time is within 1 minute past the notification time
            if (now()->between($notificationTime, now()->parse($salat->time)) && !$salat->notification_sent) {
                Notification::route('slack', config('salatnotifier.slack_webhook'))
                    ->notify(new SalatTimeNotification($salat));

                $salat->update(['notification_sent'=>true]);
            }

            // Reset the notification_sent flag if the notification time is in the future
            if($notificationTime->isFuture()) {

                $salat->update(['notification_sent'=>false]);

            }
            
        }




    }
}
