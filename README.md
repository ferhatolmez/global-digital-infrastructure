# Global Dijital Altyapı (GDA) Platformu 🚀

GDA, dijital varlıkların (Domain, Hosting, Web Sitesi, E-Ticaret) tek bir merkezden yönetilmesini sağlayan, çoklu kiracı (multi-tenant) mimarisine sahip modern bir SaaS platformudur. 

Bu proje; son kullanıcılar için pürüzsüz bir dijital hizmet deneyimi sunarken, arka planda gelişmiş bir orkestrasyon motoru ile API sağlayıcılarını, sunucu altyapılarını ve provisioning süreçlerini tam otomatik hale getirir.

## 🏗️ Mimari ve Teknoloji Yığını

Proje, yüksek erişilebilirlik (high availability) ve temiz kod (clean code) prensipleri göz önünde bulundurularak tasarlanmıştır.

* **Backend:** Laravel (PHP 8.2+)
* **Frontend:** Tailwind CSS v4, Alpine.js, Blade Templates
* **Asset Management:** Vite
* **Mimari Standartlar:** Multi-tenant altyapı, Service-based architecture
* **Güvenlik:** Rol bazlı erişim kontrolü (RBAC), Güvenli Oturum Yönetimi

## ✨ Temel Modüller ve Özellikler

Sistem, üç ana omurga üzerinde çalışır:

### 1. Süper Admin Paneli (Altyapı ve Orkestrasyon)
Tüm harici API sağlayıcılarını ve provisioning süreçlerini yöneten kontrol merkezidir.
* **Entegrasyon Merkezi:** Domain, Hosting, Cloud ve Ödeme API'lerinin tek merkezden yönetimi.
* **Fallback Mekanizması:** Birincil sağlayıcı arızalandığında otomatik olarak ikincil sağlayıcıya geçiş.
* **Provisioning Motoru:** Sipariş sonrası işlemleri sırayla işleyen arka plan orkestrasyon sistemi.
* **Merkezi Loglama:** Hata, webhook ve sistem durumu loglarının detaylı takibi.

### 2. Müşteri Paneli (Client Dashboard)
Kullanıcının satın aldığı tüm hizmetleri yönetmesini sağlayan, mobil uyumlu, hızlı ve modern arayüz.
* **Hizmet Yönetimi:** Domain DNS ayarları, yenileme işlemleri ve hosting kaynak takibi.
* **Website & E-Ticaret Sihirbazı:** Sürükle-bırak mantığıyla site kurma ve mağaza yönetimi.
* **Finans ve Destek:** Fatura yönetimi, sipariş takibi ve entegre ticket (destek) sistemi.

### 3. Public Web Sitesi (Global Satış Motoru)
Platformun global satışını gerçekleştiren, SEO ve hız odaklı ana sayfa yapısı.
* **Dinamik Fiyatlandırma:** Bölgeye ve kura göre anlık fiyat senkronizasyonu.
* **Hızlı Arama:** Dönüşüm odaklı, anında tepki veren domain sorgulama arayüzü.

## ⚙️ Kurulum ve Geliştirme Ortamı

Projeyi yerel ortamınızda çalıştırmak için aşağıdaki adımları izleyin:

```bash
# 1. Repoyu klonlayın
git clone [https://github.com/KULLANICI_ADIN/global-dijital-altyapi.git](https://github.com/KULLANICI_ADIN/global-dijital-altyapi.git)
cd global-dijital-altyapi

# 2. PHP bağımlılıklarını yükleyin
composer install

# 3. Ortam değişkenlerini ayarlayın
cp .env.example .env
php artisan key:generate

# 4. Veritabanını oluşturun ve migration'ları çalıştırın
php artisan migrate

# 5. Frontend bağımlılıklarını yükleyin ve Vite'ı çalıştırın
npm install
npm run build

# 6. Geliştirme sunucusunu başlatın
php artisan serve
