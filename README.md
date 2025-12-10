# Learner Progress Dashboard - Coding Challenge

## Getting Started

### Setup Instructions
1. Run `composer install`
2. Configure your `.env` file from the example
3. Generate the App Key: `php artisan key:generate`
4. Run migrations and seeders: `php artisan migrate --seed`
5. Start the development server: `php artisan serve`

### Database Setup
1. `php artisan migrate`
2. `php artisan db:seed`

### Run Application
1. `php artisan serve` 
2. Visit: http://localhost:8000

### App Setup
1. `npm install vue @vitejs/plugin-vue`
2. `npm i && npm run build`

## Key Features Implemented
1. Clean Architecture - Repository Pattern with Service Layer separation
2. Optimized Queries - Eager loading to prevent N+1 problems
3. Bootstrap 5 - Modern, responsive UI with Bootstrap styling
4. Smart Filtering - Course filtering with bi-directional sorting 
