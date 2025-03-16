<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><strong>Ticket</strong> Details</h1>
    <a href="/engineer" class="btn btn-secondary">Back to List</a>
</div>

<div class="row">
    <!-- Ticket Details Card -->
    <div class="col-12 col-xl-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Ticket Information</h5>
            </div>
            <div class="card-body">
                <div id="ticket-details">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Details Card -->
    <div class="col-12 col-xl-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div id="customer-details">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Device Details Card -->
    <div class="col-12 col-xl-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Device Information</h5>
            </div>
            <div class="card-body">
                <div id="device-details">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Details Card -->
    <div class="col-12 col-xl-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Status Information</h5>
            </div>
            <div class="card-body">
                <div id="status-details">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ticket Logs Card -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Ticket History</h5>
            </div>
            <div class="card-body">
                <div id="ticket-logs">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function getStatusBadge(status) {
    const colors = {
        'NEW': 'primary',
        'CHECKING': 'warning',
        'WAIT FOR PART': 'info',
        'WAIT FOR PICKUP': 'success',
        'CLOSED': 'secondary'
    };
    return `<span class="badge bg-${colors[status] || 'secondary'}">${status}</span>`;
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleString('en-GB', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const rma = '<?= session('view_ticket_rma') ?>';

    if (rma) {
        fetch(`/ticket/view`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                rma: rma
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Ticket Details:');
            console.log(JSON.stringify(data, null, 2));
            
            // Ticket Details
            document.getElementById('ticket-details').innerHTML = `
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">RMA</label>
                        <p>${data.rma}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Created Date</label>
                        <p>${formatDate(data.created_at)}</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Problem</label>
                        <p>${data.problem}</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Detail Problem</label>
                        <p>${data.detail_problem}</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Accessories</label>
                        <p>${data.accessories}</p>
                    </div>
                </div>
            `;

            // Customer Details
            document.getElementById('customer-details').innerHTML = `
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Name</label>
                        <p>${data.customer_name}</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Address</label>
                        <p>${data.customer_address}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Phone</label>
                        <p>${data.customer_phone}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <p>${data.customer_email}</p>
                    </div>
                </div>
            `;

            // Device Details
            document.getElementById('device-details').innerHTML = `
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Device</label>
                        <p>${data.device}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Brand</label>
                        <p>${data.brand}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Type</label>
                        <p>${data.type}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Serial Number</label>
                        <p>${data.sn}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Warranty</label>
                        <p>${data.warranty === "1" ? "Yes" : "No"}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Warranty Date</label>
                        <p>${data.warranty_date || '-'}</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Device Condition</label>
                        <p>${data.device_condition}</p>
                    </div>
                </div>
            `;

            // Status Details
            document.getElementById('status-details').innerHTML = `
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-bold">Current Status</label>
                        <p>${getStatusBadge(data.ticket_status)}</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Engineer</label>
                        <p>${data.engineer}</p>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Close Date</label>
                        <p>${data.close_date ? formatDate(data.close_date) : '-'}</p>
                    </div>
                </div>
            `;

            // Ticket Logs
            const logsHtml = data.log.map(log => `
                <div class="timeline-item">
                    <div class="row">
                        <div class="col-md-3">
                            <small class="text-muted">${formatDate(log.created_at)}</small>
                        </div>
                        <div class="col-md-3">
                            <span class="fw-bold">${log.user}</span>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">${log.note}</p>
                        </div>
                    </div>
                    <hr>
                </div>
            `).join('');

            document.getElementById('ticket-logs').innerHTML = `
                <div class="timeline">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <span class="text-muted">Date & Time</span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-muted">User</span>
                        </div>
                        <div class="col-md-6">
                            <span class="text-muted">Note</span>
                        </div>
                    </div>
                    ${logsHtml}
                </div>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('ticket-details').innerHTML = `
                <div class="alert alert-danger">
                    Error loading ticket details
                </div>
            `;
        });
    } else {
        document.getElementById('ticket-details').innerHTML = `
            <div class="alert alert-danger">
                No RMA provided
            </div>
        `;
    }
});
</script>

<style>
.timeline {
    position: relative;
    padding: 0;
}

.timeline-item {
    position: relative;
    padding: 1rem 0;
}

.form-label {
    margin-bottom: 0.2rem;
    color: #6c757d;
}

p {
    margin-bottom: 0;
}
</style>

<?= $this->endSection() ?> 