
## Hướng dẫn cài đặt

Để cài đặt website làm theo các bước sau

```sh
cd <path of project>
```

Thêm `.env` sau đó sửa cấu hình kết nối

```sh
cp .env.example .env
```

Chạy `migrate` thêm bảng
```sh
php artisan migrate
```

Chạy `seed` thêm dữ liệu ảo
```sh
php artisan db:seed
```

Tạo `tài liệu API`
```sh
php artisan l5-swagger:generate
```

Khởi chạy dự án
```sh
php artisan serve
```

Để truy cập vào tài liệu API truy cập dường link sau [http://127.0.0.1:8000/api/v1](http://127.0.0.1:8000/api/v1)
