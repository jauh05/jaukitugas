@extends('dashboard')

@section('tabel')
<div class="glass-card mb-4 bg-white bg-opacity-50 mt-5 p-4 rounded-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold m-0 text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Artikel</h4>
            <small class="text-muted">Perbarui konten artikel</small>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="alert alert-danger rounded-4">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Artikel *</label>
                            <input type="text" name="title" class="form-control py-2 rounded-3" value="{{ old('title', $article->title) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Artikel *</label>
                            <textarea name="content" id="editor" class="form-control" rows="15">{{ old('content', $article->content) }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kutipan (Excerpt)</label>
                            <textarea name="excerpt" class="form-control rounded-3" rows="3">{{ old('excerpt', $article->excerpt) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h6 class="fw-bold mb-0"><i class="bi bi-search me-2"></i>Pengaturan SEO</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label">SEO Title</label>
                            <input type="text" name="seo_title" class="form-control py-2 rounded-3" value="{{ old('seo_title', $article->seo_title) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SEO Description</label>
                            <textarea name="seo_description" class="form-control rounded-3" rows="2">{{ old('seo_description', $article->seo_description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control py-2 rounded-3" value="{{ old('slug', $article->slug) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2">Publikasi</h6>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small">Status</label>
                            <select name="status" class="form-select py-2 rounded-3" id="statusSelect">
                                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="scheduled" {{ old('status', $article->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>

                        <div class="mb-3" id="scheduledDateField" style="display: none;">
                            <label class="form-label text-muted small">Tanggal Jadwal</label>
                            <input type="datetime-local" name="scheduled_at" class="form-control py-2 rounded-3" value="{{ old('scheduled_at', $article->scheduled_at ? $article->scheduled_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <div class="mb-4" id="publishedDateField">
                            <label class="form-label text-muted small">Tanggal Publish</label>
                            <input type="datetime-local" name="published_at" class="form-control py-2 rounded-3" value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold text-white shadow-sm" style="background: linear-gradient(45deg, #4834d4, #686de0); border: none;">
                            <i class="bi bi-save me-2"></i> Perbarui Artikel
                        </button>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2">Kategori & Tags</h6>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small">Kategori</label>
                            <input type="text" name="category" class="form-control py-2 rounded-3" value="{{ old('category', $article->category) }}" list="categoryList">
                            <datalist id="categoryList">
                                <option value="Skripsi">
                                <option value="Penelitian">
                                <option value="Statistik">
                                <option value="SPSS">
                                <option value="Python">
                                <option value="Website">
                                <option value="Tips Kuliah">
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted small">Tags (Pisahkan dengan koma)</label>
                            <input type="text" name="tags" class="form-control py-2 rounded-3" value="{{ old('tags', is_array($article->tags) ? implode(', ', $article->tags) : '') }}">
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2">Featured Image</h6>
                        <div class="mb-3">
                            <input class="form-control py-2 rounded-3" type="file" name="featured_image" id="imageInput" accept="image/*">
                        </div>
                        <div class="rounded-3 overflow-hidden bg-light d-flex align-items-center justify-content-center" style="height: 200px;" id="imagePreviewContainer">
                            @if($article->featured_image)
                                <img id="imagePreview" src="{{ Storage::url($article->featured_image) }}" alt="Preview" class="w-100 h-100 object-fit-cover">
                                <i class="bi bi-image text-muted fs-1" id="imageIcon" style="display: none;"></i>
                            @else
                                <img id="imagePreview" src="#" alt="Preview" class="w-100 h-100 object-fit-cover" style="display: none;">
                                <i class="bi bi-image text-muted fs-1" id="imageIcon"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        height: 500,
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons',
        menubar: 'file edit view insert format tools table help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });

    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
                document.getElementById('imageIcon').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    const statusSelect = document.getElementById('statusSelect');
    const scheduledDateField = document.getElementById('scheduledDateField');
    const publishedDateField = document.getElementById('publishedDateField');

    function toggleDateFields() {
        if (statusSelect.value === 'scheduled') {
            scheduledDateField.style.display = 'block';
            publishedDateField.style.display = 'none';
        } else {
            scheduledDateField.style.display = 'none';
            publishedDateField.style.display = 'block';
        }
    }

    statusSelect.addEventListener('change', toggleDateFields);
    toggleDateFields();
</script>
@endsection
