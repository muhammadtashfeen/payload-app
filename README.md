# Payload App

A small Laravel 13 app used as a realistic workload for my infrastructure
projects: HTTP API, queue worker and scheduled job.

## Endpoints
- `GET /up` health check
- `POST /api/events` accepts an event, queues processing (202)

## Run locally
```bash
composer install
php artisan migrate
php artisan serve
php artisan queue:work
php artisan test
```

## Where it is deployed
- Provisioned and deployed with [laravel-server-provisioner](https://github.com/muhammadtashfeen/laravel-server-provisioner)

## Notes
- `composer.lock` is pinned to PHP 8.3 (`platform.php`) to match Ubuntu 24.04
