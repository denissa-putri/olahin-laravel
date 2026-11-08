# Olahin (Laravel)

Aplikasi manajemen dapur/meal-planning (Olahin) — versi Laravel untuk tugas tim (3 orang), target demo responsi.

- **Figma (UX):** https://www.figma.com/design/vUtCpoyNxyekblp21ILxE0/Olahin---UX?node-id=2-2
- **Acuan DB:** ERD `olahin2` (phpMyAdmin) — disesuaikan ke migration Laravel/MySQL.

## Scope MVP (responsi)
Fokus: auth + CRUD inti + dashboard ringkas. **Tanpa** community/challenge. **AI** ditunda (fase 2) — rencanakan endpoint/service saja jika sempat.

## Stack
- Laravel (PHP), MySQL/MariaDB
- Auth web: Laravel Breeze (Blade)
- API (opsional/mobile): Laravel Sanctum

## Prasyarat
- PHP 8.2+ (Laragon/XAMPP)
- Composer
- MySQL/MariaDB
- Node.js + npm (untuk asset Breeze/Vite)
- Git

## Cara setup (lokal)
```bash
# 1) Clone repo
git clone <URL_REPO_GITHUB>
cd olahin-laravel

# 2) Install dependency PHP
composer install

# 3) Salin env dan generate key
cp .env.example .env
php artisan key:generate

# 4) Atur database di .env
# DB_DATABASE=olahin_laravel
# DB_USERNAME=root
# DB_PASSWORD=

# 5) Migrasi (+ seed jika ada)
php artisan migrate
# php artisan db:seed

# 6) Install dependency frontend & build
npm install
npm run build   # atau: npm run dev

# 7) Jalankan
php artisan serve
```
Buka: http://127.0.0.1:8000

## Akun demo
| Role | Email | Password |
|---|---|---|
| admin | admin@olahin.test | password |
| user | user@olahin.test | password |

*(Sesuaikan dengan seeder tim.)*

## Struktur dokumentasi
- `docs/brief.md` — brief proyek & scope
- `docs/erd-schema.md` — skema/ERD final
- `docs/pembagian-tugas.md` — pembagian 3 orang & branch
- `docs/api.md` — dokumentasi endpoint API
- `docs/ai-feature.md` — rencana AI (fase 2)
- `CHANGELOG.md` — perubahan penting
