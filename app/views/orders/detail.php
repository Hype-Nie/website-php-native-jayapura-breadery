<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Pesanan: <?= htmlspecialchars($order->order_code) ?></h5>
                    <small class="text-muted"><?= date('d/m/Y H:i', strtotime($order->created_at)) ?></small>
                    &nbsp;
                    <?php if ($order->status === 'pending'): ?>
                        <span class="badge bg-label-warning">Pending</span>
                    <?php elseif ($order->status === 'paid'): ?>
                        <span class="badge bg-label-success">Lunas</span>
                    <?php else: ?>
                        <span class="badge bg-label-danger">Batal</span>
                    <?php endif; ?>
                </div>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-2" onclick="window.print()">
                        <i class="bx bx-printer me-1"></i> Cetak Struk
                    </button>
                    <a href="<?= BASE_URL ?>orders" class="btn btn-sm btn-outline-secondary">
                        <i class="bx bx-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if ($order->status === 'pending'): ?>
                <div class="mb-4">
                    <label class="form-label">Tambah Produk</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="productSearch" placeholder="Scan barcode atau ketik nama produk..." />
                        <button class="btn btn-primary" type="button" id="btnAddProduct">
                            <i class="bx bx-plus"></i>
                        </button>
                    </div>
                    <div id="searchResults" class="list-group position-absolute z-3" style="display:none;max-height:200px;overflow-y:auto;"></div>
                </div>
                <?php endif; ?>

                <?php if (!empty($order->items)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                                <?php if ($order->status === 'pending'): ?>
                                <th style="width:40px"></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody id="orderItems">
                            <?php foreach ($order->items as $item): ?>
                                <tr data-item-id="<?= $item->id ?>" data-product-id="<?= $item->product_id ?>">
                                    <td>
                                        <strong><?= htmlspecialchars($item->product_name) ?></strong>
                                        <div class="small text-muted"><code><?= htmlspecialchars($item->barcode) ?></code></div>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($order->status === 'pending'): ?>
                                            <div class="input-group input-group-sm d-inline-flex" style="width:110px">
                                                <button class="btn btn-outline-secondary qty-change" data-action="decrease">-</button>
                                                <input type="number" class="form-control text-center qty-input" value="<?= $item->quantity ?>" min="1" />
                                                <button class="btn btn-outline-secondary qty-change" data-action="increase">+</button>
                                            </div>
                                        <?php else: ?>
                                            <?= $item->quantity ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">Rp <?= number_format($item->price, 0, ',', '.') ?></td>
                                    <td class="text-end subtotal">Rp <?= number_format($item->subtotal, 0, ',', '.') ?></td>
                                    <?php if ($order->status === 'pending'): ?>
                                    <td>
                                        <form method="POST" action="<?= BASE_URL ?>orders/removeItem" class="d-inline">
                                            <input type="hidden" name="order_id" value="<?= $order->id ?>" />
                                            <input type="hidden" name="item_id" value="<?= $item->id ?>" />
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="text-end fw-bold text-primary fs-5" id="orderTotal">Rp <?= number_format($order->total_amount, 0, ',', '.') ?></td>
                                <?php if ($order->status === 'pending'): ?>
                                <td></td>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <?php if ($order->status === 'pending'): ?>
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bx bx-credit-card me-2"></i>Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Total Bayar</label>
                    <div class="fw-bold text-primary fs-5" id="displayTotal">Rp <?= number_format($order->total_amount, 0, ',', '.') ?></div>
                </div>
                <form method="POST" action="<?= BASE_URL ?>orders/markPaid" id="paymentForm">
                    <input type="hidden" name="id" value="<?= $order->id ?>" />
                    <input type="hidden" name="payment_amount" id="paymentInput" value="<?= (int)$order->total_amount ?>" />
                    <div class="mb-3">
                        <label class="form-label" for="payment_display">Jumlah Bayar</label>
                        <input type="number" class="form-control" id="payment_display" 
                            min="<?= (int)$order->total_amount ?>" value="<?= (int)$order->total_amount ?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kembalian</label>
                        <div class="fw-bold text-success fs-5" id="changeDisplay">Rp 0</div>
                    </div>
                    <button type="submit" class="btn btn-success w-100"
                        onclick="return confirm('Proses pembayaran ini? Stok akan dikurangi.')">
                        <i class="bx bx-check-circle me-1"></i> Proses Bayar
                    </button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>orders/cancel">
                    <input type="hidden" name="id" value="<?= $order->id ?>" />
                    <button type="submit" class="btn btn-outline-danger w-100"
                        onclick="return confirm('Batalkan pesanan ini?')">
                        <i class="bx bx-x me-1"></i> Batalkan Pesanan
                    </button>
                </form>
            </div>
        </div>
        <?php else: ?>
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Ringkasan Pembayaran</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm mb-0">
                    <tr>
                        <td class="text-muted">Total</td>
                        <td class="text-end fw-semibold">Rp <?= number_format($order->total_amount, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Bayar</td>
                        <td class="text-end">Rp <?= number_format($order->payment_amount, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kembalian</td>
                        <td class="text-end">Rp <?= number_format($order->change_amount, 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Info Pelanggan</h6>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <div class="small text-muted">Nama</div>
                    <div class="fw-semibold"><?= htmlspecialchars($order->customer_name) ?></div>
                </div>
                <div class="mb-2">
                    <div class="small text-muted">WhatsApp</div>
                    <div class="fw-semibold"><?= htmlspecialchars($order->customer_phone) ?></div>
                </div>
                <?php if (!empty($order->notes)): ?>
                <div>
                    <div class="small text-muted">Catatan</div>
                    <div><?= htmlspecialchars($order->notes) ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var total = <?= (int)$order->total_amount ?>;
    var paymentInput = document.getElementById('payment_display');
    var paymentHidden = document.getElementById('paymentInput');
    var changeDisplay = document.getElementById('changeDisplay');

    function updateChange() {
        var payment = parseInt(paymentInput.value) || 0;
        var change = payment - total;
        paymentHidden.value = payment;
        if (change >= 0) {
            changeDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(change);
            changeDisplay.className = 'fw-bold text-success fs-5';
        } else {
            changeDisplay.textContent = 'Kurang Rp ' + new Intl.NumberFormat('id-ID').format(Math.abs(change));
            changeDisplay.className = 'fw-bold text-danger fs-5';
        }
    }

    paymentInput.addEventListener('input', updateChange);
    updateChange();

    var searchInput = document.getElementById('productSearch');
    var searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function() {
        var q = this.value.trim();
        if (q.length < 2) {
            searchResults.style.display = 'none';
            return;
        }
        fetch('<?= BASE_URL ?>products/search?q=' + encodeURIComponent(q))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success && data.products.length > 0) {
                    searchResults.innerHTML = '';
                    data.products.forEach(function(p) {
                        var a = document.createElement('a');
                        a.href = '#';
                        a.className = 'list-group-item list-group-item-action';
                        a.textContent = p.name + ' - Rp ' + new Intl.NumberFormat('id-ID').format(p.price) + ' (Stok: ' + p.stock + ')';
                        a.dataset.productId = p.id;
                        a.addEventListener('click', function(e) {
                            e.preventDefault();
                            addProductToOrder(p.id);
                        });
                        searchResults.appendChild(a);
                    });
                    searchResults.style.display = 'block';
                } else {
                    searchResults.style.display = 'none';
                }
            });
    });

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

    function addProductToOrder(productId) {
        var formData = new FormData();
        formData.append('order_id', <?= $order->id ?>);
        formData.append('product_id', productId);
        formData.append('quantity', 1);
        fetch('<?= BASE_URL ?>orders/addItem', {
            method: 'POST',
            body: formData
        }).then(function(r) { return r.json(); })
          .then(function(data) {
            if (data.success) location.reload();
            else alert(data.message || 'Gagal menambah produk');
          });
    }

    document.getElementById('btnAddProduct').addEventListener('click', function() {
        var q = searchInput.value.trim();
        if (q.length < 2) return;
        fetch('<?= BASE_URL ?>products/search?q=' + encodeURIComponent(q))
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success && data.products.length > 0) {
                    addProductToOrder(data.products[0].id);
                }
            });
    });

    document.querySelectorAll('.qty-change').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var row = btn.closest('tr');
            var itemId = row.dataset.itemId;
            var input = row.querySelector('.qty-input');
            var qty = parseInt(input.value) || 1;
            var action = btn.dataset.action;
            if (action === 'increase') qty++;
            else if (action === 'decrease') qty--;
            if (qty < 1) return;

            var formData = new FormData();
            formData.append('order_id', <?= $order->id ?>);
            formData.append('item_id', itemId);
            formData.append('quantity', qty);
            fetch('<?= BASE_URL ?>orders/updateItem', {
                method: 'POST',
                body: formData
            }).then(function(r) { return r.json(); })
              .then(function(data) {
                if (data.success) location.reload();
                else alert(data.message || 'Gagal update jumlah');
              });
        });
    });
});
</script>

<?php
$content = ob_get_clean();
$pageStyles = '
<style>
@media print {
    .layout-navbar, .layout-menu, .layout-footer,
    .card-header .btn, .content-footer, .col-lg-4, .btn, .navbar, footer,
    .input-group, #productSearch, #searchResults, .qty-change, .qty-input { display: none !important; }
    .col-lg-8 { width: 100% !important; max-width: 100% !important; flex: 0 0 100% !important; }
    .content-wrapper { padding: 0 !important; }
    .card { border: 1px solid #ddd !important; box-shadow: none !important; }
    .table { font-size: 12px; }
}
</style>';
include '../app/views/layouts/header.php';
?>
