<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><strong>Ticket</strong> Details</h1>
    <div>
        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#updateTicketModal">Update Ticket</button>
        <a href="/engineer" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<!-- Update Ticket Modal -->
<div class="modal fade" id="updateTicketModal" tabindex="-1" aria-labelledby="updateTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTicketModalLabel">Update Ticket Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="ticketStatus" class="form-label">Select Status</label>
                    <select class="form-select" id="ticketStatus">
                        <option value="WAIT FOR PART">WAIT FOR PART</option>
                        <option value="WAIT FOR DATA">WAIT FOR DATA</option>
                        <option value="WAIT FOR PASSWORD">WAIT FOR PASSWORD</option>
                        <option value="WAIT FOR PRICE">WAIT FOR PRICE</option>
                        <option value="WAIT FOR REPLACEMENT">WAIT FOR REPLACEMENT</option>
                        <option value="WAIT FOR UNIT">WAIT FOR UNIT</option>
                        <option value="WAIT FOR ESCALATION">WAIT FOR ESCALATION</option>
                        <option value="WAIT FOR PICKUP">WAIT FOR PICKUP</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ticketNote" class="form-label">Note</label>
                    <textarea class="form-control" id="ticketNote" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateTicketBtn">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
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

    <div class="row">
        <div class="col-12 col-xl-6">
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

        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Parts Assigned</h5>
                </div>
                <div class="card-body">
                    <div id="parts-logs">
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
</div>

<div class="modal fade" id="usePartModal" tabindex="-1" aria-labelledby="usePartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usePartModalLabel">Use Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="usePartId">
                <input type="hidden" id="usePartName">
                <div class="mb-3">
                    <label for="usePartNote" class="form-label">Note</label>
                    <textarea class="form-control" id="usePartNote" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmUsePart">Proceed</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancelPartModal" tabindex="-1" aria-labelledby="cancelPartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelPartModalLabel">Cancel Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="cancelPartId">
                <input type="hidden" id="cancelPartName">
                <div class="mb-3">
                    <label for="cancelPartNote" class="form-label">Note</label>
                    <textarea class="form-control" id="cancelPartNote" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmCancelPart">Proceed</button>
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
    const username = '<?= session('name') ?>';

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

            // Fetch parts history
            fetch('/parts/get', {
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
                console.log('Parts Assigned:');
                console.log(JSON.stringify(data, null, 2));

                // Filter only ASSIGNED parts
                const assignedParts = data.filter(part => part.status === "ASSIGNED");

                if (assignedParts.length === 0) {
                    document.getElementById('parts-logs').innerHTML = `
                        <div class="text-center">No parts assigned</div>
                    `;
                    return;
                }

                const partsTableHtml = `
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Part ID</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Type</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${assignedParts.map(part => `
                                    <tr>
                                        <td>${part.part_id}</td>
                                        <td>${part.part_name || '-'}</td>
                                        <td>${part.brand || '-'}</td>
                                        <td>${part.type || '-'}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-sm use-part-btn" 
                                                    data-part-id="${part.part_id}"
                                                    data-part-name="${part.part_name || '-'}">
                                                    Use
                                                </button>
                                                <button class="btn btn-danger btn-sm cancel-part-btn" 
                                                    data-part-id="${part.part_id}"
                                                    data-part-name="${part.part_name || '-'}">
                                                    Cancel
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                `;

                document.getElementById('parts-logs').innerHTML = partsTableHtml;

                // Add event listeners for Use Part buttons
                document.querySelectorAll('.use-part-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const partId = this.getAttribute('data-part-id');
                        const partName = this.getAttribute('data-part-name');
                        document.getElementById('usePartId').value = partId;
                        document.getElementById('usePartName').value = partName;
                        const modal = new bootstrap.Modal(document.getElementById('usePartModal'));
                        modal.show();
                    });
                });

                // Add event listeners for Cancel Part buttons
                document.querySelectorAll('.cancel-part-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const partId = this.getAttribute('data-part-id');
                        const partName = this.getAttribute('data-part-name');
                        document.getElementById('cancelPartId').value = partId;
                        document.getElementById('cancelPartName').value = partName;
                        const modal = new bootstrap.Modal(document.getElementById('cancelPartModal'));
                        modal.show();
                    });
                });
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('parts-logs').innerHTML = `
                    <div class="alert alert-danger">
                        Error loading parts assigned
                    </div>
                `;
            });
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

    // Add event listener for update ticket button
    document.getElementById('updateTicketBtn').addEventListener('click', function() {
        const status = document.getElementById('ticketStatus').value;
        const note = document.getElementById('ticketNote').value;

        if (!status || !note) {
            alert('Please fill in all fields');
            return;
        }

        fetch('/ticket/update/engineer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                rma: rma,
                ticket_status: status,
                note: note,
                user: username
            })
        })
        .then(response => response.json())
        .then(data => {
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('updateTicketModal'));
            modal.hide();
            
            // Reload the page to show updated status
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating ticket');
        });
    });

    // Handle Use Part confirmation
    document.getElementById('confirmUsePart').addEventListener('click', function() {
        const partId = document.getElementById('usePartId').value;
        const partName = document.getElementById('usePartName').value;
        const note = document.getElementById('usePartNote').value;

        if (!note) {
            alert('Please enter a note');
            return;
        }

        fetch('/parts/use', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                part_id: partId,
                part_name: partName,
                rma: rma,
                engineer: username,
                note: note
            })
        })
        .then(response => response.json())
        .then(data => {
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('usePartModal'));
            modal.hide();
            
            // Reload the page to show updated status
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error using part');
        });
    });

    // Handle Cancel Part confirmation
    document.getElementById('confirmCancelPart').addEventListener('click', function() {
        const partId = document.getElementById('cancelPartId').value;
        const partName = document.getElementById('cancelPartName').value;
        const note = document.getElementById('cancelPartNote').value;

        if (!note) {
            alert('Please enter a note');
            return;
        }

        // Show Sweet Alert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/parts/cancel', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        part_id: partId,
                        part_name: partName,
                        rma: rma,
                        engineer: username,
                        note: note
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Close the modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('cancelPartModal'));
                    modal.hide();
                    
                    // Reload the page to show updated status
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error canceling part');
                });
            }
        });
    });
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