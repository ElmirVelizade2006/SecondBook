<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Existing seeders
            UserSeeder::class,
            RolePermissionSeeder::class,
            CategorySeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            BookSeeder::class,
            StoreSeeder::class,
            SellerBooksSeeder::class,
            SellerOrdersSeeder::class,
            RefundSeeder::class,

            // New seeders
            WishlistSeeder::class,
            ReviewSeeder::class,
            CouponSeeder::class,
            ShippingSeeder::class,
            FAQSeeder::class,
            BannerSeeder::class,
            BlogSeeder::class,
            NotificationSeeder::class,
            MessageSeeder::class,
            MessageReplySeeder::class,
            SellerApplicationSeeder::class,
            UserSettingSeeder::class,
            SettingSeeder::class,
        ]);
    }
}