<?php 
/**
 * @var string $title
 * @var object $product
 * @var array|object $productImages
 * @var array $categories
 * @var array $errors
 */
ob_start(); 
?>

<div class="col-xxl-8">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><?= $title ?></h5>
            <a href="<?= BASE_URL ?>products" class="btn btn-outline-secondary btn-sm">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $err): ?>
                            <li><?= $err ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>products/edit/<?= $product->id ?>" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="barcode">Barcode</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" id="barcode" name="barcode"
                                value="<?= htmlspecialchars($product->barcode) ?>" required />
                            <button class="btn btn-outline-primary" id="btnCamera" type="button" title="Scan dengan Kamera">
                                <i class="bx bx-camera"></i>
                            </button>
                        </div>
                        <!-- Camera Scanner -->
                        <div id="cameraScanner" class="d-none mt-2">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-2">
                                    <small><i class="bx bx-camera me-1"></i> Scan Barcode dengan Kamera</small>
                                    <button class="btn btn-sm btn-outline-light" id="btnCloseCamera" type="button">
                                        <i class="bx bx-x"></i>
                                    </button>
                                </div>
                                <div class="card-body p-2">
                                    <div id="reader" style="width:100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="name">Nama Produk</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= htmlspecialchars($product->name) ?>" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="category_id">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($categories ?? [] as $cat): ?>
                                <option value="<?= $cat->id ?>"
                                    <?= (($product->category_id ?? '') == $cat->id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="description">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Deskripsi produk..."><?= htmlspecialchars($product->description ?? '') ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="price">Harga (Rp)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="price" name="price"
                            value="<?= (int)$product->price ?>" min="1" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="stock">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="stock" name="stock"
                            value="<?= (int)$product->stock ?>" min="0" required />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="images">Gambar</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple />
                        
                        <div id="imagePreviewContainer" class="mt-3 d-flex flex-wrap gap-3">
                            <?php if (!empty($productImages)): ?>
                                <?php foreach ($productImages as $img): ?>
                                    <div class="text-center p-2 border rounded <?= $img->is_primary ? 'border-primary bg-light' : '' ?>" style="width: 100px;">
                                        <img src="<?= BASE_URL ?>assets/img/products/<?= htmlspecialchars($img->image) ?>" 
                                             class="mb-2" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;" />
                                        <div class="form-check d-flex justify-content-center m-0 p-0">
                                            <input class="form-check-input m-0" style="cursor: pointer;" type="radio" name="primary_image" id="prim_<?= $img->id ?>" value="<?= htmlspecialchars($img->image) ?>" <?= $img->is_primary ? 'checked' : '' ?>>
                                            <label class="form-check-label ms-1 text-primary fw-bold radio-label" style="font-size: 0.75rem; cursor: pointer;" for="prim_<?= $img->id ?>">
                                                Utama
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php elseif (!empty($product->image)): ?>
                                <div class="text-center p-2 border rounded border-primary bg-light" style="width: 100px;">
                                    <img src="<?= BASE_URL ?>assets/img/products/<?= htmlspecialchars($product->image) ?>"
                                        class="mb-2" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;" />
                                    <div class="form-check d-flex justify-content-center m-0 p-0">
                                        <input class="form-check-input m-0" style="cursor: pointer;" type="radio" name="primary_image" id="prim_old" value="<?= htmlspecialchars($product->image) ?>" checked>
                                        <label class="form-check-label ms-1 text-primary fw-bold radio-label" style="font-size: 0.75rem; cursor: pointer;" for="prim_old">
                                            Utama
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <small class="text-muted d-block mt-2">Pilih foto utama di atas, atau upload gambar baru (bisa lebih dari satu) jika ingin mengganti galeri. Kosongkan upload jika hanya ingin mengganti foto utama.</small>
                        <?php if (empty($productImages) && empty($product->image)): ?>
                            <small class="text-muted d-block mt-1">Belum ada gambar utama. Anda bisa upload satu atau lebih gambar produk di sini.</small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Update
                        </button>
                        <a href="<?= BASE_URL ?>products" class="btn btn-outline-secondary ms-2">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageScripts = '
<style>
#barcode-scanner {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
    background: #000;
}
#barcode-scanner video {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}
#barcode-scanner canvas {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    z-index: 2 !important;
}
.scanner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    z-index: 1000;
}
/* Hide label if radio is not checked */
input[type="radio"][name="primary_image"] + label.radio-label {
    display: none !important;
}
input[type="radio"][name="primary_image"]:checked + label.radio-label {
    display: inline-block !important;
}

