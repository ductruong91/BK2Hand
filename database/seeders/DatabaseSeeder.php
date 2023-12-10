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

        $largeCat1 = Category::create([
            'name' => 'Xe cộ',
            'thumbnail_url' => '/storage/xe-co.png',
        ]);
        $largeCat2 = Category::create([
            'name'=> 'Đồ điện lạnh',
            'thumbnail_url' => '/storage/do-dien-lanh.png',
        ]);
        $largeCat3 = Category::create([
            'name'=> 'Đồ nội thất',
            'thumbnail_url' => '/storage/do-noi-that.png',
        ]);
        $largeCat4 = Category::create([
            'name'=> 'Đồ điện tử',
            'thumbnail_url' => '/storage/do-dien-tu.png',
        ]);
        $largeCat5 = Category::create([
            'name' => 'Dụng cụ học tập',
            'thumbnail_url' => '/storage/dung-cu-hoc-tap.png',
        ]);
        $largeCat6 = Category::create([
            'name' => 'Thú cưng',
            'thumbnail_url' => '/storage/thu-cung.png',
        ]);
        $largeCat7 = Category::create([
            'name' => 'Quần áo',
            'thumbnail_url' => '/storage/quan-ao.png',
        ]);
        $largeCat8 = Category::create([
            'name' => 'Khác',
            'thumbnail_url' => '/storage/khac.png',
        ]);
        $largeCat1->subCategories()->create([
            'name' => 'Xe đạp',
        ]);
        $largeCat1->subCategories()->create([
            'name' => 'Xe máy',
        ]);
        $largeCat1->subCategories()->create([
            'name' => 'Xe điện',
        ]);
        $largeCat1->subCategories()->create([
            'name' => 'Phụ tùng',
        ]);
        $largeCat2->subCategories()->create([
            'name'=> 'Tivi',
        ]);
        $largeCat2->subCategories()->create([
            'name'=> 'Tủ lạnh',
        ]);
        $largeCat2->subCategories()->create([
            'name'=> 'Máy giặt',
        ]);
        $largeCat2->subCategories()->create([
            'name'=> 'Nóng lạnh',
        ]);
        $largeCat2->subCategories()->create([
            'name'=> 'Điều hoà',
        ]);
        $largeCat2->subCategories()->create([
            'name'=> 'Quạt',
        ]);
        $largeCat2->subCategories()->create([
            'name'=> 'Nồi cơm',
        ]);
        $largeCat3->subCategories()->create([
            'name'=> 'Tủ',
        ]);
        $largeCat3->subCategories()->create([
            'name'=> 'Giường',
        ]);
        $largeCat3->subCategories()->create([
            'name'=> 'Bàn',
        ]);
        $largeCat3->subCategories()->create([
            'name'=> 'Ghế',
        ]);
        $largeCat3->subCategories()->create([
            'name'=> 'Giá',
        ]);
        $largeCat4->subCategories()->create([
            'name'=> 'Điện thoại',
        ]);
        $largeCat4->subCategories()->create([
            'name'=> 'Máy tính',
        ]);
        $largeCat5->subCategories()->create([
            'name'=> 'Sách, tài liệu',
        ]);
        $largeCat5->subCategories()->create([
            'name'=> 'Máy tính',
        ]);
        $largeCat6->subCategories()->create([
            'name'=> 'Chó',
        ]);
        $largeCat6->subCategories()->create([
            'name'=> 'Mèo',
        ]);

        $subCategories = Category::whereNotNull('parent_id')->get();
        foreach ($subCategories as $category) {
            for ($i = 0; $i < 10; $i++) {
                $product = Product::factory()->create([
                    'name' => $category->name . " " . fake()->word,
                ]);
                $product->categories()->attach($category->category_id);
                $product->categories()->attach($category->parent->category_id);
            }
        }
    }
}
