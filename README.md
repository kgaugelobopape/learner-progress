# Learner Progress Dashboard - Coding Challenge

## Getting Started

### Setup Instructions
1. Clone repo and cd into project folder
2. Run `composer install`
3. Configure your `.env` file from the example
4. Generate the App Key: `php artisan key:generate`
5. Create SQLite DB `touch database/database.sqlite`
6. Run migrations and seeders: `php artisan migrate --seed`

### App Setup
1. `npm install vue @vitejs/plugin-vue`
2.  `npm install bootstrap@5` for bootstrap UI library
3. `npm install` to add all dependencies
4. `npm run build` to recompile changes

### Run Application locally
1. Run `php artisan serve`
2. Visit: http://localhost:8000

## Key Features Implemented
1. Clean Architecture - Repository Pattern with Service Layer separation
2. Optimized Queries - Eager loading to prevent N+1 problems
3. Bootstrap 5 - Modern, responsive UI with Bootstrap styling
4. Smart Filtering - Course filtering with bi-directional sorting 
