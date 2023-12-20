<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Estate;
use App\Models\Adverts;

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
    protected $description = 'This is to check if a given advert has exceeded one month';

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
            $this->info($advert);
        }
        
    }
}
