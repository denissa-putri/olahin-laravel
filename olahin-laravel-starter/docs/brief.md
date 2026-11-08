# Brief Proyek — Olahin (Laravel)

## Ringkasan
**Olahin** adalah aplikasi manajemen dapur: membantu pengguna mengelola stok bahan (termasuk kadaluarsa), menemukan/merencanakan resep, mengelola daftar belanja & anggaran belanja dapur.

## Target pengguna
Mahasiswa/anak kos/pengguna rumah tangga yang ingin mengurangi bahan terbuang, belanja lebih terencana, dan masak lebih efisien.

## Referensi
- Figma UX: https://www.figma.com/design/vUtCpoyNxyekblp21ILxE0/Olahin---UX?node-id=2-2
- ERD acuan: `olahin2` (phpMyAdmin, 11 tabel) — lihat `docs/erd-schema.md`
- Artefak lama: web HTML `TubesOlahin`, mobile Flutter `GDGoC-Olahin` (referensi fitur/alur)

## Scope MVP (target responsi Selasa)
**Masuk:**
- Auth: register, login, logout, profil dasar, role `admin|user`
- Master data (admin/seed): kategori bahan, master bahan
- CRUD Stok bahan user (`stok_user`): tambah/lihat/ubah/hapus, qty, tanggal kadaluarsa, filter expired/menipis
- CRUD Resep (`master_resep`, `kebutuhan_bahan_resep`): list/detail/tambah/ubah/hapus + bahan kebutuhan
- CRUD Belanja/Budget sederhana: `daftar_belanja` atau `anggaran_user`/`weekly_grocery` (minimal 1 alur CRUD penuh)
- Dashboard ringkas: ringkasan stok kadaluarsa/belanja/budget

**Keluar (non-MVP / fase 2):**
- Community posts, comments, challenge/gamifikasi
- Fitur AI/LLM (rekomendasi cerdas & tanya AI) — *boleh stub/rencana*, bukan prioritas responsi
- Upload audio catatan masak (MVP: teks saja bila modul catatan dikerjakan)
- Polish UI penuh sesuai Figma pixel-perfect

## Alur utama
1. User login → dashboard.
2. User kelola stok bahan + pantau kadaluarsa.
3. User lihat resep & bahan yang dibutuhkan; bahan kurang → daftar belanja.
4. User catat rencana/belanja/budget.
5. Admin kelola master kategori/bahan (dan konten opsional).

## Definisi selesai (per modul CRUD)
- Migration + Model + relasi dasar
- Validasi (FormRequest)
- Controller (web resource / API sesuai pembagian)
- Route terdaftar
- View sederhana atau response JSON (sesuai modul)
- Bisa demo: list, create, edit/update, delete.
