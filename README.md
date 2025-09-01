Hipster Inc Technical Round Project

Setup Instructions

Clone Repository:
       git clone https://github.com/RMNH99/hipster_inc_tr.git

        cd hipster_inc_tr

Install Dependencies:
   composer install
   
Environment Setup:
   cp .env.example .env

   php artisan key:generate
   
Run Migrations:

   php artisan migrate
   
Start Development Server:

   php artisan serve
   

Multi-Auth Strategy & Route Protection

- Guards Defined:
  - web → Customers
  - admin → Administrators

- Middleware Protection:
  - auth:web → Restricts routes to logged-in customers
  - auth:admin → Restricts routes to logged-in admins

- Example Usage:
    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index']);
    });

    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'index']);
    });


Queue Worker
queue system to handle heavy tasks like bulk imports and sending notifications in the background.

To start processing jobs, run:
php artisan queue:work

- Ensures imports and notifications don’t block the main request cycle.
- Recommended to run queue workers using a process monitor like Supervisor in production.

  
Bulk Import Implementation
- Bulk product import is handled via queued jobs for performance.
- Optimizations Used:
  - Chunked database inserts
  - Validation before processing
  - Failures logged for debugging


Websocket Stack

- Laravel Echo is used for real-time event listening.
- Pusher / Laravel Websockets can be configured as the broadcast driver.

- Use Case Examples:
  - Real-time order status updates
  - Online/offline user presence for admins & customers

- Key Features Implemented:
  - Presence channels for tracking online users
  - Private channels for secured order updates
 
    

Testing Guide
- Run all tests with:
php artisan test


- Test Coverage Includes:
  - Feature tests for product creation & order placement


 
Architectural & Performance Decisions
- No NPM stack → The project avoids JS build tools to keep setup simple and backend-driven.
- Real-time updates via Laravel Echo + Websockets for instant feedback instead of polling.
- Bulk import optimized using chunk inserts and background jobs.
- Clean separation of concerns:
  - Controllers handle requests
  - Jobs handle heavy tasks

