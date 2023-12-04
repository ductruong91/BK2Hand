<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

use function Symfony\Component\String\b;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Peguin',
            'email' => 'penguin@gmail.com',
            'password' => bcrypt('123456'),
            'avatar' => 'https://cdn-icons-png.flaticon.com/512/4139/4139970.png',
            'phone' => '0123456789',
            'major' => 'Công nghệ thông tin Việt - Nhật',
            'role' => 0,
        ]);

        User::create([
            'name'=> 'Admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('123456'),
            'avatar' => 'https://cdn-icons-png.flaticon.com/512/4139/4139970.png',
            'phone' => '0123456789',
            'major' => 'Công nghệ thông tin Việt - Nhật',
            'role' => 1,
        ]);

        User::factory(10)->create();
        Product::factory(100)->create();

        $largeCat1 = Category::create([
            'name' => 'Xe cộ',
        ]);
        $largeCat2 = Category::create([
            'name'=> 'Đồ điện lạnh',
        ]);
        $largeCat3 = Category::create([
            'name'=> 'Đồ nội thất',
        ]);
        $largeCat4 = Category::create([
            'name'=> 'Đồ điện tử',
        ]);
        $largeCat5 = Category::create([
            'name' => 'Dụng cụ học tập',
        ]);
        $largeCat6 = Category::create([
            'name' => 'Thú cưng',
        ]);
        $largeCat7 = Category::create([
            'name' => 'Quần áo',
        ]);
        $largeCat8 = Category::create([
            'name' => 'Khác',
        ]);
        $largeCat1->childCategories()->create([
            'name' => 'Xe đạp',
        ]);
        $largeCat1->childCategories()->create([
            'name' => 'Xe máy',
        ]);
        $largeCat1->childCategories()->create([
            'name' => 'Xe điện',
        ]);
        $largeCat1->childCategories()->create([
            'name' => 'Phụ tùng',
        ]);
        $largeCat2->childCategories()->create([
            'name'=> 'Tivi',
        ]);
        $largeCat2->childCategories()->create([
            'name'=> 'Tủ lạnh',
        ]);
        $largeCat2->childCategories()->create([
            'name'=> 'Máy giặt',
        ]);
        $largeCat2->childCategories()->create([
            'name'=> 'Nóng lạnh',
        ]);
        $largeCat2->childCategories()->create([
            'name'=> 'Điều hoà',
        ]);
        $largeCat2->childCategories()->create([
            'name'=> 'Quạt',
        ]);
        $largeCat2->childCategories()->create([
            'name'=> 'Nồi cơm',
        ]);
        $largeCat3->childCategories()->create([
            'name'=> 'Tủ',
        ]);
        $largeCat3->childCategories()->create([
            'name'=> 'Giường',
        ]);
        $largeCat3->childCategories()->create([
            'name'=> 'Bàn',
        ]);
        $largeCat3->childCategories()->create([
            'name'=> 'Ghế',
        ]);
        $largeCat3->childCategories()->create([
            'name'=> 'Giá',
        ]);
        $largeCat4->childCategories()->create([
            'name'=> 'Điện thoại',
        ]);
        $largeCat4->childCategories()->create([
            'name'=> 'Máy tính',
        ]);
        $largeCat5->childCategories()->create([
            'name'=> 'Sách, tài liệu',
        ]);
        $largeCat5->childCategories()->create([
            'name'=> 'Máy tính',
        ]);
        $largeCat6->childCategories()->create([
            'name'=> 'Chó',
        ]);
        $largeCat6->childCategories()->create([
            'name'=> 'Mèo',
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
