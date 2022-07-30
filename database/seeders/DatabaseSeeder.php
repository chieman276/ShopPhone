<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->importCategories();
        $this->importRoles();
        $this->importUserGroups();
        $this->importUsers();
        $this->importProducts();
        $this->importUserGroupRoles();
        $this->importCustomers();
    }
    public function importCategories()
    {

        $product_category = new Category();
        $product_category->name = 'OPPO';
        $product_category->save();
        $product_category = new Category();
        $product_category->name = 'Apple';
        $product_category->save();
        $product_category = new Category();
        $product_category->name = 'Realme';
        $product_category->save();
    }

    public function importRoles()
    {
        $groups     = ['Category', 'Product', 'Customer', 'User', 'UserGroup',];
        $actions    = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('roles')->insert([
                    'group_name' => $group,
                    'name' => $group . '_' . $action,

                ]);
            }
        }
    }

    public function importUserGroups()
    {
        $userGroup = new UserGroup();
        $userGroup->name = 'Giám Đốc';
        $userGroup->save();

        $userGroup = new UserGroup();
        $userGroup->name = 'Nhân Viên';
        $userGroup->save();
    }

    public function importUsers()
    {
        $user = new User();
        $user->name = 'Mai Chiếm An';
        $user->email = 'an@gmail.com';
        $user->password = Hash::make('123456');
        $user->birthday = '2003/06/27';
        $user->phone = '0916663237';
        $user->user_group_id  = 1;
        $user->save();
        $user = new User();
        $user->name = 'Võ Văn Tuấn';
        $user->email = 'tuan@gmail.com';
        $user->password = Hash::make('123456');
        $user->birthday = '2002/04/22';
        $user->phone = '0777333274';
        $user->user_group_id  = 2;
        $user->save();
        $user = new User();
        $user->name = 'Nguyễn Văn Quốc Việt';
        $user->email = 'viet@gmail.com';
        $user->password = Hash::make('123456');
        $user->birthday = '2001/02/14';
        $user->phone = '0123456789';
        $user->user_group_id  = 2;
        $user->save();

    }
    public function importProducts()
    {
        $product = new Product();
        $product->name = 'Iphone 12 ProMax';
        $product->description = 'Mua Điện thoại di động Apple iPhone 12 Pro Max - 128GB - Chính hãng VN/A Giá Rẻ, Nhiều Ưu Đãi Tại Hoàng Hà Mobile. Free Ship Toàn Quốc.';
        $product->image = 'https://www.xtmobile.vn/vnt_upload/product/09_2019/thumbs/600_iphone_11_pro_den_xtmobile.jpg';
        $product->price = 28000000;
        $product->category_id = 2;
        $product->save();

        $product = new Product();
        $product->name = 'Iphone 12 ProMax';
        $product->description = 'Mua Điện thoại di động Apple iPhone 12 Pro Max - 128GB - Chính hãng VN/A Giá Rẻ, Nhiều Ưu Đãi Tại Hoàng Hà Mobile. Free Ship Toàn Quốc.';
        $product->image = 'https://cdn.hoanghamobile.com/i/preview/Uploads/2020/11/06/iphone-12-pro-max-4.png';
        $product->price = 24000000;
        $product->category_id = 2;
        $product->save();

        $product = new Product();
        $product->name = 'Iphone 12 ProMax';
        $product->description = 'Mua Điện thoại di động Apple iPhone 12 Pro Max - 128GB - Chính hãng VN/A Giá Rẻ, Nhiều Ưu Đãi Tại Hoàng Hà Mobile. Free Ship Toàn Quốc.';
        $product->image = 'https://cdn.hoanghamobile.com/i/preview/Uploads/2020/11/06/iphone-12-pro-max-4.png';
        $product->price = 26000000;
        $product->category_id = 2;
        $product->save();

        $product = new Product();
        $product->name = 'Iphone 12 ProMax';
        $product->description = 'Mua Điện thoại di động Apple iPhone 12 Pro Max - 128GB - Chính hãng VN/A Giá Rẻ, Nhiều Ưu Đãi Tại Hoàng Hà Mobile. Free Ship Toàn Quốc.';
        $product->image = 'https://keniphone.com/upload/sanpham/12prm-xanh-8932.png';
        $product->price = 27000000;
        $product->category_id = 2;
        $product->save();


        
        $product = new Product();
        $product->name = 'OPPO Reno6 Pro';
        $product->description = 'Buy OPPO Reno6 Pro - OPPO Store (Malaysia)';
        $product->image = 'https://htsg-store-gl.heytapimg.com/ebp/202108/11/1-M00-00-3C-CgGRkWETmsuAJ9buAACooRGkyIg493_1080_960.jpg';
        $product->price = 23990000;
        $product->category_id = 1;
        $product->save();

        $product = new Product();
        $product->name = 'OPPO Reno6 Pro';
        $product->description = 'Buy OPPO Reno6 Pro - OPPO Store (Malaysia)';
        $product->image = 'http://p-vn.ipricegroup.com/uploaded_10683a3d472578978e1b62da8f77ee2a.jpg';
        $product->price = 23990000;
        $product->category_id = 1;
        $product->save();

        $product = new Product();
        $product->name = 'OPPO Reno6 Pro';
        $product->description = 'Buy OPPO Reno6 Pro - OPPO Store (Malaysia)';
        $product->image = 'https://fptshop.com.vn/Uploads/Originals/2021/12/1/637739831332038316_oppo-find-x3-pro-dd.jpg';
        $product->price = 23990000;
        $product->category_id = 1;
        $product->save();

        $product = new Product();
        $product->name = 'OPPO Reno6 Pro';
        $product->description = 'Buy OPPO Reno6 Pro - OPPO Store (Malaysia)';
        $product->image = 'https://htsg-store-gl.heytapimg.com/ebp/202108/11/1-M00-00-3C-CgGRkWETmsuAJ9buAACooRGkyIg493_1080_960.jpg';
        $product->price = 23990000;
        $product->category_id = 1;
        $product->save();

        $product = new Product();
        $product->name = 'OPPO Reno6 Pro';
        $product->description = 'Buy OPPO Reno6 Pro - OPPO Store (Malaysia)';
        $product->image = 'https://fptshop.com.vn/Uploads/Originals/2021/11/24/637733878566651810_oppo-a16k-dd.jpg';
        $product->price = 23990000;
        $product->category_id = 1;
        $product->save();

        $product = new Product();
        $product->name = 'OPPO Reno6 Pro';
        $product->description = 'Buy OPPO Reno6 Pro - OPPO Store (Malaysia)';
        $product->image = 'https://toanmobile.vn/userdata/8264/wp-content/uploads/2021/10/oppo-reno5-trang-600x600-1-600x600.jpeg';
        $product->price = 23990000;
        $product->category_id = 1;
        $product->save();


        $product = new Product();
        $product->name = 'Realme C3i 2GB/32GB Xanh';
        $product->description = 'Điện máy HC-Điện thoại Realme C3i 2GB/32GB Xanh giá rẻ, chính hãng, trả góp 0% - Siêu thị điện máy HC';
        $product->image = 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/r/e/realme-8-1_1.jpg';
        $product->price = 19900000;
        $product->category_id = 3;
        $product->save();

        $product = new Product();
        $product->name = 'Realme C3i 2GB/32GB Xanh';
        $product->description = 'Điện máy HC-Điện thoại Realme C3i 2GB/32GB Xanh giá rẻ, chính hãng, trả góp 0% - Siêu thị điện máy HC';
        $product->image = 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/t/_/t_i_xu_ng_2__3_6.png';
        $product->price = 19900000;
        $product->category_id = 3;
        $product->save();

        $product = new Product();
        $product->name = 'Realme C3i 2GB/32GB Xanh';
        $product->description = 'Điện máy HC-Điện thoại Realme C3i 2GB/32GB Xanh giá rẻ, chính hãng, trả góp 0% - Siêu thị điện máy HC';
        $product->image = 'https://cdn2.cellphones.com.vn/358x/media/catalog/product/r/e/realme-8-5g-blue-1-600x600_1.jpg';
        $product->price = 19900000;
        $product->category_id = 3;
        $product->save();

        $product = new Product();
        $product->name = 'Realme C3i 2GB/32GB Xanh';
        $product->description = 'Điện máy HC-Điện thoại Realme C3i 2GB/32GB Xanh giá rẻ, chính hãng, trả góp 0% - Siêu thị điện máy HC';
        $product->image = 'https://dienthoaihay.vn/images/products/2021/10/20/large/q3s-thumb_1634692953.jpg';
        $product->price = 19900000;
        $product->category_id = 3;
        $product->save();

        $product = new Product();
        $product->name = 'Realme C3i 2GB/32GB Xanh';
        $product->description = 'Điện máy HC-Điện thoại Realme C3i 2GB/32GB Xanh giá rẻ, chính hãng, trả góp 0% - Siêu thị điện máy HC';
        $product->image = 'https://cdn1.viettelstore.vn/images/Product/ProductImage/medium/2060132887.png';
        $product->price = 19900000;
        $product->category_id = 3;
        $product->save();

    }
    public function importUserGroupRoles()
    {
        for ($i = 1; $i <= 35; $i++) {
            DB::table('user_group_roles')->insert([
                'user_group_id' => 1,
                'role_id' => $i,
            ]);
        }
    }
    public function importCustomers()
    {
        $Customer = new Customer();
        $Customer->name = 'NGUYEN THI HUYEN TRANG';
        $Customer->email = 'trang@gmail.com';
        $Customer->birthday = '1999/02/03';
        $Customer->phone = '0977983360';
        $Customer->password = '123456';
        $Customer->save();

        $Customer = new Customer();
        $Customer->name = 'Đàm Vĩnh Hưng';
        $Customer->email = 'hung@gmail.com';
        $Customer->birthday = '1987/03/23';
        $Customer->phone = '09777653360';
        $Customer->password = '123456';
        $Customer->save();

        $Customer = new Customer();
        $Customer->name = 'Nguyễn Phương Hằng';
        $Customer->email = 'hang@gmail.com';
        $Customer->birthday = '1972/12/03';
        $Customer->phone = '0345683360';
        $Customer->password = '123456';
        $Customer->save();

    }
}
