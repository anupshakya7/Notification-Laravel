# Setup Instructions

## Clone the Repository
git clone https://github.com/anupshakya7/Notification-Laravel.git
cd Notification-Laravel

## Install Dependencies
composer install

## Configure .env
cp .env.example .env
php artisan key:generate

## Update these fields on .env
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
BROADCAST_DRIVER=redis

REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

## Run Migrations
php artisan migrate

## Start Redis
redis-server

## Verify Redis Works
php artisan tinker
>>> Redis::ping()
=> "PONG"

## Serve Application
php artisan serve

## Run Node Project for that I have write read.md seperately on that repo 

## Send Notification
POST /api/notifications 
-> for creating notification
-> Limit: 10 notifications/hour/user
-> Publishes to Redis on success

## For Update Notification Status API
PUT /api/notifications/{id}

## For Recent Notifications
GET /api/notifications/recent

## Get Summary
GET /api/notifications/summary
