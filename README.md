# Dự án: Pomodoro & Task Management System

## Giới thiệu dự án

Pomodoro & Task Management System là một ứng dụng nền tảng web được xây dựng nhằm hỗ trợ người dùng quản lý thời gian hiệu quả theo phương pháp Pomodoro kết hợp với quản lý công việc (Task Management). Giao diện trực quan với các tính năng như đồ thị thống kê, giao diện kéo thả công việc.

---

## 1) Công nghệ sử dụng

Dự án được xây dựng dựa trên các công nghệ và thư viện mã nguồn mở sau:

- **Backend:**
    - PHP (^8.2)
    - Laravel Framework (^11.31)
- **Frontend:**
    - Vite (^6.0)
    - TailwindCSS (^3.1)
    - Alpine.js (^3.14)
    - Chart.js (^4.5) - Hiển thị biểu đồ báo cáo.
    - SweetAlert2 (^11.15) - Hiển thị thông báo (alerts).
    - SortableJS (^1.15) - Hỗ trợ thao tác kéo thả (drag & drop) cho task.
    - Lucide - Icon set.

## 2) Cấu trúc thư mục chính

Dự án sử dụng kiến trúc Domain-Driven Design (DDD) chia nhỏ thành các modules. Cấu trúc thư mục tiêu biểu như sau:

```text
/
├── app/                  # Chứa các file cấu hình, Http kernel cốt lõi của Laravel
├── bootstrap/            # Chứa các file khởi động hệ thống
├── config/               # Chứa các file cấu hình hệ thống
├── database/             # Chứa migrations, seeders, factories
├── modules/              # KIẾN TRÚC MODULAR - Nơi chứa các tính năng nghiệp vụ chính
│   ├── Auth/             # Module Xác thực (Login, Register...)
│   ├── Pomodoro/         # Module Quản lý đếm giờ Pomodoro
│   ├── Report/           # Module Báo cáo thống kê
│   ├── Settings/         # Module Cài đặt người dùng / Hệ thống
│   └── Task/             # Module Quản lý công việc (Task)
├── public/               # Nơi chứa file entry point (index.php) và public assets
├── resources/            # Nơi chứa các views (Blade), CSS, JS chưa build
├── routes/               # Nơi chứa các route chính của hệ thống (web, api, console)
└── tests/                # Nơi chứa các file unit tests & feature tests
```

Bên trong mỗi Module (VD: `modules/Pomodoro/`) sẽ được chia nhỏ thành các tầng:

- `Actions/`
- `Controllers/`
- `DTOs/`
- `Events/`
- `Providers/`
- `Requests/`
- `Routes/`
- `Services/`

## 3) Chức năng nổi bật

- **Quản lý công việc (Task Management):** Cho phép tạo, sửa, xóa, và kéo thả (drag & drop với SortableJS) các công việc.
- **Pomodoro Timer:** Hỗ trợ bộ đếm ngược thời gian làm việc chuẩn Pomodoro (Start, Pause, Finish).
- **Thống kê & Báo cáo:** Tự động thống kê số lượng phiên Pomodoro đã hoàn thành, hiển thị dưới dạng biểu đồ trực quan (sử dụng Chart.js).
- **Giao diện tương tác:** Tích hợp Alpine.js giúp các components phản hồi nhanh chóng, hiển thị pop-up mượt mà với SweetAlert2.

## 4) Bảo mật & phân quyền

- **Xác thực:** Ứng dụng sử dụng Laravel Sanctum để xử lý việc đăng nhập, bảo vệ các endpoint API và duy trì phiên đăng nhập của người dùng một cách an toàn.
- **Phân quyền (Middleware):** Sử dụng các middleware mặc định của Laravel kết hợp với các chính sách phân quyền theo từng Module nhằm đảm bảo dữ liệu của ai thì chỉ người đó được phép xem và chỉnh sửa (Bảo mật tài nguyên qua các Requests và Middleware).

## 5) Thiết lập môi trường chạy local

1. **Clone dự án về máy:**

    ```bash
    git clone https://github.com/Ngoc-rizz/countdown.git
    cd countdown
    ```

2. **Cài đặt các thư viện PHP:**

    ```bash
    composer install
    ```

3. **Cài đặt các thư viện Frontend:**

    ```bash
    yarn install
    ```

4. **Cấu hình môi trường:**
   Sao chép file cấu hình mẫu và tạo khóa bảo mật cho ứng dụng:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Thiết lập cơ sở dữ liệu:**
   Tạo database với tên `countdown` trong MySQL, sau đó chạy lệnh để tạo cơ sở dữ liệu và bảng:

    ```bash
    php artisan migrate
    ```

6. **Chạy ứng dụng:**
   Khởi động máy chủ backend và bộ build frontend:

    ```bash
    # Terminal 1: Chạy Backend
    php artisan serve

    # Terminal 2: Chạy Frontend Vite
    yarn dev
    ```

    Sau đó truy cập vào: `http://localhost:8000`

## 6) Router

Hệ thống Router được phân bổ linh hoạt, kết hợp giữa `routes/web.php` và thư mục `Routes/` bên trong từng module cụ thể:

- Các route toàn cục hoặc route chung có thể nằm ở `routes/web.php`.
- Các route chuyên biệt (nghiệp vụ) được định nghĩa tại `modules/{ModuleName}/Routes/` (vd: `api.php`, `web.php`).
- Khai báo này giúp giảm tải cho file route chính của Laravel, chia để trị dễ bảo trì khi dự án lớn.

## 7) Modular

- Dự án áp dụng triệt để kiến trúc Modular (chia theo miền - Domain).
- Toàn bộ logic liên quan đến Auth, Pomodoro, Report, Settings, Task được đóng gói vào trong thư mục `modules/` riêng biệt.
- Mỗi module hoạt động gần như độc lập với Service Provider riêng của mình, giúp codebase tách bạch (Decoupled), dễ dàng phát triển song song trong team, dễ dàng test và nâng cấp tính năng.
