# 🌐 Global Dijital Altyapı — Yeni Nesil Domain & Hosting Yönetim Platformu
[![Laravel](https://img.shields.io/badge/Laravel_13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com) 
[![Livewire](https://img.shields.io/badge/Livewire_3-4e56a6?style=for-the-badge&logo=laravel&logoColor=white)](https://livewire.laravel.com) 
[![Tailwind](https://img.shields.io/badge/Tailwind_v4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com) 
[![Reverb](https://img.shields.io/badge/Laravel_Reverb-000000?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/docs/reverb)<br>
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![Pest PHP](https://img.shields.io/badge/Pest_PHP-F42F4B?style=for-the-badge&logo=php&logoColor=white)](https://pestphp.com)
[![OpenAI](https://img.shields.io/badge/OpenAI_API-412991?style=for-the-badge&logo=openai&logoColor=white)](https://openai.com)
[![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)

Profesyonel, yüksek performanslı ve modern web standartlarına (SPA, AI, WebSockets) uygun alan adı tescil, hosting satışı ve müşteri hizmetleri yönetim platformu. 
Modern glassmorphic müşteri arayüzü ile güçlü yönetim paneli entegre çalışır.

---

## 🚀 Hızlı Başlangıç (Nasıl Çalıştırılır?)
Projeyi kendi ortamınızda anında test etmek için aşağıdaki adımları izleyebilirsiniz:

### 1. Kurulum ve Ortam Hazırlığı
Repoyu bilgisayarınıza çektikten sonra bağımlılıkları yükleyin ve veritabanını hazırlayın:
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

### 2. Geliştirici Sunucularını Başlatma
Projedeki tüm reaktif özellikleri (WebSockets, Vite, Queues) kullanabilmek için **3 farklı terminalde** şu komutları çalıştırın:
```bash
# Terminal 1: Backend
php artisan serve 

# Terminal 2: Frontend JIT Derleyicisi
npm run dev

# Terminal 3: Gerçek Zamanlı Bildirimler (Native WebSockets)
php artisan reverb:start
```

---

## ✨ Özellikler

### 👥 Müşteri Paneli (Client Web)
| Özellik | Açıklama |
| :--- | :--- |
| **Glassmorphic UI** | Apple tarzı yarı saydam bulanık tasarım ve modern Alpine.js animasyonları. |
| **Koyu Tema (Dark Mode)** | Tarayıcıda kalıcı, tek tıkla sayfa yenilenmeden çalışan Dark/Light switch. |
| **Tam SPA Domain Sorgulama** | Livewire 3 sayesinde sayfa yenilenmeden, anında iskelet (skeleton) yüklemeli alan adı arama motoru. |
| **Yapay Zeka (AI) Entegrasyonu** | Sektöre göre marka değeri yüksek, zekice üretilmiş premium domain (`.ai, .tech`) önerileri sunan OpenAI destekli modül. |
| **Gerçek Zamanlı Toast Bildirimler** | Arkaplan işlemleri bittiğinde sağ altta beliren dinamik, sesli Reverb bildirimleri. |

### ⚙️ Yönetim Paneli (Süper Admin)
| Özellik | Açıklama |
| :--- | :--- |
| **Merkezi Dashboard** | Sistemdeki kazanç, kayıtlı kullanıcı ve anlık hata(log) akışlarını izleme arayüzü. |
| **Dinamik Fiyat Senkronizasyonu** | Sistemdeki tüm TLD'ler (domain uzantıları) için alış, yenileme ve transfer fiyatlarını yönetme modülü. |
| **Müşteri & Bilet (Ticket) Yönetimi** | Satış kayıtlarını görüntüleme, kullanıcıları dondurma ve destek taleplerini anında yanıtlama. |

---

## 🏗️ Mimari ve Veri Akışı

| Yön | Teknoloji / Mantık | Durum |
| :--- | :--- | :--- |
| **Arama Motoru ↔ Backend** | Livewire 3 AJAX Component (JSON) | ✅ Aktif (SPA) |
| **Sepet Onayı ↔ Sunucu** | Laravel HTTP Form Request | ✅ Aktif |
| **Sunucu ↔ Kuyruk (Queue)** | Database Queue (`ProcessDomainRegistration`) | ✅ Aktif (Asenkron) |
| **Kuyruk ↔ Müşteri (Web)** | Laravel Reverb & Echo (WebSockets) | ✅ Aktif (Gerçek Zamanlı) |

---

## 📂 Proje Yapısı
```text
GlobalDijitalAltyapi/
├── app/
│   ├── Livewire/Client/      # SPA sayfa yenilemeyen izolasyonlu arayüz modülleri
│   ├── Services/AIService.php# OpenAI ve Heuristic Premium Domain Algoritmaları
│   ├── Jobs/                 # Arka planda çalışacak kuyruk görevleri (ProcessDomain)
│   └── Events/               # Reverb üzerinden fırlatılan WebSocket olayları
├── resources/
│   ├── css/app.css           # Tailwind v4 JIT Direktifleri
│   ├── views/client/         # Müşteri Blade & Livewire arayüzleri
│   └── views/admin/          # Yönetim Paneli arayüzleri
└── tests/Feature/            # Pest PHP altyapılı DatabaseTransactions test yığını
```

---

## 📦 Bağımlılıklar & Tech Stack

| Bileşen | Teknoloji | Versiyon |
| :--- | :--- | :--- |
| **Sunucu & Çekirdek** | Laravel Framework (PHP 8.4 hedefli) | `^13.0` |
| **Web UI Sınıfları** | Tailwind CSS | `v4.0` |
| **Web DOM Kontrolü** | Alpine.js | `v3.x` |
| **Etkileşim (Reaktif)**| Livewire | `^3.x / ^4.2` |
| **WebSockets (İletişim)** | Laravel Reverb & Laravel Echo | `Native` |
| **Yapay Zeka API** | openai-php/laravel | `^0.19.1` |
| **Test Ekosistemi** | Pest PHP | `^4.4` |

---

## 🔗 Temel API ve Route Haritası

| Endpoint | Metot | Açıklama |
| :--- | :--- | :--- |
| `/` | GET | Varsayılan karşılama / Login yönlendiricisi |
| `/login` & `/register` | GET/POST | Glassmorphic yetkilendirme giriş noktaları |
| `/client/dashboard` | GET | Müşterinin ilk karşılama sayfası |
| `/client/domain` | GET | **Livewire SPA** destekli AI domain sorgulama arayüzü |
| `/admin/dashboard` | GET | Etkileşimli Süper Admin görüntüleme platformu |

---

## 🔧 Teknik Detaylar & Güvenlik

**1. OpenAI Fallback (Hata Toleransı) Mimarisi**
Sistem yapay zekaya (OpenAI API) istek attığında; kotaların dolması, internet kesintisi veya SSL sertifikası eksikliğinde (`cURL error 60`) sistem asla **500 Server Error vermez**. Anında otonom algoritmik simülatör devreye girer ve lokalde premium uzantılara sahip mantıklı alan adları üreterek sistemi %100 ayakta tutar.

**2. Asenkron İşlemler (Queues)**
Domain kaydı veya sunucu provisioning (tedarik) işlemleri ödeme anında API beklemesi yüzünden kullanıcıyı dondurmaz. Olaylar `Database Queue` yapısına atılır ve arka planda işlendikten sonra kullanıcıya **Toast** bildirimi ile iletilir. *(Horizon Windows OS yetersizliği yüzünden devredışı bırakılmıştır.)*

**3. Test Mimarisi (Pest)**
Tüm güvenlik doğrulamaları ve Livewire senaryo testleri Pest PHP ile yazılmıştır. `DatabaseTransactions` Trait'i kullanılarak, test sırasında veritabanında geçici oluşturulan tüm sahte datalar (Mock users, vb.) test bittiğinde fiziksel DB'den otomatik silinir.

---

## 📄 Lisans
Bu proje özel bir kurumsal çözüm olup izinsiz çoğaltılamaz ve kaynak kodları kopyalanamaz (Closed Source).

**Geliştirici:** Ferhat Ölmez
