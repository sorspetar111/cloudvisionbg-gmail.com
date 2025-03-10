# Weather Forecast Application

A Laravel application for providing weather forecasts to subscribed users.

## Features

- User authentication and registration
- Subscription management
- Daily weather forecasts
- Email notifications
- Scheduled tasks for automated forecasts

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL or compatible database
- Node.js and NPM (for frontend assets)

## Installation

1. Clone the repository
2. Install dependencies:
   ```
   composer install
   npm install
   ```
3. Copy `.env.example` to `.env` and configure your environment variables
4. Generate application key:
   ```
   php artisan key:generate
   ```
5. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   ```
6. Compile frontend assets:
   ```
   npm run dev
   ```
7. Start the development server:
   ```
   php artisan serve
   ```

## API Endpoints

### Authentication
- POST `/api/login` - User login
- POST `/api/register` - User registration
- POST `/api/logout` - User logout

### Weather
- GET `/api/weather/forecast` - Get weather forecast for authenticated user

### Subscriptions
- POST `/api/subscriptions` - Create a new subscription
- DELETE `/api/subscriptions` - Cancel current subscription
- GET `/api/subscriptions/current` - Get current subscription details

## Scheduled Tasks

The application includes the following scheduled tasks:

- Daily weather forecast emails (8:00 AM)
- Daily subscription status check

To run the scheduler locally:
```
php artisan schedule:work
```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).