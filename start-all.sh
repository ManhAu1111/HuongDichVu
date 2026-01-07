#!/bin/bash

echo "Starting HOMELUX services..."

(cd frontend && php artisan serve --port=8000) &
(cd auth-service && php -S 127.0.0.1:8001) &
(cd order-service && php artisan serve --port=8002) &
(cd product-service && php -S 127.0.0.1:8003 -t . index.php) &
(cd payment-service && php artisan serve --port=8004) &
(cd wishlist-service && php artisan serve --port=8005) &
(cd review-service && php -S 127.0.0.1:8006 -t public) &
(cd admin-service && php artisan serve --port=8007) &

wait
