# Rencana Fitur AI — Olahin (Fase 2)

**Status sekarang:** ditunda untuk responsi Selasa. Prioritas: CRUD + demo stabil.

## Tujuan AI
Membantu user mendapat saran resep/aksi berdasarkan stok bahan, bahan yang hampir kadaluarsa, dan kebutuhan bahan resep.

## Opsi implementasi

### Opsi A — MVP rule-based (paling aman, tanpa API eksternal)
- Input: `stok_user` milik user + `master_resep`/`kebutuhan_bahan_resep`.
- Logika: hitung kecocokan bahan stok vs kebutuhan resep; prioritaskan resep dengan kecocokan tertinggi & bahan yang mendekati `tanggal_kadaluarsa`.
- Output: daftar resep direkomendasikan + bahan kurang.
- Implementasi: `App\Services\RecipeRecommendationService` + endpoint/controller.
- Kelebihan: cepat, gratis, offline-ish, mudah didemo.

### Opsi B — LLM (fase lanjut)
- Endpoint: `POST /api/ai/saran-resep`
- Input: ringkasan stok, preferensi, batasan.
- Proses: Laravel HTTP client memanggil provider LLM (mis. Gemini/OpenAI) dengan API key dari `.env` (`AI_API_KEY=`).
- Wajib: jangan hardcode key; tangani timeout/error; sediakan fallback ke Opsi A.
- Catatan: butuh biaya/kuota & waktu tuning prompt.

## Kontrak API (draft)
`POST /api/ai/rekomendasi`
```json
{ "limit": 5, "prioritas_kadaluarsa": true }
```
Response:
```json
{ "data": [ { "id_resep": 1, "judul_resep": "...", "skor_kecocokan": 0.8, "bahan_kurang": [] } ] }
```

## Keamanan & privasi
- Jangan kirim data sensitif berlebihan ke LLM.
- Simpan `AI_API_KEY` hanya di `.env`/secret manager.
