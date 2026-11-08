# API (draft) — Olahin

Status: **draft**. API dipakai jika butuh integrasi mobile (Flutter) / frontend terpisah. Untuk demo responsi web, CRUD Blade sudah cukup.

## Auth (Sanctum, rencana)
- `POST /api/login` — email/username + password → token
- `POST /api/register`
- `POST /api/logout` (auth)
- `GET /api/me` (auth)

Header auth: `Authorization: Bearer <token>`  
Response: JSON, gunakan status code standar (`200/201/422/401/404`).

## Contoh resource (pola)
| Method | URL | Fungsi |
|---|---|---|
| GET | `/api/stok` | list stok user |
| POST | `/api/stok` | tambah stok |
| GET | `/api/stok/{id}` | detail |
| PUT/PATCH | `/api/stok/{id}` | update |
| DELETE | `/api/stok/{id}` | hapus |

Terapkan pola sama untuk: `master-bahan` (admin), `resep`, `kebutuhan-bahan`, `daftar-belanja`, `anggaran`, `weekly-grocery`.

## AI (fase 2 / stub)
- `POST /api/ai/rekomendasi` — input: daftar stok/konteks user; output: rekomendasi resep (rule-based dulu). Lihat `docs/ai-feature.md`.

## Error validasi (contoh)
```json
{ "message": "The given data was invalid.", "errors": { "field": ["..."] } }
```
