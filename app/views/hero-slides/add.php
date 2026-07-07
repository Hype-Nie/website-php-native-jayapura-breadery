<?php ob_start(); ?>

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hero Slides /</span> Tambah</h4>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul class="mb-0">
            <?php foreach ($errors as $err): ?>
                <li><?= $err ?></li>
            <?php endforeach; ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card mb-4">
    <div class="card-body">
        <form action="<?= BASE_URL ?>heroslides/add" method="POST" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-md-8">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="cta_url">URL Tombol</label>
                            <input type="text" class="form-control" id="cta_url" name="cta_url" value="<?= htmlspecialchars($old['cta_url'] ?? '/catalog') ?>" />
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label" for="image">Gambar Slide (Wajib)</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*" required onchange="previewImage(this)">
                        <div class="form-text">Rekomendasi ukuran gambar: 1920x600 px (Landscape) maksimal 2MB.</div>
                        <div class="mt-3">
                            <img id="imagePreview" src="" alt="Preview" class="img-fluid rounded d-none" style="max-height: 200px; object-fit: cover; width: 100%;">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="sort_order">Urutan (Sort Order)</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="<?= htmlspecialchars($old['sort_order'] ?? '') ?>" placeholder="Otomatis jika dikosongkan" />
                    </div>

                    <div class="mb-3 form-check mt-4">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?= isset($old['is_active']) ? 'checked' : (empty($old) ? 'checked' : '') ?>>
                        <label class="form-check-label" for="is_active">Aktifkan Slide</label>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="<?= BASE_URL ?>heroslides" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    var preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.classList.add('d-none');
    }
}
</script>

<?php
$content = ob_get_clean();
include '../app/views/layouts/header.php';
?>
