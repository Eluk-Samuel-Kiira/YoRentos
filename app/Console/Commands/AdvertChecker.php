<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estate;
use App\Models\Adverts;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TenantLeaseNotification;

class AdvertChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:advert-checker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is to check if a given advert has exceeded one month and check for the dates due for rental payments';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneMonthAgo = now()->subMonth();
        $runningAds = Adverts::where('status', 0)->where('created_at', '<', $oneMonthAgo)->get();

        foreach ($runningAds as $advert) {
            Estate::where('id', $advert->estate_id)
                  ->where('landlord_id', $advert->landlord_id)
                  ->update(['sponsored' => 0]);
            // $this->info($advert);
        }

        $lease_dates = Unit::where('status', 1)->get();

        foreach ($lease_dates as $lease_date) {
            if ($lease_date->status == 1 && $lease_date->estateName->status == 1)
            {
                $lease_start = Carbon::parse($lease_date->lease_start);
                $lease_stop = Carbon::parse($lease_date->lease_stop);
                $daysDifference = $lease_start->diffInDays($lease_stop);
                $user_id = $lease_date->tenant_id;
                $user = User::where('status', 1)->where('deleted', 1)->where('id', $user_id)->first();

                if($user)
                {
                    if ($daysDifference <= 5)
                    {
                        $lease_notify = [
                            'body' => 'RENT DEW YoRENTOS',
                            'message' => 'Kindly be reminded that the next rent payment for unit '.$lease_date->unit.' is due in less than 5 days.',
                            'url' => url('/dashboard'),
                            'thankyou' => 'Thanks, Manangement '.$lease_date->estateName->estate
                        ];
                        Notification::sendNow($user, new TenantLeaseNotification($lease_notify));

                        // send sms also
                        $basic  = new \Vonage\Client\Credentials\Basic("027f272f", "3K8W9Pr2iuRPb9Yw");
                        $client = new \Vonage\Client($basic);

                        $response = $client->sms()->send(
                            new \Vonage\SMS\Message\SMS($user->phone_number, "YoRentos",
                                'Kindly be reminded that your next rent payment for unit '.$lease_date->unit.' is due in less than 5 days. Thanks, Management '.$lease_date->estateName->estate)
                        );
                        
                        $message = $response->current();
                        
                        if ($message->getStatus() == 0) {
                            $this->info('The message was sent successfully\n');
                        } else {
                            $this->info("The message failed with status: " . $message->getStatus() . "\n");
                        }
                    } 
                    // $this->info('User Does Not Exist or Unverified');
                }

                //Let the landlord be awre too
                $landlord = User::where('status', 1)->where('deleted', 1)->where('id', $lease_date->estateName->landlord_id)->first();
                if ($landlord)
                {
                    if ($daysDifference <= 5) // less than 5 days
                    {
                        $lease_notify = [
                            'body' => 'RENT DEW YoRENTOS',
                            'message' => 'Kindly be reminded that the next rent payment for the unit '.$lease_date->unit.' in '.$lease_date->estateName->estate.' Estate/Property is due in less than 5 days.',
                            'url' => url('/dashboard'),
                            'thankyou' => 'YoRentos. Thanks,'
                        ];
                        Notification::sendNow($landlord, new TenantLeaseNotification($lease_notify));
                    } 
                }
            } else {
                // unpaid
                // $this->info('Unpaid');
            }
        }
    }
}
