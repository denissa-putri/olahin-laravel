# Pembagian Tugas — Olahin Laravel (3 Orang)

**Repo:** `<isi URL GitHub>`  
**Figma:** https://www.figma.com/design/vUtCpoyNxyekblp21ILxE0/Olahin---UX?node-id=2-2  
**Target demo:** Responsi Selasa (fokus CRUD jalan + bisa ditunjukkan)

## Aturan kerja
- Kerja di **branch** masing-masing, jangan langsung push ke `main`.
- 1 modul = 1 owner file (Controller/Model/Request/Migration/View/Route modul itu). Koordinasi dulu kalau perlu ubah file bersama (`routes/web.php`, layout, migration dependency).
- Commit kecil & jelas: `feat: ...`, `fix: ...`
- Setiap modul minimal bisa demo: **list, create, edit/update, delete** + validasi dasar.

## Fondasi (Ketua, sebelum/saat split)
- [ ] Buat repo GitHub + undang kolaborator
- [ ] Setup Laravel, `.env.example`, Breeze auth, koneksi DB
- [ ] Baseline migration dari ERD `olahin2` (tanpa community/challenge) / schema dump
- [ ] Layout dashboard sederhana + menu modul
- [ ] Merge fondasi ke `main`, anggota pull terbaru lalu buat branch

## Pembagian modul

| Orang | Branch | Modul | Tabel/fitur | Checklist demo |
|---|---|---|---|---|
| **1 (Ketua)** | `feat/master-inventory` | Auth/User, Master Data, Inventory | `users/profile`, `master_kategori`, `master_bahan`, `stok_user` | login; CRUD kategori & bahan; CRUD stok; tampilkan stok kadaluarsa/menipis |
| **2** | `feat/recipe` | Resep | `master_resep`, `kebutuhan_bahan_resep`, `catatan_masak` (teks MVP) | CRUD resep + bahan kebutuhan; detail resep; (opsional) catatan masak teks |
| **3** | `feat/shopping-budget` | Belanja, Budget, Dashboard | `daftar_belanja`, `weekly_grocery`, `anggaran_user` | CRUD daftar belanja/weekly grocery; CRUD/ringkasan anggaran; widget dashboard (angka ringkas) |

> **AI ditunda (fase 2)** — jangan blokir CRUD. Jika ada waktu sisa, buat stub endpoint `GET/POST /api/ai/rekomendasi` (lihat `docs/ai-feature.md`).

## Kontrak bersama (sepakati awal)
- PK/FK mengikuti ERD (`id_user`, `id_bahan`, `id_resep`).
- Semua data user difilter per `auth()->id()` (kecuali admin).
- Route web: `Route::middleware('auth')->resource(...)` atau route eksplisit.
- Nama branch & PR: deskripsi singkat + cara test.

## Status
| Modul | PIC | Status | Catatan |
|---|---|---|---|
| Fondasi | Ketua | ⬜ |  |
| Master + Inventory | 1 | ⬜ |  |
| Recipe | 2 | ⬜ |  |
| Shopping + Budget + Dashboard | 3 | ⬜ |  |
