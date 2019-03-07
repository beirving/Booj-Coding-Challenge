# Launch Locally
+ cd to docker
+ ./build.sh
+ ./run.sh

# Create Test Database
+ docker exec -it mysql bash
+ mysql -u root -p password
+ CREATE DATABASE test;

# Configure Lumen
+ docker exec -it test bash
+ cd /var/www/html
+ touch .env
+ add the following content to .env
```
APP_NAME=test
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=password

CACHE_DRIVER=array
QUEUE_DRIVER=array
QUEUE_CONNECTION=sync
```
+ Run composer update
+ php artisan migrate

