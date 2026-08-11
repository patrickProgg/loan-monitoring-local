<style>
    .total-box {
        background: linear-gradient(135deg, var(--light-blue), #ffffff);
        border-radius: 12px;
        padding: 12px 16px;
        border: 1px solid var(--light-blue);
        height: 58px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 130px;
    }

    .total-label {
        font-size: 10px;
        color: #6c757d;
        font-weight: 500;
    }

    .total-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--blue);
        line-height: 1.2;
    }

    .top-bar {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    /* Input focus effects */
    .form-control:focus,
    .form-select:focus {
        border-color: #f5576c;
        box-shadow: 0 0 0 0.2rem rgba(245, 87, 108, 0.25);
    }

    /* Quick amount buttons hover */
    .quick-amount:hover {
        background-color: #f5576c;
        border-color: #f5576c;
        color: white;
    }

    /* Soft background colors for badges */
    .bg-warning-soft {
        background-color: #fff3cd !important;
        color: #856404 !important;
    }

    .bg-info-soft {
        background-color: #d1ecf1 !important;
        color: #0c5460 !important;
    }

    .bg-success-soft {
        background-color: #d4edda !important;
        color: #155724 !important;
    }

    .bg-primary-soft {
        background-color: #cce5ff !important;
        color: #004085 !important;
    }

    .bg-secondary-soft {
        background-color: #e2e3e5 !important;
        color: #383d41 !important;
    }

    /* Badge styling */
    .badge {
        font-weight: 500;
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
    }

    /* Action buttons */
    .btn-group-sm .btn {
        padding: 0.2rem 0.5rem;
        font-size: 0.75rem;
    }

    .btn-group-sm .btn i {
        font-size: 0.7rem;
    }

    /* Table hover effect */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
        transition: background-color 0.2s;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 0.5rem;
        }

        .table-responsive {
            font-size: 0.8rem;
        }

        .btn-group-sm .btn {
            padding: 0.1rem 0.3rem;
            font-size: 0.65rem;
        }

        .btn-group-sm .btn i {
            font-size: 0.6rem;
        }
    }
