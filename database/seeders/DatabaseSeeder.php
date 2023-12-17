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
            'name'=> 'Điều hòa',
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
                if ($category->name === 'Xe đạp') {
                    $product->images()->create([
                        'image_url'=>'https://bizweb.dktcdn.net/100/091/797/products/img-8390-9cb77712-1fc6-4e8c-b537-595f517bcdc5.jpg?v=1625383868547',
                ]);
                }elseif ($category->name === 'Xe máy'){
                    $product->images()->create([
                        'image_url'=>'https://imagev3.vietnamplus.vn/w1000/Uploaded/2023/mzdic/2023_02_21/SH350i2102.jpg.webp',
                    ]);
                }elseif ($category->name === 'Xe điện'){
                    $product->images()->create([
                        'image_url'=>'https://giantvietnam.vn/wp-content/uploads/2022/03/2021-ELEM-133DS-XE-DIEN-GIANT-new2-4.jpg',
                    ]);
                }elseif ($category->name === 'Phụ tùng'){
                    $product->images()->create([
                        'image_url'=>'https://cartop.vn/wp-content/uploads/2017/07/nhan-biet-phu-tung-o-to-chinh-hang.jpg',
                    ]);
                }elseif ($category->name === 'Tivi'){
                    $product->images()->create([
                        'image_url'=>'https://cdn11.dienmaycholon.vn/filewebdmclnew/public/userupload/files/news/tivi/tivi-xiaomi-a-l32m8p2sea.jpg',
                    ]);
                }elseif ($category->name === 'Tủ lạnh'){
                    $product->images()->create([
                        'image_url'=>'https://sanakyvietnam.net/wp-content/uploads/tu-lanh-sanaky-vh-209hyn-1.jpg',
                    ]);
                }elseif ($category->name === 'Máy giặt'){
                    $product->images()->create([
                        'image_url'=>'https://hangdienmaygiare.com/images/products/2023/03/19/large/may-giat-electrolux-inverter-10-kg-ewf1024d3wb-1_1679217981.jpg',
                    ]);
                }elseif ($category->name === 'Nóng lạnh'){
                    $product->images()->create([
                        'image_url'=>'https://dienlanhkimphu.com/wp-content/uploads/2018/09/K0YPfR.png',
                    ]);
                }elseif ($category->name === 'Điều hòa'){
                    $product->images()->create([
                        'image_url'=>'https://dienmaythienphu.vn/wp-content/uploads/2022/01/treotuong-2604-1622626429.jpg',
                    ]);
                }elseif ($category->name === 'Quạt'){
                    $product->images()->create([
                        'image_url'=>'https://kangaroo.vn/wp-content/uploads/Quat-sac-dien-kangaroo-kg735.jpg',
                    ]);
                }elseif ($category->name === 'Nồi cơm'){
                    $product->images()->create([
                        'image_url'=>'https://cdn.tgdd.vn/Products/Images/1922/247196/255126-600x600.jpg',
                    ]);
                }elseif ($category->name === 'Tủ'){
                    $product->images()->create([
                        'image_url'=>'https://file.hstatic.net/1000078439/file/23_3426f2407531418bb5a714b8207ae7c5.jpg',
                    ]);
                }elseif ($category->name === 'Giường'){
                    $product->images()->create([
                        'image_url'=>'https://thegioinem.com/upload/images/giuong-sat-kim-thanh-kts09-1547.jpg',
                    ]);
                }elseif ($category->name === 'Bàn'){
                    $product->images()->create([
                        'image_url'=>'https://bangtot.vn/wp-content/uploads/2019/01/ban-go-mam-non-hinh-chu-nhat-1.jpg',
                    ]);
                }elseif ($category->name === 'Ghế'){
                    $product->images()->create([
                        'image_url'=>'https://noithatthanhminh.com/wp-content/uploads/2020/08/bo-ban-ghe-eames-4-ghe-mau-trang-4.jpg',
                    ]);
                }elseif ($category->name === 'Giá'){
                    $product->images()->create([
                        'image_url'=>'https://www.homebase.vn/image/cache/catalog/product/ho/196319-700x802.jpg',
                    ]);
                }elseif ($category->name === 'Điện thoại'){
                    $product->images()->create([
                        'image_url'=>'https://cdn.tgdd.vn/ValueIcons/iphone.jpg',
                    ]);
                }elseif ($category->name === 'Máy tính'){
                    $product->images()->create([
                        'image_url'=>'https://cdn.tgdd.vn/Files/2022/08/12/1455692/co-nen-mua-may-tinh-de-ban-cu-khong-kinh-nghiem-c-15.jpg',
                    ]);
                }elseif ($category->name === 'Sách, tài liệu'){
                    $product->images()->create([
                        'image_url'=>'https://tiki.vn/blog/wp-content/uploads/2023/08/thumb-12.jpg',
                    ]);
                }elseif ($category->name === 'Máy tính'){
                    $product->images()->create([
                        'image_url'=>'https://vanphongphamlocphat.com/wp-content/uploads/2022/04/May-tinh-hoc-sinh-Casio-FX-580VN-X.jpg',
                    ]);
                }elseif ($category->name === 'Chó'){
                    $product->images()->create([
                        'image_url'=>'https://tapchithucung.vn/Uploads/images/nhung-giong-cho-it-bi-benh.jpg',
                    ]);
                }elseif ($category->name === 'Mèo'){
                    $product->images()->create([
                        'image_url'=>'https://cdn.tgdd.vn/Files/2021/04/22/1345443/dac-diem-nhan-dien-cach-nuoi-meo-anh-long-ngan-202104221529108326.jpg',
                    ]);
                }   
            }
        }
    }
}
