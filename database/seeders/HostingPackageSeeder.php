<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HostingPackage;

class HostingPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Başlangıç',
                'slug' => 'baslangic',
                'price' => 49.99,
                'storage' => '10 GB NVMe Disk',
                'bandwidth' => 'Sınırsız Trafik',
                'features' => ['1 Adet Web Sitesi', 'Ücretsiz SSL Sertifikası', 'Haftalık Yedekleme', 'Standart Destek'],
                'is_popular' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Pro (Önerilen)',
                'slug' => 'pro',
                'price' => 89.99,
                'storage' => '50 GB NVMe Disk',
                'bandwidth' => 'Sınırsız Trafik',
                'features' => ['5 Adet Web Sitesi', 'Ücretsiz SSL Sertifikası', 'Günlük Yedekleme', 'Öncelikli Destek', 'Litespeed Cache'],
                'is_popular' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Kurumsal',
                'slug' => 'kurumsal',
                'price' => 149.99,
                'storage' => 'Sınırsız NVMe Disk',
                'bandwidth' => 'Sınırsız Trafik',
                'features' => ['Sınırsız Web Sitesi', 'Ücretsiz SSL Sertifikası', 'Günlük Yedekleme', '7/24 Telefon Desteği', 'Özel IP Adresi'],
                'is_popular' => false,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            HostingPackage::create($package);
        }
    }
}
