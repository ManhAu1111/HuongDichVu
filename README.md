# 🏡 Interior Website – Laravel

Website nội thất hiện đại được xây dựng bằng **Laravel thuần**, mô phỏng một hệ thống bán hàng hoàn chỉnh với giao diện thân thiện, hỗ trợ **hiển thị mô hình 3D sản phẩm** và kiến trúc **multi-service**.

---

## 📌 Giới thiệu

Dự án nhằm xây dựng một website bán nội thất hiện đại, tập trung vào:
- Trải nghiệm người dùng (UI/UX)
- Quản lý sản phẩm theo danh mục
- Hiển thị trực quan sản phẩm bằng **mô hình 3D**
- Các chức năng cơ bản của một hệ thống thương mại điện tử

Dự án phù hợp cho mục đích **học tập, đồ án, hoặc mở rộng thành hệ thống thực tế**.

---

## 🚀 Chức năng chính

### 🪑 Quản lý & hiển thị sản phẩm
- Danh mục nội thất: Bàn, Ghế, Sofa, Nệm, Đèn, ...
- Hiển thị danh sách sản phẩm theo danh mục
- Trang chi tiết sản phẩm đầy đủ thông tin
- Hiển thị **mô hình 3D sản phẩm** (xoay, zoom)

### 👤 Người dùng
- Đăng ký / đăng nhập
- Quản lý giỏ hàng
- Thêm / xoá sản phẩm yêu thích (Wishlist)

### 🛒 Mua hàng & thanh toán
- Giỏ hàng
- Đặt hàng
- Thanh toán
- Gửi email thông báo khi đặt hàng

### ⭐ Đánh giá
- Đánh giá sản phẩm
- Hiển thị số sao và nhận xét

### 🎨 Giao diện
- UI đầy đủ cho người dùng
- Thiết kế hiện đại, responsive

---

## 🛠 Công nghệ sử dụng

- **Laravel** – Backend framework
- **MySQL** – Cơ sở dữ liệu
- **Blade Template** – View engine
- **@google/model-viewer** – Hiển thị mô hình 3D sản phẩm
- **Bootstrap / TailwindCSS** – Giao diện người dùng
- **PHP Built-in Server** – Chạy các service phụ

---

## 🧩 Kiến trúc hệ thống

Hệ thống được chia thành nhiều service, mỗi service chạy trên một port riêng:

| Service              | Chức năng |
|----------------------|----------|
| Frontend             | Giao diện người dùng |
| Auth Service         | Xác thực người dùng |
| Product Service      | Quản lý sản phẩm |
| Order Service        | Quản lý đơn hàng |
| Payment Service      | Thanh toán |
| Wishlist Service     | Sản phẩm yêu thích |
| Review Service       | Đánh giá sản phẩm |
| Admin Service        | Quản trị hệ thống |

---

## ▶️ Khởi chạy dự án

### 🔹 Chạy từng service thủ công

| Service              | Lệnh chạy |
|----------------------|----------|
| **Frontend**         | `php artisan serve --host=127.0.0.1 --port=8000` |
| **Auth Service**     | `php -S 127.0.0.1:8001` |
| **Order Service**    | `php artisan serve --port=8002` |
| **Product Service**  | `php -S 127.0.0.1:8003 -t . index.php` |
| **Payment Service**  | `php artisan serve --port=8004` |
| **Wishlist Service** | `php artisan serve --port=8005` |
| **Review Service**   | `php -S 127.0.0.1:8006 -t public` |
| **Admin Service**    | `php artisan serve --port=8007` |

---

### 🔹 Chạy toàn bộ hệ thống bằng script

```bash
chmod +x start-all.sh
./start-all.sh
