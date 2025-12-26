
🏡 Interior Website – Laravel

Dự án website nội thất hiện đại được xây dựng bằng Laravel thuần, gồm các chức năng cơ bản cho một trang bán hàng.

🚀 Chức năng

Quản lý sản phẩm

Danh mục nội thất

Hiển thị mô hình 3D sản phẩm

Đăng ký / đăng nhập

Giỏ hàng & thanh toán

Gửi email thông báo

Giao diện người dùng (UI) đầy đủ

🛠 Công nghệ sử dụng

Laravel

MySQL

Blade Template

Three.js (hiển thị 3D)

Bootstrap / TailwindCSS

khởi chạy dự án
## 🚀 Khởi chạy dự án

| Service             | Lệnh chạy                                                        |
|---------------------|------------------------------------------------------------------|
| **Frontend**        | `php artisan serve --host=127.0.0.1 --port=8000`                 |
| **Auth Service**    | `php -S 127.0.0.1:8001`                                          |
| **Payment Service** | `php artisan serve --port=8004`                                  |
| **Product Service** | `php -S 127.0.0.1:8003 -t . index.php`                           |
| **Order Service**   | `php artisan serve --port=8002`                                  |
| **Wishlist Service**| `php artisan serve --port=8005`                                  |
| **Review Service**  | `php -S 127.0.0.1:8006 -t public`                                |
| **Admin Service**   | `php artisan serve --port=8007`                                  |

