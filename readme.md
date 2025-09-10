## Laravel with Redis Caching and Queue Integration
This project demonstrates how to integrate Redis caching and queues into a Laravel application. It includes a simple product listing feature that fetches best-selling products from the database and caches the results using Redis for improved performance.

### Features
- Fetch best-selling products from the database.
- Cache the results using Redis to reduce database load.
- Automatically invalidate the cache when product data changes.
- Use Laravel queues using Redis for background processing.
- Queue a job to send Best Selling Products report via email.
- Simple React frontend to display best-selling products.

### Requirements
- PHP >= 8.0
- Composer
- Node.js and npm
- Redis server
- Laravel 10.x

### Installation
1. Clone the repository:
   ```bash
   git clone 
    cd laravel-redis-integration
    ```
2. Install PHP dependencies:
    ```bash
    composer install
    ```
3. Install JavaScript dependencies:
    ```bash
    npm install
    ```
4. Copy the example environment file and configure it:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. Configure your `.env` file to use Redis:
    ```env
    CACHE_DRIVER=redis
    QUEUE_CONNECTION=redis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    ```
6. Run database migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```
7. Start the Redis server (if not already running):
    ```bash
    redis-server
    ```
8. Start the Laravel development server:

    ```bash
    php artisan serve
    ```
9. Start the React development server:  
    ```bash
    npm run dev
    ```
10. Start the Laravel queue worker:
    ```bash
    php artisan queue:work
    ```
### Usage
- Visit `http://localhost:8000` to see the React frontend displaying best-selling products.
- The product data is fetched from the database and cached in Redis for 60 minutes.
- When a product is updated, the cache is automatically invalidated to ensure fresh data.
- You can queue a job to send the Best Selling Products report via email.
- Monitor the queue worker to see job processing in action.

### License
This project is open-sourced software licensed under the MIT license.

### Acknowledgements
- [Laravel Documentation](https://laravel.com/docs)
- [React Documentation](https://reactjs.org/docs/getting-started.html)
- [Redis Documentation](https://redis.io/documentation)


