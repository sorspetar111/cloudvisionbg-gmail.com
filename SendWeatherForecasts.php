<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Mail\WeatherForecastMail;
use Illuminate\Support\Facades\Mail;

class SendWeatherForecasts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-weather-forecasts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send weather forecasts to subscribed users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereHas('subscriptions', function ($query) {
            $query->where('status', 'active');
        })->get();

        $this->info("Sending weather forecasts to {$users->count()} users");

        foreach ($users as $user) {
            if (!$user->location) {
                $this->warn("User {$user->id} has no location set, skipping");
                continue;
            }

            // Fetch weather data
            $weatherData = $this->fetchWeatherData($user->location);
            
            // Send email
            Mail::to($user->email)->send(new WeatherForecastMail($weatherData));
            
            $this->info("Sent forecast to {$user->email}");
        }

        $this->info('Weather forecasts sent successfully');
    }

    /**
     * Fetch weather data from external service
     *
     * @param string $location
     * @return array
     */
    private function fetchWeatherData($location)
    {
        // Implementation for fetching weather data
        // This would typically use an external API
        
        // Placeholder data for demonstration
        return [
            'location' => $location,
            'temperature' => rand(0, 30),
            'condition' => ['Sunny', 'Cloudy', 'Rainy', 'Snowy'][rand(0, 3)],
            'forecast' => [
                'today' => ['high' => rand(15, 30), 'low' => rand(0, 15)],
                'tomorrow' => ['high' => rand(15, 30), 'low' => rand(0, 15)],
            ]
        ];
    }
}