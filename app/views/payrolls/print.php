<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - <?= htmlspecialchars($employee->name) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; 
            padding: 40px; 
            color: #1f2937; 
            line-height: 1.6;
            background: #f9fafb;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        
        .header { 
            background: #696cff;
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .header h1 { 
            font-size: 28px; 
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        
        .header p { 
            opacity: 0.9;
            font-size: 14px;
        }
        
        .title { 
            background: #f9fafb;
            padding: 24px 40px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .title h2 { 
            font-size: 20px; 
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #374151;
            font-weight: 700;
            text-align: center;
        }
        
        .content {
            padding: 40px;
        }
        
        .info-section {
            margin-bottom: 32px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            padding: 16px;
            background: #f9fafb;
            border-radius: 8px;
        }
        
        .info-item .label {
            font-weight: 600;
            color: #6b7280;
            min-width: 140px;
            font-size: 14px;
        }
        
        .info-item .value {
            font-weight: 600;
            color: #1f2937;
        }
        
        .status-badge { 
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px; 
            border-radius: 20px; 
            font-size: 13px; 
            font-weight: 600;
        }
        
        .status-paid { 
            background: #dcfce7; 
            color: #166534; 
        }
        
        .status-draft { 
            background: #fef3c7; 
            color: #92400e; 
        }
        
        .salary-section {
            margin-top: 32px;
        }
        
        .salary-section h3 {
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .salary-table { 
            width: 100%; 
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }
        
        .salary-table th, .salary-table td { 
            padding: 16px 24px;
        }
        
        .salary-table th { 
            background: #f3f4f6; 
            text-align: left; 
            font-weight: 600;
            color: #4b5563;
            font-size: 14px;
        }
        
        .salary-table td { 
            text-align: right;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .salary-table tr:last-child td {
            border-bottom: none;
        }
        
        .salary-table .total { 
            background: #f3f4f6;
            color: #1f2937;
        }
        
        .salary-table .total th,
        .salary-table .total td {
            font-weight: 700;
            font-size: 16px;
        }
        
        .notes-section {
            margin-top: 32px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        .notes-section h4 {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }
        
        .notes-section p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .footer { 
            margin-top: 40px; 
            display: flex; 
            justify-content: space-between;
            padding: 0 40px 40px;
        }
        
        .signature { 
            text-align: center; 
            width: 200px; 
        }
        
        .signature .line { 
            border-bottom: 2px solid #1f2937; 
            height: 60px; 
            margin-bottom: 8px;
        }
        
        .signature p { 
            font-size: 13px; 
            color: #6b7280; 
        }
        
        .signature strong {
            color: #1f2937;
            font-weight: 600;
        }
        
        .footer-text {
            text-align: center; 
            margin-top: 24px;
            padding: 16px 40px;
            background: #f9fafb;
            font-size: 12px; 
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }
        
        @media print {
            body { 
                padding: 0; 
                background: white;
            }
            .container {
                box-shadow: none;
                border-radius: 0;
            }
            .no-print { 
                display: none !important; 
            }
        }
        
        /* Print button styles */
        .no-print {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .btn-print {
            background: #696cff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }
        
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 12px -1px rgba(0, 0, 0, 0.15);
        }
        
        .btn-close-modal {
            background: #f3f4f6;
            color: #4b5563;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-left: 8px;
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="btn-print" onclick="window.print()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                <rect x="6" y="14" width="12" height="8"></rect>
            </svg>
            Cetak Slip Gaji
        </button>
        <button class="btn-close-modal" onclick="window.close()">
            Tutup
        </button>
    </div>

    <div class="container">
        <div class="header">
            <h1>THE BEADERY</h1>
            <p>Jayapura, Papua</p>
        </div>

        <div class="title">
            <h2>Slip Gaji Karyawan</h2>
        </div>

        <div class="content">
            <div class="info-section">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Nama Karyawan</span>
                        <span class="value"><?= htmlspecialchars($employee->name) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Username</span>
                        <span class="value"><?= htmlspecialchars($employee->username) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Periode</span>
                        <span class="value"><?= date('F Y', mktime(0, 0, 0, $payroll->period_month, 1, $payroll->period_year)) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="label">Status</span>
                        <span class="value">
                            <?php if ($payroll->status === 'paid'): ?>
                                <span class="status-badge status-paid">DIBAYAR</span>
                            <?php else: ?>
                                <span class="status-badge status-draft">DRAFT</span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if ($payroll->payment_date): ?>
                        <div class="info-item">
                            <span class="label">Tanggal Bayar</span>
                            <span class="value"><?= date('d F Y', strtotime($payroll->payment_date)) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="salary-section">
                <h3>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    Rincian Gaji
                </h3>
                <table class="salary-table">
                    <tr>
                        <th>Gaji Pokok</th>
                        <td>Rp <?= number_format($payroll->base_salary, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Tunjangan</th>
                        <td style="color: #059669;">+ Rp <?= number_format($payroll->allowance, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Bonus</th>
                        <td style="color: #059669;">+ Rp <?= number_format($payroll->bonus, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Potongan</th>
                        <td style="color: #dc2626;">- Rp <?= number_format($payroll->deduction, 0, ',', '.') ?></td>
                    </tr>
                    <tr class="total">
                        <th>TOTAL GAJI DITERIMA</th>
                        <td>Rp <?= number_format($payroll->total_salary, 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>

            <?php if (!empty($payroll->notes)): ?>
                <div class="notes-section">
                    <h4>Catatan</h4>
                    <p><?= nl2br(htmlspecialchars($payroll->notes)) ?></p>
                </div>
            <?php endif; ?>

            <div class="footer">
                <div class="signature">
                    <div class="line"></div>
                    <p>Mengetahui,</p>
                    <p><strong>Admin</strong></p>
                </div>
                <div class="signature">
                    <div class="line"></div>
                    <p>Diterima oleh,</p>
                    <p><strong><?= htmlspecialchars($employee->name) ?></strong></p>
                </div>
            </div>
        </div>

        <div class="footer-text">
            Slip gaji ini dicetak pada <?= date('d F Y, H:i') ?> | The Beadery &copy; <?= date('Y') ?>
        </div>
    </div>
</body>
</html>