.scanner-frame {
    position: relative;
    width: 70%;
    height: 50%;
    border: 2px solid #dc3545;
    background: transparent;
    box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.5);
}
.scanner-frame .corner {
    position: absolute;
    width: 30px;
    height: 30px;
    border: 3px solid #dc3545;
}
.scanner-frame .corner.top-left {
    top: -2px;
    left: -2px;
    border-right: none;
    border-bottom: none;
}
.scanner-frame .corner.top-right {
    top: -2px;
    right: -2px;
    border-left: none;
    border-bottom: none;
}
.scanner-frame .corner.bottom-left {
    bottom: -2px;
    left: -2px;
    border-right: none;
    border-top: none;
}
.scanner-frame .corner.bottom-right {
    bottom: -2px;
    right: -2px;
    border-left: none;
    border-top: none;
}
.scanner-frame .scan-line {
    position: absolute;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #dc3545, transparent);
    animation: scan 2s linear infinite;
}
@keyframes scan {
    0% { top: 0; }
    50% { top: calc(100% - 2px); }
    100% { top: 0; }
}
</style>
<script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2@1.8.4/dist/quagga.min.js"></script>
<script src="' . BASE_URL . 'assets/js/product-barcode.js"></script>
<script>
document.getElementById(\'images\').addEventListener(\'change\', function(e) {
    const previewContainer = document.getElementById(\'imagePreviewContainer\');
    // Remove only newly added previews (keep the old images)
    const newPreviews = previewContainer.querySelectorAll(\'.new-preview\');
    newPreviews.forEach(el => el.remove());
    
    if (this.files) {
        Array.from(this.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrap = document.createElement(\'div\');
                imgWrap.className = \'new-preview text-center p-2 border rounded bg-light\';
                imgWrap.style.width = \'100px\';
                
                const img = document.createElement(\'img\');
                img.src = e.target.result;
                img.style.width = \'80px\';
                img.style.height = \'80px\';
                img.style.objectFit = \'cover\';
                img.style.borderRadius = \'8px\';
                img.className = \'mb-2\';
                
                const radioWrap = document.createElement(\'div\');
                radioWrap.className = \'form-check d-flex justify-content-center m-0 p-0\';
                radioWrap.innerHTML = `<input class="form-check-input m-0" style="cursor: pointer;" type="radio" name="primary_image" id="prim_new_${index}" value="__NEW_${index}__">
                                       <label class="form-check-label ms-1 text-primary fw-bold radio-label" style="font-size: 0.75rem; cursor: pointer;" for="prim_new_${index}">Utama</label>`;
                
                // Add event listener to update borders on click
                radioWrap.querySelector(\'input\').addEventListener(\'change\', updatePrimaryBorders);
                
                imgWrap.appendChild(img);
                imgWrap.appendChild(radioWrap);
                previewContainer.appendChild(imgWrap);
            }
            reader.readAsDataURL(file);
        });
    }
});

function updatePrimaryBorders() {
    document.querySelectorAll(\'#imagePreviewContainer > div\').forEach(div => {
        const radio = div.querySelector(\'input[type="radio"]\');
        if (radio && radio.checked) {
            div.classList.add(\'border-primary\', \'bg-light\');
        } else {
            div.classList.remove(\'border-primary\', \'bg-light\');
        }
    });
}
// Attach to existing radios
document.querySelectorAll(\'#imagePreviewContainer input[type="radio"]\').forEach(radio => {
    radio.addEventListener(\'change\', updatePrimaryBorders);
});
</script>
';
include '../app/views/layouts/header.php';
?>