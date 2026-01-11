@echo off
echo Starting HOMELUX services...

cd frontend && start /B php artisan serve --port=8000
cd ..\auth-service && start /B php -S 127.0.0.1:8001
cd ..\order-service && start /B php artisan serve --port=8002
cd ..\product-service && start /B php -S 127.0.0.1:8003 -t . index.php
cd ..\payment-service && start /B php artisan serve --port=8004
cd ..\wishlist-service && start /B php artisan serve --port=8005
cd ..\review-service && start /B php -S 127.0.0.1:8006 -t public
cd ..\admin-service && start /B php artisan serve --port=8007

echo All services running in background.
pause