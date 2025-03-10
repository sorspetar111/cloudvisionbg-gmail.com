<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscription;
use Carbon\Carbon;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired subscriptions and update their status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        
        // Find active subscriptions that have passed their end date
        $expiredSubscriptions = Subscription::where('status', 'active')
            ->where('end_date', '<', $now)
            ->get();
            
        $count = $expiredSubscriptions->count();
        $this->info("Found {$count} expired subscriptions");
        
        foreach ($expiredSubscriptions as $subscription) {
            $subscription->status = 'expired';
            $subscription->save();
            
            $this->info("Marked subscription {$subscription->id} as expired");
        }
        
        $this->info('Subscription check completed successfully');
    }
}