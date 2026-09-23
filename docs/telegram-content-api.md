# Internal Telegram Content API

Dokumentasi endpoint internal untuk keperluan integrasi dengan Telegram Bot di masa depan.
API ini diproteksi oleh Bearer Token statis dan dilimitasi (Rate Limiting).

## Base URL
`/api/internal/articles`

## Headers Required
Semua endpoint membutuhkan header ini:
```
Authorization: Bearer YOUR_CONTENT_BOT_TOKEN
Accept: application/json
```
> Token ini dikonfigurasi melalui environment variable `CONTENT_BOT_TOKEN`. Jangan sebarkan token ini.

---

## Endpoints

### 1. Create Article
Membuat artikel baru dari bot.

- **Method**: `POST`
- **URL**: `/api/internal/articles`
- **Payload** (JSON):
```json
{
  "title": "Judul Artikel dari Bot",
  "excerpt": "Ringkasan artikel...",
  "content": "<p>Isi artikel yang panjang...</p>",
  "category": "Skripsi",
  "tags": ["skripsi", "jaukitugas"],
  "seo_title": "Judul Artikel dari Bot",
  "seo_description": "Ringkasan artikel...",
  "status": "draft"
}
```
*Catatan: Anda juga bisa menggunakan `multipart/form-data` jika ingin menyertakan file pada field `featured_image`.*

**Success Response (201 Created):**
```json
{
  "success": true,
  "message": "Article created successfully",
  "data": {
    "id": 12,
    "title": "Judul Artikel dari Bot",
    "slug": "judul-artikel-dari-bot",
    "status": "draft",
    "source": "telegram",
    "url": "https://jaukitugas.my.id/artikel/judul-artikel-dari-bot"
  }
}
```

### 2. Get Article Detail
Mendapatkan detail artikel.

- **Method**: `GET`
- **URL**: `/api/internal/articles/{id}`

**Success Response (200 OK):**
```json
{
  "success": true,
  "message": "Article retrieved successfully",
  "data": {
    "id": 12,
    "title": "Judul Artikel dari Bot",
    "slug": "judul-artikel-dari-bot",
    "excerpt": "Ringkasan artikel...",
    "content": "<p>Isi artikel yang panjang...</p>",
    "category": "Skripsi",
    "tags": ["skripsi", "jaukitugas"],
    "status": "draft",
    "source": "telegram",
    "featured_image": null,
    "seo_title": "Judul Artikel dari Bot",
    "seo_description": "Ringkasan artikel...",
    "published_at": null,
    "scheduled_at": null,
    "url": "https://jaukitugas.my.id/artikel/judul-artikel-dari-bot"
  }
}
```

### 3. Update Article
Memperbarui artikel. Hanya update field yang dikirim.

- **Method**: `PUT`
- **URL**: `/api/internal/articles/{id}`
- **Payload** (JSON):
```json
{
  "title": "Judul Update",
  "status": "review"
}
```

### 4. Publish Article
Mempublish artikel secara langsung (status menjadi `published`).

- **Method**: `POST`
- **URL**: `/api/internal/articles/{id}/publish`

### 5. Schedule Article
Menjadwalkan publikasi artikel di masa depan (status menjadi `scheduled`).

- **Method**: `POST`
- **URL**: `/api/internal/articles/{id}/schedule`
- **Payload** (JSON):
```json
{
  "scheduled_at": "2026-10-01 10:00:00"
}
```

---

## Error Handling

**Unauthorized (401)**
```json
{
  "success": false,
  "message": "Unauthorized"
}
```

**Validation Error (422)**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "title": ["The title field is required."]
  }
}
```

**Not Found (404)**
```json
{
  "success": false,
  "message": "Article not found"
}
```
