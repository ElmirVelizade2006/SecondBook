<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'user_registration_enabled',
                'group_name' => 'general',
                'value' => '1',
                'type' => 'boolean',
            ],
            [
                'key' => 'site_name',
                'group_name' => 'general',
                'value' => 'SecondBook',
                'type' => 'text',
            ],
            [
                'key' => 'site_description',
                'group_name' => 'general',
                'value' => 'A marketplace for buying and selling books.',
                'type' => 'text',
            ],
            [
                'key' => 'support_email',
                'group_name' => 'contact',
                'value' => 'support@secondbook.com',
                'type' => 'text',
            ],
            [
                'key' => 'support_phone',
                'group_name' => 'contact',
                'value' => '+994501234567',
                'type' => 'text',
            ],
            [
                'key' => 'support_address',
                'group_name' => 'contact',
                'value' => 'Baku, Azerbaijan',
                'type' => 'text',
            ],
            [
                'key' => 'country',
                'group_name' => 'localization',
                'value' => 'Azerbaijan',
                'type' => 'text',
            ],
            [
                'key' => 'city',
                'group_name' => 'localization',
                'value' => 'Baku',
                'type' => 'text',
            ],
            [
                'key' => 'currency',
                'group_name' => 'localization',
                'value' => 'AZN',
                'type' => 'text',
            ],
            [
                'key' => 'timezone',
                'group_name' => 'localization',
                'value' => 'Asia/Baku',
                'type' => 'text',
            ],
            [
                'key' => 'default_language',
                'group_name' => 'localization',
                'value' => 'en',
                'type' => 'text',
            ],
            [
                'key' => 'shipping_enabled',
                'group_name' => 'shipping',
                'value' => '1',
                'type' => 'boolean',
            ],
            [
                'key' => 'estimated_delivery_message',
                'group_name' => 'shipping',
                'value' => '3-5 business days',
                'type' => 'text',
            ],
            [
                'key' => 'maintenance_mode',
                'group_name' => 'general',
                'value' => '0',
                'type' => 'boolean',
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}