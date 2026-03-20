# 🌐 Global Dijital Altyapı - Domain & Hosting Yönetim Platformu

Global Dijital Altyapı, modern web standartlarında geliştirilmiş, yüksek performanslı ve kullanıcı dostu bir alan adı (domain) tescil, hosting satışı ve müşteri hizmetleri yönetim platformudur. En güncel Laravel ekosistemi kullanılarak tasarlanmış olup, hem müşterilere hem de sistem yöneticilerine "Premium" bir deneyim sunmayı hedefler.

## ✨ Öne Çıkan Özellikler

- **🔍 AI Destekli Akıllı Domain Arama:** Klasik alan adı sorgulamalarının ötesine geçerek, **OpenAI** entegrasyonu sayesinde aranan kelimeye ve sektöre özel, katma değeri yüksek premium domain önerileri (örn. `.ai`, `.io`, `.tech`) sunar.
- **⚡ Livewire SPA Deneyimi:** Domain sorgulama ekranı **Livewire 3** altyapısıyla çalışır. Sayfa yenilenmesine gerek kalmadan iskelet yükleme (Skeleton Loading) animasyonlarıyla saniyeler içinde anlık arama sonuçları listelenir.
- **🔔 Gerçek Zamanlı (Real-Time) Bildirimler:** **Laravel Reverb (Native WebSockets)** kullanılarak, arka plandaki işlemler (domain kayıt onayı vb.) tamamlandığında ekranın köşesinde anında dinamik Toast bildirimleri belirir.
- **🎨 Glassmorphism & Koyu Tema (Dark Mode):** Tasarım dili **Tailwind CSS v4** ile harmanlanmış olup Apple tarzı (Glass) arayüzler içerir. Alpine.js destekli, kullanıcı tercihini tarayıcıda saklayan tam donanımlı Koyu Tema özelliği bulunmaktadır.
- **🚀 Arka Plan Görevleri (Queues):** Uzun süren API yanıtları, domain tescili ve sipariş süreçleri Database Queues kullanılarak arka plana alınır ve kullanıcı asla bekletilmez.
- **⚙️ Gelişmiş Admin Paneli:** Şık bir yönetim paneli ile kullanıcıları, siparişleri, destek biletlerini (tickets) ve dinamik olarak domain uzantı fiyatlarını yönetme imkanı sunar.

---

## 🛠 Kullanılan Teknolojiler (Tech Stack)

*   **Backend:** Laravel 13 Framework (PHP 8.3 / 8.4 uyumlu), SQLite / MySQL
*   **Frontend:** Tailwind CSS v4, Alpine.js, Blade Component Mimarisi
*   **Etkileşim (Reaktif Modüller):** Laravel Livewire 3
*   **WebSockets:** Laravel Reverb & Laravel Echo
*   **Test Altyapısı:** Pest PHP Testing Framework & DatabaseTransactions

---

## 🚀 Kurulum Rehberi

Projeyi kendi sunucunuzda veya yerel ortamınızda (Localhost) ayağa kaldırmak için aşağıdaki adımları sırasıyla uygulayın.

### 1. Sistem Gereksinimleri
- PHP 8.3 veya 8.4
- Node.js & NPM
- Composer

### 2. Projenin İndirilmesi ve Paketlerin Yüklenmesi
```bash
git clone https://github.com/kullaniciadi/global-dijital-altyapi.git
cd global-dijital-altyapi

# PHP ve Node bağımlılıklarını kurun
composer install
npm install
```

### 3. Ortam Konfigürasyonu
Projenin ana dizinindeki `.env.example` dosyasının adını `.env` olarak değiştirin ve uygulama anahtarını üretin:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Veritabanı ve Örnek Verilerin (Seed) Oluşturulması
```bash
php artisan migrate --seed
```
*Bu komut ile veritabanı tabloları kurulacak ve örnek yetkili admin hesapları ile sahte veriler (mock data) yüklenecektir.*

### 5. Yapay Zeka (AI) Kurulumu
Orijinal yapay zeka domain önerilerinin çalışması için `.env` dosyanıza kendi OpenAI anahtarınızı tanımlayın:
```env
OPENAI_API_KEY=sk-sizin-openai-api-anahtariniz
```
*(Eğer anahtar girilmezse sistem hata vermez, tamamen güvenli bir algoritmik simülasyon/hesaplama ile örnek domainler üretmeye devam eder.)*

---

## 💻 Uygulamayı Çalıştırma

Projenin tam kapasiteyle tüm modern özelliklerini (WebSockets, Queues, ve Vite derleyicisi) kullanabilmesi için ortamınızda **3 farklı terminal sekmesi** açarak aşağıdaki komutları çalıştırmanız gerekir:

1. **Ana Laravel Sunucusu (Backend):**
```bash
php artisan serve
```

2. **Tailwind ve Frontend Derleyicisi (Vite):**
```bash
npm run dev
```

3. **Gerçek Zamanlı Bildirimler (Laravel Reverb):**
```bash
php artisan reverb:start
```

*(Opsiyonel)* Eğer sepet işlemlerinde gecikmeli (asenkron) kuyrukları test edecekseniz 4. bir terminalde şu komutu çalıştırabilirsiniz:
```bash
php artisan queue:work
```

---

## 📝 Testleri Çalıştırma
Sistemdeki güvenlik ve iş mantığı testleri **Pest PHP** kullanılarak kodlanmıştır. Canlı veritabanınızı bozmadan (`DatabaseTransactions` mekanizması ile) testleri çalıştırmak için:
```bash
php artisan test
```

***
*Bu proje, yüksek trafikli modern bir hosting otomasyon firmasının ihtiyaçları göz önünde bulundurularak "Yenilikçi, Hızlı ve Premium" mottosuyla geliştirilmiştir.*
