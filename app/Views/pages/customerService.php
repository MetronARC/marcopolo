<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><strong>Ticket</strong> Table</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerTicketModal">
        <i class="align-middle" data-feather="plus"></i> Register Ticket
    </button>
</div>

<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Latest Tickets</h5>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>RMA</th>
                        <th>Customer Name</th>
                        <th class="d-none d-xl-table-cell">Start Date</th>
                        <th class="d-none d-xl-table-cell">End Date</th>
                        <th>Status</th>
                        <th class="d-none d-md-table-cell">Engineer</th>
                    </tr>
                </thead>
                <tbody id="ticketTableBody">
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Register Ticket Modal -->
<div class="modal fade" id="registerTicketModal" tabindex="-1" aria-labelledby="registerTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerTicketModalLabel">Register New Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="registerTicketForm" action="/ticket/create" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="user" name="user" value="<?= session()->get('username') ?>">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_phone" class="form-label">Customer Phone</label>
                            <input type="text" class="form-control" id="customer_phone" name="customer_phone" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="customer_email" class="form-label">Customer Email</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                        </div>
                        <div class="col-md-6">
                            <label for="customer_address" class="form-label">Customer Address</label>
                            <input type="text" class="form-control" id="customer_address" name="customer_address" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="device" class="form-label">Device</label>
                            <input type="text" class="form-control" id="device" name="device" required>
                        </div>
                        <div class="col-md-4">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>
                        <div class="col-md-4">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sn" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="sn" name="sn" required>
                        </div>
                        <div class="col-md-6">
                            <label for="warranty" class="form-label">Warranty</label>
                            <select class="form-select" id="warranty" name="warranty" required>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="warranty_date" class="form-label">Warranty Date</label>
                            <input type="date" class="form-control" id="warranty_date" name="warranty_date">
                        </div>
                        <div class="col-md-6">
                            <label for="device_condition" class="form-label">Device Condition</label>
                            <input type="text" class="form-control" id="device_condition" name="device_condition" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="problem" class="form-label">Problem</label>
                        <input type="text" class="form-control" id="problem" name="problem" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail_problem" class="form-label">Detail Problem</label>
                        <textarea class="form-control" id="detail_problem" name="detail_problem" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="accessories" class="form-label">Accessories</label>
                        <textarea class="form-control" id="accessories" name="accessories" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="engineer" class="form-label">Engineer</label>
                        <input type="text" class="form-control" id="engineer" name="engineer" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Register Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function loadTickets() {
        return new Promise((resolve, reject) => {
            fetch('/ticket/unfinish/cs', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Ticket Data:', data);
                    const tableBody = document.getElementById('ticketTableBody');
                    tableBody.innerHTML = '';

                    if (data.length === 0) {
                        tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center">No tickets found</td>
                    </tr>
                `;
                    } else {
                        data.forEach(ticket => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${ticket.rma}</td>
                        <td>${ticket.customer_name}</td>
                        <td class="d-none d-xl-table-cell">${formatDate(ticket.created_at)}</td>
                        <td class="d-none d-xl-table-cell">${ticket.close_date ? formatDate(ticket.close_date) : '-'}</td>
                        <td><span class="badge bg-${getStatusColor(ticket.ticket_status)}">${ticket.ticket_status}</span></td>
                        <td class="d-none d-md-table-cell">${ticket.engineer || '-'}</td>
                    `;
                            tableBody.appendChild(row);
                        });
                    }
                    resolve();
                })
                .catch(error => {
                    console.error('Error:', error);
                    const tableBody = document.getElementById('ticketTableBody');
                    tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-danger">Error loading tickets</td>
                </tr>
            `;
                    reject(error);
                });
        });
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-GB');
    }

    function getStatusColor(status) {
        switch (status) {
            case 'CHECKING':
                return 'warning';
            case 'WAIT FOR PART':
                return 'info';
            case 'WAIT FOR PICKUP':
                return 'success';
            default:
                return 'secondary';
        }
    }

    document.addEventListener('DOMContentLoaded', async function() {
        try {
            await loadTickets();
        } catch (error) {
            console.error('Failed to load tickets:', error);
        }
    });

    document.getElementById('registerTicketForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const user = '<?= session('name') ?>'; 
        formData.append('user', user);

        try {
            const response = await fetch('/ticket/create', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.message) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                const modal = bootstrap.Modal.getInstance(document.getElementById('registerTicketModal'));
                modal.hide();
                this.reset();
                await loadTickets();
            } else {
                throw new Error('No response message received');
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while registering the ticket.',
            });
        }
    });
</script>

<?= $this->endSection() ?>