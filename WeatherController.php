<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\WeatherForecastMail;
use Illuminate\Support\Facades\Mail;

class WeatherController extends Controller
{
    /**
     * Get weather forecast for the authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWeatherForecast(Request $request)
    {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        
        // Fetch weather data from external API or service
        $weatherData = $this->fetchWeatherData($user->location);
        
        // Send email with weather forecast
        Mail::to($user->email)->send(new WeatherForecastMail($weatherData));
        
        return response()->json([
            'success' => true,
            'data' => $weatherData
        ]);
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