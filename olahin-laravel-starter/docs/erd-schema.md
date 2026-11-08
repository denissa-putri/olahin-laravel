# Skema / ERD — Olahin (`olahin2` acuan)

Acuan: ERD phpMyAdmin database `olahin2` (screenshot tim). Implementasi target: **Laravel migration + Eloquent (MySQL)**.

## Tabel inti (MVP)
| Tabel | PK | Kolom penting | Relasi |
|---|---|---|---|
| `users` | `id_user` | username, password, email, kategori_mhs, foto_profil, deskripsi, hobi, role(`admin`,`user`) | 1-N ke stok, belanja, budget, resep, catatan, grocery |
| `master_kategori` | `id_kategori` | nama_kategori | 1-N ke `master_bahan` |
| `master_bahan` | `id_bahan` | id_kategori(FK), nama_bahan, satuan_terkecil, harga_estimasi | N-1 kategori; dipakai stok/kebutuhan/daftar belanja |
| `stok_user` | `id_stok` | id_user(FK), id_bahan, nama_bahan_custom, kategori_custom, kuantitas, tanggal_kadaluarsa | N-1 user; (opsional) N-1 master_bahan |
| `master_resep` | `id_resep` | id_user(FK), judul_resep, instruksi_masak, kesulitan(enum Mudah/Sedang/Sulit), porsi, waktu_memasak, gambar_url | N-1 user; 1-N kebutuhan bahan & catatan |
| `kebutuhan_bahan_resep` | `id_kebutuhan` | id_resep(FK), id_bahan(FK), jumlah_kebutuhan, satuan, nama_bahan_custom | N-1 resep; N-1 bahan |
| `daftar_belanja` | `id_belanja` | id_user(FK), id_bahan(FK), jumlah_kurang, status_beli(tinyint/bool) | N-1 user/bahan |
| `weekly_grocery` | `id_grocery` | id_user(FK), nama_barang, kuantitas, harga, kategori, hari, minggu_ke, bulan_tahun | N-1 user |
| `anggaran_user` | `id_anggaran` | id_user(FK), target_bulanan, total_pengeluaran_aktual, minggu_ke, bulan_tahun, kategori_terbanyak | N-1 user |
| `catatan_masak` | `id_catatan` | id_user(FK), id_resep(FK), teks_catatan, file_audio | N-1 user & resep *(MVP: teks dulu)* |

## Opsional (fase 2 / sesuai waktu)
| Tabel | Catatan |
|---|---|
| `berita_trending` | id_berita, judul, gambar_url, link_tujuan, views — konten dashboard, bisa seed/manual |

## Dikeluarkan dari scope
- `community_posts`, `post_comments`, `challenges` (tidak dipakai untuk responsi ini).

## Catatan implementasi
- Semua tabel yang dimiliki user **wajib** filter `id_user`/`user_id` saat CRUD (kecuali admin).
- `tinyint(1)` → cast `boolean` di Eloquent (`status_beli`).
- `enum` kesulitan → validasi `in:Mudah,Sedang,Sulit`.
- Tanggal: `tanggal_kadaluarsa` cast `date`.
- `kuantitas`/angka yang akan dihitung sebaiknya konsisten (decimal/integer) — jika skema lama `varchar`, sepakati konversi di migration.
- Jangan ubah struktur langsung di phpMyAdmin setelah Laravel jalan; pakai migration.