</style>
<section id="content">
    <main>
        <div class="table-data">
            <div class="order pt-2" style="background-color:transparent">
                <div class="row">
                    <div class="col-12 d-flex">
                        <button class="btn btn-primary me-2" onclick="openModal('addPullOut')">
                            <i class="fas fa-list me-1"></i> Add New
                        </button>
                        <div class="ms-auto">
                            <button class="btn btn-success" id="withdrawBtn">
                                <i class="fas fa-download me-1"></i> Withdraw Pullout
                            </button>
                            <button class="btn btn-info" id="withdrawHistoryBtn">
                                <i class="fas fa-history me-1"></i> Withdraw History
                            </button>
                        </div>
                    </div>

                    <div id="customTotalsContainer" style="margin-bottom:10px; display:flex; gap:10px;">
                        <div class="total-box">
                            <div class="total-label">
                                <i class="bx bx-receipt me-1"></i> Processing Fee
                            </div>
                            <div class="total-value" id="totalFee">₱0.00</div>
                        </div>

                        <div class="total-box">
                            <div class="total-label">
                                <i class="bx bx-purchase-tag me-1"></i> Ticket
                            </div>
                            <div class="total-value" id="totalTicket">₱0.00</div>
                        </div>

                        <div class="total-box">
                            <div class="total-label">
                                <i class="bx bx-line-chart me-1"></i> Sharing Profit
                            </div>
                            <div class="total-value" id="totalProfit">₱0.00</div>
                        </div>

                        <div class="total-box">
                            <div class="total-label">
                                <i class="bx bx-bar-chart me-1"></i> Pull Out 2%
                            </div>
                            <div class="total-value" id="totalPullOut">₱0.00</div>
                        </div>
                        <div class="total-box">
                            <div class="total-label">
                                <i class="bx bx-wallet me-1"></i> Pull Out Capital
                            </div>
                            <div class="total-value" id="totalPullOutCapital">₱0.00</div>
                        </div>

                        <div class="total-box">
                            <div class="total-label">
                                <i class="bx bx-money me-1"></i> Total Amount
                            </div>
                            <div class="total-value" id="totalAmount">₱0.00</div>
                        </div>

                    </div>

                    <table id="pull_out_table" class="table table-hover mb-0 pb-0" style="width:100%">
                        <thead class="table-secondary">
                            <tr>
                                <th style="width: 5%; vertical-align: middle; text-align:center;">NO</th>
                                <th style="width: 10%; vertical-align: middle;">DATE</th>
                                <th style="width: 12%; vertical-align: middle;">PROCESSING FEE</th>
                                <th style="width: 12%; vertical-align: middle;">TICKET AMT</th>
                                <th style="width: 12%; vertical-align: middle;">SHARING PROFIT</th>
                                <th style="width: 12%; vertical-align: middle;">PULL OUT 2%</th>
                                <th style="width: 12%; vertical-align: middle;">PULL OUT CAPITAL</th>
                                <th style="width: 12%; vertical-align: middle;">TOTAL AMT</th>
                                <th style="width: 20%; vertical-align: middle; text-align: center;">ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addPullOut" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog" style="max-width:700px; margin-top: 10px;">
                <div class="modal-content">
                    <div class="modal-header bg-light border-bottom">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-cogs me-2 text-danger"></i>
                            Pull Out Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container p-0">
                            <!-- Pull Out Form -->
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-header bg-white border-0">
                                    <h6 class="fw-bold mb-0">
                                        <i class="fas fa-money-bill-wave me-2 text-danger"></i>
                                        Pull Out Computation
                                    </h6>
                                </div>
                                <div class="card-body pb-4">
                                    <form id="pull_out_form">
                                        <!-- First Row -->
                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold text-muted small mb-2">
                                                    <i class="fas fa-percent me-1"></i> PROCESSING FEE
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-0 fw-bold">₱</span>
                                                    <input type="number" class="form-control form-control-lg"
                                                        placeholder="0.00" id="process_fee" name="process_fee"
                                                        autocomplete="off" min="0" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold text-muted small mb-2">
                                                    <i class="fas fa-ticket-alt me-1"></i> TICKET
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-0 fw-bold">₱</span>
                                                    <input type="number" class="form-control form-control-lg"
                                                        placeholder="0.00" id="ticket" name="ticket" autocomplete="off"
                                                        min="0" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold text-muted small mb-2">
                                                    <i class="fas fa-hand-holding-usd me-1"></i> SHARING PROFIT
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-0 fw-bold">₱</span>
                                                    <input type="number" class="form-control form-control-lg"
                                                        placeholder="0.00" id="profit" name="profit" min="0"
                                                        step="0.01">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Second Row -->
                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold text-muted small mb-2">
                                                    <i class="fas fa-chart-line me-1"></i> PULL OUT 2%
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-0 fw-bold">₱</span>
                                                    <input type="number" class="form-control form-control-lg"
                                                        placeholder="0.00" id="pull_out" name="pull_out" min="0"
                                                        step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold text-muted small mb-2">
                                                    <i class="fas fa-coins me-1"></i> PULL OUT CAPITAL
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-0 fw-bold">₱</span>
                                                    <input type="number" class="form-control form-control-lg"
                                                        placeholder="0.00" id="pull_out_capital" name="pull_out_capital"
                                                        min="0" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold text-muted small mb-2">
                                                    <i class="fas fa-calculator me-1"></i> TOTAL PULL OUT
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-light border-0 fw-bold">₱</span>
                                                    <input type="number"
                                                        class="form-control form-control-lg fw-bold text-danger"
                                                        id="total_amt" name="total_amt" readonly
                                                        style="background-color: #f8f9fa;">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date Row -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-muted small mb-2">
                                                    <i class="fas fa-calendar-alt me-1"></i> DATE PULL OUT
                                                </label>
                                                <input type="date" class="form-control form-control-lg" id="date_added"
                                                    name="date_added" value="<?= date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    <button type="button" onclick="handleFormSubmit(currentAction, currentId)"
                                        id="submitBtn" name="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i> Save Pull Out
                                    </button>
                                    <button type="button" class="btn btn-light ms-2 " data-bs-dismiss="modal"
                                        id="closeModalBtn">
                                        <i class="fas fa-times me-1"></i> Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="withdrawPullout" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog" style="max-width:600px; margin-top: 10px;">
                <div class="modal-content">

                    <div class="modal-header bg-light border-bottom">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-hand-holding-usd me-2 text-danger"></i>
                            Pullout Withdrawal
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <!-- Pullout Balance Card -->
                            <div class="mb-4">
                                <div class="row g-3">
                                    <!-- Pullout Balance -->
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="card-body p-3">
                                                        <label
                                                            class="text-muted small text-uppercase fw-bold d-block mb-1">
                                                            <i class="fas fa-circle me-2 text-danger"
                                                                style="font-size: 8px;"></i>
                                                            Pullout Balance
                                                        </label>
                                                        <div class="d-flex align-items-end">
                                                            <span class="text-muted me-1">₱</span>
                                                            <input type="text"
                                                                class="form-control border-0 p-0 fs-4 fw-bold text-dark"
                                                                id="total_pullout" value="0.00" readonly
                                                                style="background: transparent; height: auto; width: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Processing Fee -->
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="card-body p-3">
                                                        <label
                                                            class="text-muted small text-uppercase fw-bold d-block mb-1">
                                                            <i class="fas fa-circle me-2 text-warning"
                                                                style="font-size: 8px;"></i>
                                                            Processing Fee
                                                        </label>
                                                        <div class="d-flex align-items-end">
                                                            <span class="text-muted me-1">₱</span>
                                                            <input type="text"
                                                                class="form-control border-0 p-0 fs-4 fw-bold text-dark"
                                                                id="processing_fee_balance" value="0.00" readonly
                                                                style="background: transparent; height: auto; width: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ticket -->
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="card-body p-3">
                                                        <label
                                                            class="text-muted small text-uppercase fw-bold d-block mb-1">
                                                            <i class="fas fa-circle me-2 text-info"
                                                                style="font-size: 8px;"></i>
                                                            Ticket
                                                        </label>
                                                        <div class="d-flex align-items-end">
                                                            <span class="text-muted me-1">₱</span>
                                                            <input type="text"
                                                                class="form-control border-0 p-0 fs-4 fw-bold text-dark"
                                                                id="ticket_balance" value="0.00" readonly
                                                                style="background: transparent; height: auto; width: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Profit -->
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="card-body p-3">
                                                        <label
                                                            class="text-muted small text-uppercase fw-bold d-block mb-1">
                                                            <i class="fas fa-circle me-2 text-success"
                                                                style="font-size: 8px;"></i>
                                                            Profit
                                                        </label>
                                                        <div class="d-flex align-items-end">
                                                            <span class="text-muted me-1">₱</span>
                                                            <input type="text"
                                                                class="form-control border-0 p-0 fs-4 fw-bold text-dark"
                                                                id="profit_balance" value="0.00" readonly
                                                                style="background: transparent; height: auto; width: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Expansion -->
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="card-body p-3">
                                                        <label
                                                            class="text-muted small text-uppercase fw-bold d-block mb-1">
                                                            <i class="fas fa-circle me-2 text-primary"
                                                                style="font-size: 8px;"></i>
                                                            Expansion
                                                        </label>
                                                        <div class="d-flex align-items-end">
                                                            <span class="text-muted me-1">₱</span>
                                                            <input type="text"
                                                                class="form-control border-0 p-0 fs-4 fw-bold text-dark"
                                                                id="expansion_balance" value="0.00" readonly
                                                                style="background: transparent; height: auto; width: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Capital -->
                                    <div class="col-md-6 col-xl-4">
                                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <div class="card-body p-3">
                                                        <label
                                                            class="text-muted small text-uppercase fw-bold d-block mb-1">
                                                            <i class="fas fa-circle me-2 text-secondary"
                                                                style="font-size: 8px;"></i>
                                                            Capital
                                                        </label>
                                                        <div class="d-flex align-items-end">
                                                            <span class="text-muted me-1">₱</span>
                                                            <input type="text"
                                                                class="form-control border-0 p-0 fs-4 fw-bold text-dark"
                                                                id="capital_balance" value="0.00" readonly
                                                                style="background: transparent; height: auto; width: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Withdrawal Form -->
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-header bg-white border-0 pt-2 px-4">
                                    <h6 class="fw-bold mb-0">
                                        <i class="fas fa-money-bill-wave me-2 text-primary"></i>
                                        Withdrawal Details
                                    </h6>
                                </div>
                                <div class="card-body px-4 pb-4">
                                    <!-- Amount and Date in same row -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small mb-2">
                                                <i class="fas fa-coins me-1"></i> AMOUNT TO WITHDRAW
                                            </label>
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-lg"
                                                    id="withdraw_amount" name="withdraw_amount" placeholder="0.00"
                                                    min="0" step="0.01" value="">
                                                <span class="input-group-text bg-light border-0">PHP</span>
                                            </div>
                                            <small class="text-muted mt-1 d-block">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Max withdrawable: ₱<span id="max_withdrawable">0.00</span>
                                            </small>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small mb-2">
                                                <i class="fas fa-calendar-alt me-1"></i> WITHDRAWAL DATE
                                            </label>
                                            <input type="date" class="form-control form-control-lg" id="withdrawal_date"
                                                name="withdrawal_date" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>

                                    <!-- Withdrawal Reason / Notes -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-muted small mb-2">
                                            <i class="fas fa-pen me-1"></i> NOTES / REASON
                                        </label>
                                        <textarea class="form-control" id="withdrawal_notes" name="withdrawal_notes"
                                            rows="1"
                                            placeholder="Enter withdrawal reason or notes (optional)"></textarea>
                                    </div>

                                    <!-- Fee/Category Checkboxes -->
                                    <!-- Fee/Category Radio Buttons (only 1 can be selected) -->
                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-muted small mb-2">
                                            <i class="fas fa-tags me-1"></i> WITHDRAWAL CATEGORY
                                        </label>
                                        <div class="d-flex gap-3 flex-wrap">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="fee_processing"
                                                    name="withdrawal_category" value="processing_fee"
                                                    data-label="Processing Fee">
                                                <label class="form-check-label" for="fee_processing">
                                                    <i class="fas fa-receipt text-danger me-1"></i> Processing Fee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="fee_ticket"
                                                    name="withdrawal_category" value="ticket" data-label="Ticket">
                                                <label class="form-check-label" for="fee_ticket">
                                                    <i class="fas fa-ticket-alt text-warning me-1"></i> Ticket
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="fee_profit"
                                                    name="withdrawal_category" value="profit" data-label="Profit">
                                                <label class="form-check-label" for="fee_profit">
                                                    <i class="fas fa-chart-line text-success me-1"></i> Profit
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="fee_expansion"
                                                    name="withdrawal_category" value="expansion" data-label="Expansion">
                                                <label class="form-check-label" for="fee_expansion">
                                                    <i class="fas fa-expand-arrows-alt text-info me-1"></i> Expansion
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="fee_capital"
                                                    name="withdrawal_category" value="capital" data-label="Capital">
                                                <label class="form-check-label" for="fee_capital">
                                                    <i class="fas fa-building text-primary me-1"></i> Capital
                                                </label>
                                            </div>
                                        </div>
                                        <small class="text-muted mt-1 d-block">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Select one category for this withdrawal
                                        </small>
                                    </div>

                                    <!-- Quick Amount Selector -->
                                    <div>
                                        <label class="form-label fw-bold text-muted small mb-2">
                                            <i class="fas fa-bolt me-1"></i> QUICK SELECT
                                        </label>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <button type="button" class="btn btn-outline-danger btn-sm quick-amount"
                                                data-amount="100">₱100</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm quick-amount"
                                                data-amount="500">₱500</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm quick-amount"
                                                data-amount="1000">₱1,000</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm quick-amount"
                                                data-amount="5000">₱5,000</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm quick-amount"
                                                data-amount="10000">₱10,000</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm quick-amount"
                                                id="max_amount">Max</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="process_withdrawal" name="submit" class="btn btn-primary">
                                        <i class="fas fa-check-circle me-1"></i> Process Withdrawal
                                    </button>
                                    <button type="button" class="btn btn-light ms-2" data-bs-dismiss="modal"
                                        id="closeModalBtn">
                                        <i class="fas fa-times me-1"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Withdraw History Modal -->
        <div class="modal fade" id="withdrawHistoryModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl" style="max-width:1000px; margin-top: 10px;">
                <div class="modal-content">
                    <div class="modal-header bg-light border-bottom">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-history me-2 text-info"></i>
                            Withdrawal History
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body pb-0">
                        <div class="container p-0">
                            <!-- History Table -->
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-header bg-white border-0">
                                    <h6 class="fw-bold mb-0">
                                        <i class="fas fa-list me-2 text-info"></i>
                                        Transaction List
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" id="withdrawalHistoryTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 5%;">#</th>
                                                    <th style="width: 13%;">DATE</th>
                                                    <th style="width: 13%;">AMOUNT</th>
                                                    <th style="width: 15%;">CATEGORY</th>
                                                    <th style="width: 10%;">STATUS</th>
                                                    <th>NOTES</th>
                                                    <th style="width: 10%;">ACTIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="6" class="text-center py-4">Loading data...</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="table-light">
                                                <tr>
                                                    <th colspan="6" class="text-end">Total:</th>
                                                    <th id="footerTotal">₱0.00</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="pagination-container px-4 pb-4" style="display: none;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="text-muted small" id="pageInfo"></span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-outline-secondary btn-sm" id="firstPage"
                                                title="First Page">
                                                <i class="fas fa-angle-double-left"></i>
                                            </button>
                                            <button class="btn btn-outline-secondary btn-sm" id="prevPage"
                                                title="Previous Page">
                                                <i class="fas fa-angle-left"></i>
                                            </button>

                                            <div class="d-flex align-items-center mx-2">
                                                <span class="mx-1">Page</span>
                                                <select class="form-select form-select-sm" id="pageSelector"
                                                    style="width: 80px;">
                                                    <option value="1">1</option>
                                                </select>
                                                <span class="mx-1">of <span id="totalPages">1</span></span>
                                            </div>

                                            <button class="btn btn-outline-secondary btn-sm" id="nextPage"
                                                title="Next Page">
                                                <i class="fas fa-angle-right"></i>
                                            </button>
                                            <button class="btn btn-outline-secondary btn-sm" id="lastPage"
                                                title="Last Page">
                                                <i class="fas fa-angle-double-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </main>
