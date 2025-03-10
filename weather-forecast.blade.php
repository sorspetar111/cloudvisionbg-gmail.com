<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Forecast</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3490dc;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8fafc;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 0 0 5px 5px;
        }
        .forecast-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }
        .forecast-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .temperature {
            font-size: 24px;
            font-weight: bold;
        }
        .condition {
            display: inline-block;
            padding: 5px 10px;
            background-color: #edf2f7;
            border-radius: 15px;
            margin-top: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Weather Forecast</h1>
    </div>
    
    <div class="content">
        <h2>Current Weather for {{ $weatherData['location'] }}</h2>
        
        <div class="forecast-item">
            <h3>Today</h3>
            <div class="temperature">{{ $weatherData['temperature'] }}°C</div>
            <div class="condition">{{ $weatherData['condition'] }}</div>
            <p>High: {{ $weatherData['forecast']['today']['high'] }}°C | Low: {{ $weatherData['forecast']['today']['low'] }}°C</p>
        </div>
        
        <div class="forecast-item">
            <h3>Tomorrow</h3>
            <p>High: {{ $weatherData['forecast']['tomorrow']['high'] }}°C | Low: {{ $weatherData['forecast']['tomorrow']['low'] }}°C</p>
        </div>
    </div>
    
    <div class="footer">
        <p>This forecast was sent to you as part of your subscription. To manage your subscription preferences, please visit your account settings.</p>
    </div>
</body>
</html>