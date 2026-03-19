<div align="center">
  <h1>🚀 GDA (Global Dijital Altyapı) - Enterprise SaaS Platform</h1>
  <p>
    <strong>Domain, Hosting, Web Sitesi ve E-Ticaret altyapılarının tek merkezden yönetildiği, yüksek erişilebilirliğe (High Availability) sahip, çoklu kiracı (Multi-tenant) SaaS platformu.</strong>
  </p>

  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/Tailwind_CSS_v4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js" />
  <img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite" />
</div>

<br>

## 📌 Proje Vizyonu ve Mimari Yaklaşım
Bu proje, dijital varlık yönetimini otomatize etmek amacıyla **Servis Odaklı Mimari (Service-Based Architecture)** prensipleriyle geliştirilmiştir. Sadece bir arayüz sunmakla kalmaz; arka planda API sağlayıcılarını yöneten bir **Provisioning (Tedarik) Orkestrasyon Motoru** barındırır. 

Geliştirme sürecinde *Solid Prensipleri*, *Eager Loading (N+1 problemini önleme)* ve *Asset Optimizasyonu* gibi modern yazılım mühendisliği standartları merkeze alınmıştır.

---

## 🏗️ Temel Sistem Özellikleri

### ⚙️ 1. Gelişmiş Orkestrasyon ve Fallback Motoru (Süper Admin)
Sistem, dışa bağımlılıkları (External APIs) güvenli bir şekilde yönetmek üzere tasarlanmıştır:
* **Akıllı Provider Yönetimi:** Domain, Hosting ve Cloud servisleri için birincil (Primary) ve ikincil (Fallback) API sağlayıcıları tanımlanabilir. Birincil sağlayıcıda hata (timeout/500) oluştuğunda sistem otomatik olarak ikincil sağlayıcıya geçer.
* **Otomatize Provisioning:** Ödeme onaylandığı anda; `Domain Kaydı -> Hosting Açılışı -> DB Oluşturma -> SSL Kurulumu` işlemleri asenkron ve sıralı olarak tetiklenir.
* **Merkezi Log ve Monitoring:** Tüm API istekleri, webhook'lar ve hata (retry) döngüleri gerçek zamanlı izlenebilir.

### 👥 2. Rol Bazlı Dinamik Yönlendirme ve Müşteri Paneli
Kullanıcı deneyimi (UX) sıfır gecikme üzerine kurgulanmıştır:
* **Tek Kapı (Single Entry):** Auth sistemi, giriş yapan kullanıcının rolünü (`is_admin`) analiz eder ve yetkisine göre Süper Admin veya Müşteri paneline (Dashboard) güvenli bir şekilde yönlendirir.
* **Self-Servis Hizmet Yönetimi:** Müşteriler; DNS yönetimi, paket yükseltme, tek tıkla website kurulumu (Site Builder) ve fatura takibi işlemlerini aracı olmadan yapabilir.
* **Güvenlik:** JWT tabanlı doğrulama, rate-limiting ve null-safe (`?->`) veri okuma mimarisi.

### ⚡ 3. Performans ve Frontend Optimizasyonu
* **Tailwind CSS v4 & Vite:** Development aşamasındaki ağır CDN bağımlılığı tamamen kaldırılarak, Tailwind sınıfları Vite üzerinden derlenmiş, anında yüklenen (milisaniyelik) saf bir `app.css` mimarisine geçilmiştir.
* **Alpine.js Entegrasyonu:** JQuery veya ağır framework'ler yerine, HTML DOM üzerine yerleştirilmiş hafif state yönetimi (Alpine.js) ile Drawer (Sidebar) ve Modal'lar optimize edilmiştir.

---

## 💻 Teknoloji Yığını (Tech Stack)

| Kategori | Teknoloji | Neden Kullanıldı? |
| :--- | :--- | :--- |
| **Backend** | `Laravel (PHP 8.2+)` | Güçlü ORM (Eloquent), Routing, Queue mimarisi ve güvenlik altyapısı için. |
| **Frontend** | `Tailwind CSS v4`, `Blade` | Hızlı ve responsive UI geliştirme, derlenmiş mikro CSS çıktısı için. |
| **Reactivity** | `Alpine.js` | JSDOM manipülasyonları ve component state yönetimi (hafif ağırlık) için. |
| **Build Tool** | `Vite` | Işık hızında Hot Module Replacement (HMR) ve asset bundling için. |
| **Database** | `SQLite` / `MySQL` | Hızlı geliştirme ortamı ve canlı yayın uyumluluğu için. |

---

## 🚀 Yerel Kurulum (Geliştirme Ortamı)

Projeyi kendi bilgisayarınızda çalıştırmak için aşağıdaki adımları sırasıyla uygulayabilirsiniz:

```bash
# 1. Repoyu klonlayın
git clone [https://github.com/KULLANICI_ADIN/global-dijital-altyapi.git](https://github.com/KULLANICI_ADIN/global-dijital-altyapi.git)
cd global-dijital-altyapi

# 2. PHP bağımlılıklarını (Vendor) yükleyin
composer install

# 3. Ortam değişkenlerini ayarlayın
cp .env.example .env
php artisan key:generate

# 4. Veritabanı tablolarını oluşturun
php artisan migrate

# 5. Frontend bağımlılıklarını (Node_modules) yükleyin ve Vite ile derleyin
npm install
npm run build

# 6. Sunucuyu başlatın
php artisan serve