</section>

<script>
    let currentId = 0;

    var pull_out_table = $("#pull_out_table").DataTable({
        dom:
            "<'top-bar mb-0'lf>" +
            "rt" +
            "<'d-flex justify-content-between mt-0 pt-0'<'dataTables_info pt-0'i><'dataTables_paginate pt-0'p>>",

        columnDefs: [{ targets: '_all', orderable: true }],
        lengthMenu: [10, 25, 50, 100],
        processing: true,
        serverSide: true,
        searching: true,
        ordering: true,
        ajax: {
            url: '<?php echo site_url('PullOut_cont/get_pull_out'); ?>',
            type: 'POST',
            data: function (d) {
                d.start = d.start || 0;
                d.length = d.length || 10;
            },
            dataType: 'json',
            error: function (xhr, status, error) {
                console.error("AJAX request failed: " + error);
            },
            dataSrc: function (json) {
                if (json.total_amt !== undefined) {
                    $('#totalFee').text('₱' + parseFloat(json.total_fee).toLocaleString('en-PH', { minimumFractionDigits: 2 }));
                    $('#totalTicket').text('₱' + parseFloat(json.total_ticket).toLocaleString('en-PH', { minimumFractionDigits: 2 }));
                    $('#totalProfit').text('₱' + parseFloat(json.total_profit).toLocaleString('en-PH', { minimumFractionDigits: 2 }));
                    $('#totalPullOut').text('₱' + parseFloat(json.total_pull_out).toLocaleString('en-PH', { minimumFractionDigits: 2 }));
                    $('#totalPullOutCapital').text('₱' + parseFloat(json.total_pull_out_capital).toLocaleString('en-PH', { minimumFractionDigits: 2 }));
                    $('#totalAmount').text('₱' + parseFloat(json.total_amt).toLocaleString('en-PH', { minimumFractionDigits: 2 }));
                }
                return json.data;
            }
        },
        columns: [
            {
                data: null,
                class: 'text-center',
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'date_added', class: 'text-center' },
            {
                data: 'process_fee',
                class: 'text-end',
                render: function (data, type, row) {
                    return Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            },
            {
                data: 'ticket',
                class: 'text-end',
                render: function (data, type, row) {
                    return Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            },
            {
                data: 'profit_share',
                class: 'text-end',
                render: function (data, type, row) {
                    return Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            },
            {
                data: 'pull_out',
                class: 'text-end',
                render: function (data, type, row) {
                    return Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            },
            {
                data: 'pull_out_capital',
                class: 'text-end',
                render: function (data, type, row) {
                    return Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            },
            {
                data: 'total_pull_out',
                class: 'text-end',
                render: function (data, type, row) {
                    return Number(data).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }
            },
            {
                data: 'id',
                orderable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-success me-1" onclick='openModal("editPullOut", ${JSON.stringify(row)})'>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteBtn('${data}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    `;
                }
            }
        ],
        initComplete: function () {
            var $topBar = $('.top-bar');

            $('.dataTables_length').appendTo($topBar).addClass('me-3 pt-3 mb-0');

            $('#customTotalsContainer').appendTo($topBar).addClass('customTotals');
            $('.customTotals').css({
                display: 'flex',
                gap: '10px',
                position: 'absolute',
                marginLeft: '160px',
                justifyContent: 'flex-start',
                flexGrow: 1
            });

            $('.dataTables_filter').appendTo($topBar).addClass('ms-3 pt-3 mb-0');
        }
    });

    function deleteBtn(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action will move data to history!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            allowEnterKey: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Deleting pullout...',
                    html: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: "<?php echo base_url('PullOut_cont/delete_id'); ?>",
                    type: 'POST',
                    data: { id: id },
                    dataType: 'json',
                    success: function (res) {
                        Swal.close();
                        Swal.fire({
                            title: 'Deleted!',
                            text: res.message,
                            icon: 'success',
                            timer: 800,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            pull_out_table.ajax.reload();
                        });
                    },
                    error: function (err) {
                        Swal.close();
                        console.log(err);
                        Swal.fire('Error', 'Server error. Check console.', 'error');
                    }
                });
            }
        });
    }

    function calculateTotal() {
        let process_fee = parseFloat($('#process_fee').val()) || 0;
        let ticket = parseFloat($('#ticket').val()) || 0;
        let profit = parseFloat($('#profit').val()) || 0;
        let pull_out = parseFloat($('#pull_out').val()) || 0;
        let pull_out_capital = parseFloat($('#pull_out_capital').val()) || 0;

        let total = process_fee + ticket + profit + pull_out + pull_out_capital;

        $('#total_amt').val(total.toFixed(2));
    }

    $('#process_fee, #ticket, #profit, #pull_out, #pull_out_capital').on('input', calculateTotal);

    function openModal(action, row) {

        console.log(action);
        console.log(row);

        currentAction = action;

        if (row) {
            currentId = row.id;
        }
        console.log(currentId);

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.innerHTML = action.startsWith('add') ?
            '<i class="fas fa-plus me-1"></i> Add' :
            '<i class="fas fa-edit me-1"></i> Update';

        if (action === 'editPullOut' && row) {
            $('#process_fee').val(row.process_fee);
            $('#ticket').val(row.ticket);
            $('#profit').val(row.profit_share);
            $('#pull_out').val(row.pull_out);
            $('#pull_out_capital').val(row.pull_out_capital);
            $('#total_amt').val(row.total_pull_out);
            $('#date_added').val(row.date_added);
        }

        $('#addPullOut').modal('show');
    }

    $('#pull_out_form').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            handleFormSubmit(currentAction, currentId);
        }
    });

    function handleFormSubmit(action, id) {
        const formData = {
            process_fee: parseFloat($('#process_fee').val()) || 0,
            ticket: parseFloat($('#ticket').val()) || 0,
            profit: parseFloat($('#profit').val()) || 0,
            pull_out: parseFloat($('#pull_out').val()) || 0,
            pull_out_capital: parseFloat($('#pull_out_capital').val()) || 0,
            total_amt: parseFloat($('#total_amt').val()) || 0,
            date_added: $('#date_added').val().trim()
        };

        let url, method;
        switch (action) {
            case 'addPullOut':
                url = '<?php echo base_url("PullOut_cont/add_pull_out"); ?>';
                method = 'POST';
                break;

            case 'editPullOut':
                url = '<?php echo base_url("PullOut_cont/update_pull_out/"); ?>' + id;
                method = 'POST';
                break;

            default:
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Unknown action' });
                return;
        }

        if (formData.process_fee <= 0 && formData.ticket <= 0 && formData.profit <= 0 && formData.pull_out <= 0 && formData.total_amt <= 0) {
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please enter at least one value greater than 0' });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: action === 'addPullOut' ? 'You are about to add this record.' : 'You are about to update this record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proceed!',
            cancelButtonText: 'Cancel',
            allowEnterKey: false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Processing...',
                    html: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    dataType: 'json',
                    success: function (res) {
                        Swal.close();
                        Swal.fire({
                            title: 'Success',
                            text: res.message,
                            icon: 'success',
                            timer: 800,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            document.getElementById('pull_out_form').reset();
                            pull_out_table.ajax.reload();
                            $('#addPullOut').modal('hide');
                        });
                    },
                    error: function (err) {
                        Swal.close();
                        console.log(err);
                        Swal.fire({ icon: 'error', title: 'Server Error', text: 'Check console for details' });
                    }
                });
            }
        });
    }

    document.getElementById('closeModalBtn').addEventListener('click', function () {
        document.getElementById('pull_out_form').reset();
    });

    $('#withdrawBtn').on('click', function () {

        Swal.fire({
            title: 'Loading...',
            html: 'Please wait while we fetch data.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '<?php echo base_url("PullOut_cont/get_total_pullout"); ?>',
            type: 'POST',
            dataType: 'json',
            success: function (res) {
                Swal.close();

                // Update all balance fields
                $('#total_pullout').val(parseFloat(res.total_pullout).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                $('#processing_fee_balance').val(parseFloat(res.processing_fee).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                $('#ticket_balance').val(parseFloat(res.ticket).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                $('#profit_balance').val(parseFloat(res.profit).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                $('#expansion_balance').val(parseFloat(res.expansion).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                $('#capital_balance').val(parseFloat(res.capital).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                // Function to update max withdrawable based on selected category
                function updateMaxWithdrawable() {
                    let selectedCategory = $('input[name="withdrawal_category"]:checked');
                    let categoryBalance = 0;

                    if (selectedCategory.length > 0) {
                        let category = selectedCategory.val();
                        switch (category) {
                            case 'processing_fee':
                                categoryBalance = parseFloat(res.processing_fee) || 0;
                                break;
                            case 'ticket':
                                categoryBalance = parseFloat(res.ticket) || 0;
                                break;
                            case 'profit':
                                categoryBalance = parseFloat(res.profit) || 0;
                                break;
                            case 'expansion':
                                categoryBalance = parseFloat(res.expansion) || 0;
                                break;
                            case 'capital':
                                categoryBalance = parseFloat(res.capital) || 0;
                                break;
                            default:
                                categoryBalance = parseFloat(res.total_pullout) || 0;
                        }
                    } else {
                        categoryBalance = parseFloat(res.total_pullout) || 0;
                    }

                    $('#max_withdrawable').text(categoryBalance.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }));

                    $('#withdraw_amount').attr('max', categoryBalance);
                }

                // Update max when category changes
                $('input[name="withdrawal_category"]').on('change', function () {
                    updateMaxWithdrawable();
                    // Clear amount when category changes
                    $('#withdraw_amount').val('');
                    $('.quick-amount').removeClass('active');
                });

                // Initial update
                updateMaxWithdrawable();

                // Quick amount buttons
                $('.quick-amount').click(function () {
                    let amount = $(this).data('amount');
                    let maxAmount = parseFloat($('#withdraw_amount').attr('max')) || 0;
                    let selectedCategory = $('input[name="withdrawal_category"]:checked');

                    if (selectedCategory.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Select Category',
                            text: 'Please select a withdrawal category first!',
                            timer: 2000
                        });
                        return;
                    }

                    $(this).addClass('active').siblings().removeClass('active');

                    if (amount > maxAmount) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Insufficient Balance',
                            text: 'Withdrawal amount exceeds available balance!',
                            timer: 2000
                        });
                        $('#withdraw_amount').val(maxAmount);
                    } else {
                        $('#withdraw_amount').val(amount);
                    }
                });

                // Max amount button
                $('#max_amount').click(function () {
                    let selectedCategory = $('input[name="withdrawal_category"]:checked');

                    if (selectedCategory.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Select Category',
                            text: 'Please select a withdrawal category first!',
                            timer: 2000
                        });
                        return;
                    }

                    let maxAmount = parseFloat($('#withdraw_amount').attr('max')) || 0;
                    $('#withdraw_amount').val(maxAmount);
                    $(this).addClass('active').siblings().removeClass('active');
                });

                // Amount input validation
                $('#withdraw_amount').on('input', function () {
                    let amount = parseFloat($(this).val()) || 0;
                    let maxAmount = parseFloat($(this).attr('max')) || 0;

                    if (amount > maxAmount) {
                        $(this).val(maxAmount);
                        Swal.fire({
                            icon: 'warning',
                            title: 'Amount Adjusted',
                            text: 'Amount cannot exceed available balance!',
                            timer: 1500,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false
                        });
                    }

                    if (amount < 0) {
                        $(this).val(0);
                    }
                });

                // Process withdrawal
                $('#process_withdrawal').click(function () {
                    let total_pullout = parseFloat($('#total_pullout').val().replace(/,/g, ''));
                    let amount = $('#withdraw_amount').val();
                    let date = $('#withdrawal_date').val();
                    let method = $('#payment_method').val();
                    let reference = $('#reference_no').val();
                    let notes = $('#withdrawal_notes').val();

                    // Get selected category (only 1 allowed)
                    let selectedCategory = $('input[name="withdrawal_category"]:checked');

                    if (!amount || parseFloat(amount) <= 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid Amount',
                            text: 'Please enter a valid withdrawal amount'
                        });
                        return;
                    }

                    if (!date) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Date Required',
                            text: 'Please select a withdrawal date'
                        });
                        return;
                    }

                    // Validate category selection
                    if (selectedCategory.length === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Category Required',
                            text: 'Please select a withdrawal category (Processing Fee, Ticket, Profit, Expansion, or Capital)'
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Confirm Withdrawal',
                        html: `Are you sure you want to withdraw <strong>₱${parseFloat(amount).toLocaleString('en-US', { minimumFractionDigits: 2 })}</strong> from <strong>${selectedCategory.data('label') || selectedCategory.val()}</strong>?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, withdraw',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            Swal.fire({
                                title: 'Processing...',
                                html: 'Please wait',
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading()
                            });

                            console.log({
                                amount: amount,
                                date: date,
                                total_pullout: total_pullout,
                                notes: notes,
                                category: selectedCategory.val()
                            });

                            $.ajax({
                                url: '<?php echo site_url('PullOut_cont/add_withdrawal'); ?>',
                                type: 'POST',
                                data: {
                                    amount: amount,
                                    date: date,
                                    total_pullout: total_pullout,
                                    notes: notes,
                                    category: selectedCategory.val()
                                },
                                dataType: 'json',
                                success: function (res) {
                                    Swal.close();

                                    if (res.status === 'success') {
                                        Swal.fire({
                                            title: 'Success',
                                            text: res.message,
                                            icon: 'success',
                                            timer: 800,
                                            timerProgressBar: true,
                                            showConfirmButton: false
                                        }).then(() => {
                                            pull_out_table.ajax.reload();
                                            $('#withdrawPullout').modal('hide');
                                        });
                                    } else if (res.status === 'error') {
                                        Swal.fire({
                                            title: 'Error',
                                            text: res.message,
                                            icon: 'error',
                                            confirmButtonColor: '#d33',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                },
                                error: function (err) {
                                    Swal.close();
                                    console.log(err);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Server Error',
                                        text: 'Check console for details'
                                    });
                                }
                            });
                        }
                    });
                });

                // Reset modal on close
                $('#withdrawPullout').on('hidden.bs.modal', function () {
                    $('#withdraw_amount').val('');
                    $('#withdrawal_date').val('<?php echo date('Y-m-d'); ?>');
                    $('#payment_method').val('');
                    $('#reference_no').val('');
                    $('#withdrawal_notes').val('');
                    $('#reference_field').hide();
                    $('input[name="withdrawal_category"]').prop('checked', false);
                    $('.quick-amount').removeClass('active');
                    $('#max_amount').removeClass('active');
                });

                // Show modal
                $('#withdrawPullout').modal('show');
            },
            error: function (err) {
                Swal.close();
                console.log(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Check console for details'
                });
            }
        });

    });

    // View withdrawal history
    $(document).on('click', '#withdrawHistoryBtn', function () {
        Swal.fire({
            title: 'Loading...',
            html: 'Please wait while we fetch data.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '<?= base_url() ?>PullOut_cont/get_withdrawal_history',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                Swal.close();

                if (response.status === 'success') {
                    let tbody = $('#withdrawalHistoryTable tbody');
                    tbody.empty();

                    if (response.data.length > 0) {
                        let currentPage = 1;
                        const rowsPerPage = 5;
                        const totalRows = response.data.length;
                        const totalPages = Math.ceil(totalRows / rowsPerPage);

                        // Category labels and colors
                        const categoryLabels = {
                            'processing_fee': { label: 'Processing Fee', color: 'warning', icon: 'fa-receipt' },
                            'ticket': { label: 'Ticket', color: 'info', icon: 'fa-ticket-alt' },
                            'profit': { label: 'Profit', color: 'success', icon: 'fa-chart-line' },
                            'expansion': { label: 'Expansion', color: 'primary', icon: 'fa-expand-arrows-alt' },
                            'capital': { label: 'Capital', color: 'secondary', icon: 'fa-building' }
                        };

                        function getCategoryBadge(category) {
                            const cat = categoryLabels[category] || { label: category || 'N/A', color: 'secondary', icon: 'fa-tag' };
                            return `<span class="badge bg-${cat.color}-soft text-${cat.color} px-3 py-2 rounded-pill">
                            <i class="fas ${cat.icon} me-1"></i> ${cat.label}
                        </span>`;
                        }

                        function displayTablePage(page) {
                            tbody.empty();
                            const start = (page - 1) * rowsPerPage;
                            const end = Math.min(start + rowsPerPage, totalRows);

                            for (let i = start; i < end; i++) {
                                const item = response.data[i];
                                let date = new Date(item.date_added);
                                let formattedDate = date.toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'short',
                                    day: 'numeric',
                                });

                                let row = `
                                <tr>
                                    <td>${i + 1}</td>
                                    <td>${formattedDate}</td>
                                    <td class="fw-bold text-info">₱ ${parseFloat(item.withdraw_amt).toLocaleString('en-US', { minimumFractionDigits: 2 })}</td>
                                    <td>${getCategoryBadge(item.category)}</td>
                                    <td>${item.status === '1' ? '<span class="badge bg-success">Returned</span>' : '<span class="badge bg-secondary">Active</span>'}</td>
                                    <td>${item.note || '<span class="text-muted">—</span>'}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button class="btn btn-warning btn-sm edit-withdrawal" 
                                                data-id="${item.id}"
                                                data-amount="${item.withdraw_amt}"
                                                data-category="${item.category}"
                                                data-note="${item.note || ''}"
                                                data-date="${item.date_added}"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm delete-withdrawal" 
                                                data-id="${item.id}"
                                                data-amount="${item.withdraw_amt}"
                                                data-category="${item.category}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            ${item.status == 0 ? `
                                                <button class="btn btn-success btn-sm return-withdrawal" 
                                                    data-id="${item.id}"
                                                    data-amount="${item.withdraw_amt}"
                                                    data-category="${item.category}"
                                                    title="Return Amount">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            ` : `
                                                <button class="btn btn-secondary btn-sm" disabled title="Already Returned">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            `}
                                        </div>
                                    </td>
                                </tr>
                            `;
                                tbody.append(row);
                            }

                            $('#pageInfo').text(`Showing ${start + 1} to ${end} of ${totalRows} entries`);
                            $('#prevPage').prop('disabled', page === 1);
                            $('#nextPage').prop('disabled', page === totalPages);
                            $('#currentPage').text(page);
                            $('#totalPages').text(totalPages);

                            // Update page selector
                            let pageSelector = $('#pageSelector');
                            pageSelector.empty();
                            for (let i = 1; i <= totalPages; i++) {
                                pageSelector.append(`<option value="${i}" ${i === page ? 'selected' : ''}>Page ${i}</option>`);
                            }
                        }

                        displayTablePage(1);

                        $('.pagination-container').show();

                        $('#prevPage').off('click').on('click', function () {
                            if (currentPage > 1) {
                                currentPage--;
                                displayTablePage(currentPage);
                            }
                        });

                        $('#nextPage').off('click').on('click', function () {
                            if (currentPage < totalPages) {
                                currentPage++;
                                displayTablePage(currentPage);
                            }
                        });

                        $('#pageSelector').off('change').on('change', function () {
                            currentPage = parseInt($(this).val());
                            displayTablePage(currentPage);
                        });

                        $('#firstPage').off('click').on('click', function () {
                            currentPage = 1;
                            displayTablePage(currentPage);
                        });

                        $('#lastPage').off('click').on('click', function () {
                            currentPage = totalPages;
                            displayTablePage(currentPage);
                        });

                        let totalAmount = response.data.reduce((sum, item) => sum + parseFloat(item.withdraw_amt), 0);
                        $('#footerTotal').text('₱ ' + totalAmount.toLocaleString('en-US', { minimumFractionDigits: 2 }));

                    } else {
                        tbody.append('<tr><td colspan="7" class="text-center py-5"><i class="fas fa-inbox fa-3x text-muted mb-3"></i><br><span class="text-muted">No withdrawal history found</span></td></tr>');
                        $('#footerTotal').text('₱0.00');
                        $('.pagination-container').hide();
                    }

                    $('#withdrawHistoryModal').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Failed to load withdrawal history'
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.close();
                console.error('AJAX Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while loading data'
                });
            }
        });
    });

    // Edit Withdrawal
    $(document).on('click', '.edit-withdrawal', function () {
        const id = $(this).data('id');
        const amount = $(this).data('amount');
        const category = $(this).data('category');
        const note = $(this).data('note');
        const date = $(this).data('date');

        Swal.fire({
            title: 'Edit Withdrawal',
            html: `
            <div class="text-start">
                <div class="mb-3">
                    <label class="form-label fw-bold">Amount</label>
                    <input type="number" class="form-control" id="edit_amount" value="${amount}" step="0.01" min="0">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Category</label>
                    <select class="form-select" id="edit_category">
                        <option value="processing_fee" ${category === 'processing_fee' ? 'selected' : ''}>Processing Fee</option>
                        <option value="ticket" ${category === 'ticket' ? 'selected' : ''}>Ticket</option>
                        <option value="profit" ${category === 'profit' ? 'selected' : ''}>Profit</option>
                        <option value="expansion" ${category === 'expansion' ? 'selected' : ''}>Expansion</option>
                        <option value="capital" ${category === 'capital' ? 'selected' : ''}>Capital</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Notes</label>
                    <textarea class="form-control" id="edit_notes" rows="2">${note}</textarea>
                </div>
            </div>
        `,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                return {
                    amount: $('#edit_amount').val(),
                    category: $('#edit_category').val(),
                    notes: $('#edit_notes').val()
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = result.value;

                Swal.fire({
                    title: 'Processing...',
                    html: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url() ?>PullOut_cont/update_withdrawal',
                    method: 'POST',
                    data: {
                        id: id,
                        amount: data.amount,
                        category: data.category,
                        notes: data.notes
                    },
                    dataType: 'json',
                    success: function (res) {
                        Swal.close();
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: res.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                $('#withdrawHistoryBtn').click();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message
                            });
                        }
                    },
                    error: function (err) {
                        Swal.close();
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Check console for details'
                        });
                    }
                });
            }
        });
    });

    // Delete Withdrawal
    $(document).on('click', '.delete-withdrawal', function () {
        const id = $(this).data('id');
        const amount = $(this).data('amount');
        const category = $(this).data('category');

        Swal.fire({
            title: 'Delete Withdrawal?',
            html: `Are you sure you want to delete this withdrawal of <strong>₱${parseFloat(amount).toLocaleString('en-US', { minimumFractionDigits: 2 })}</strong>?<br><small>This action cannot be undone.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing...',
                    html: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url() ?>PullOut_cont/delete_withdrawal',
                    method: 'POST',
                    data: {
                        id: id,
                        amount: amount,
                        category: category
                    },
                    dataType: 'json',
                    success: function (res) {
                        Swal.close();
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Deleted',
                                text: res.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                $('#withdrawHistoryBtn').click();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message
                            });
                        }
                    },
                    error: function (err) {
                        Swal.close();
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Check console for details'
                        });
                    }
                });
            }
        });
    });

    // Return Withdrawal Amount
    $(document).on('click', '.return-withdrawal', function () {
        const id = $(this).data('id');
        const amount = $(this).data('amount');
        const category = $(this).data('category');

        const categoryLabels = {
            'processing_fee': 'Processing Fee',
            'ticket': 'Ticket',
            'profit': 'Profit',
            'expansion': 'Expansion',
            'capital': 'Capital'
        };

        Swal.fire({
            title: 'Return Amount?',
            html: `Are you sure you want to return <strong>₱${parseFloat(amount).toLocaleString('en-US', { minimumFractionDigits: 2 })}</strong> to <strong>${categoryLabels[category] || category}</strong>?<br><small>This will restore the amount to the selected category.</small>`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, return',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing...',
                    html: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url() ?>PullOut_cont/return_withdrawal',
                    method: 'POST',
                    data: {
                        id: id,
                        amount: amount,
                        category: category
                    },
                    dataType: 'json',
                    success: function (res) {
                        Swal.close();
                        if (res.status === 'success') {
                            Swal.fire({
                                title: 'Success',
                                text: res.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                $('#withdrawHistoryBtn').click();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message
                            });
                        }
                    },
                    error: function (err) {
                        Swal.close();
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Server Error',
                            text: 'Check console for details'
                        });
                    }
                });
            }
        });
    });


</script>