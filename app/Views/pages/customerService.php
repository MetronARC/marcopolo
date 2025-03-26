<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><strong>Customer Service</strong> Dashboard</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerTicketModal">
        <i class="align-middle" data-feather="plus"></i> Register Ticket
    </button>
</div>

<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <b>Tickets</b>
                <button class="btn btn-success float-end me-2" onclick="loadTickets()"><i class="fa-solid fa-arrows-rotate fa-spin"></i></button>
                <button class="btn btn-info float-end me-2" data-bs-toggle="modal" data-bs-target="#searchTicketModal"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                        <th>Action</th>
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
                            <input type="email" class="form-control" id="customer_email" name="customer_email">
                        </div>
                        <div class="col-md-6">
                            <label for="customer_address" class="form-label">Customer Address</label>
                            <input type="text" class="form-control" id="customer_address" name="customer_address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="device" class="form-label">Device</label>
                            <select class="form-select" id="device" name="device" required>
                            <option value="">Select Device</option>
                            </select>
                            <input type="text" id="customdevice" name="customdevice" class="form-control mt-2" placeholder="Enter device name" style="display: none;">
                        </div>
                        <div class="col-md-4">
                            <label for="brand" class="form-label">Brand</label>
                            <select class="form-select" id="brand" name="brand" required>
                                <option value="">Select Brand</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="service_no" class="form-label">Service Number</label>
                            <input type="text" class="form-control" id="service_no" name="service_no">
                        </div>
                        <div class="col-md-4">
                            <label for="sn" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="sn" name="sn" required>
                        </div>
                        <div class="col-md-4">
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
                            <input type="text" class="form-control" id="warranty_date" name="warranty_date" required placeholder="Enter warranty date">
                        </div>
                        <div class="col-md-6">
                            <label for="device_condition" class="form-label">Device Status</label>
                            <select class="form-select" id="device_condition" name="device_condition">
                                <option value="Unit Customer">Unit Customer</option>
                                <option value="Stock Toko">Stock Toko</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="problem" class="form-label">Problem</label>
                        <input type="text" class="form-control" id="problem" name="problem" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail_problem" class="form-label">Detail Problem</label>
                        <textarea class="form-control" id="detail_problem" name="detail_problem" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="accessories" class="form-label">Accessories</label>
                        <textarea class="form-control" id="accessories" name="accessories" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="engineer" class="form-label">Engineer</label>
                        <select class="form-select" id="engineer" name="engineer" required>
                            <option value="">Select Engineer</option>
                        </select>
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

<div class="modal fade" id="updateTicketModal" tabindex="-1" aria-labelledby="updateTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTicketModalLabel">Update Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateTicketForm">
                <div class="modal-body">
                    <input type="hidden" id="update_rma" name="rma">
                    <input type="hidden" id="update_user" name="user" value="<?= session('name') ?>">

                    <div class="mb-3">
                        <label for="ticket_status" class="form-label">Status</label>
                        <select class="form-select" id="ticket_status" name="ticket_status" required>
                            <option value="">Select Status</option>
                            <option value="CHECKING">CHECKING</option>
                            <option value="FINISHED">FINISHED</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                    </div>

                    <div id="paymentDetails" style="display: none;">
                        <div class="mb-3">
                            <label for="payment" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment" name="payment">
                                <option value="TUNAI">TUNAI</option>
                                <option value="Transfer">Transfer</option>
                                <option value="QRIS">QRIS</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Debit Card">Debit Card</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="payment_amount" class="form-label">Payment Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="payment_amount" name="payment_amount">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="payment_note" class="form-label">Payment Note</label>
                            <textarea class="form-control" id="payment_note" name="payment_note" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="searchTicketModal" tabindex="-1" aria-labelledby="searchTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchTicketModalLabel">Search Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="searchTicketForm">
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="search_rma" class="form-label">Ticket ID</label>
                            <input type="text" class="form-control" id="search_rma" name="search_rma">
                        </div>
                        <div class="col">
                            <label for="search_engineer" class="form-label">Engineer</label>
                            <select class="form-control" id="search_engineer" name="search_engineer"></select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="search_status" class="form-label">Status</label>
                            <select class="form-control" id="search_status" name="search_status">
                                <option value="">Select Status</option>
                                <option value="CHECKING">CHECKING</option>
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
                        <div class="col">
                            <label for="search_device" class="form-label">Device</label>
                            <select class="form-control" id="search_device" name="search_device"></select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="search_startdate" class="form-label">Date Start</label>
                            <input type="date" class="form-control" id="search_startdate" name="search_startdate">
                        </div>
                        <div class="col">
                            <label for="search_enddate" class="form-label">Date End</label>
                            <input type="date" class="form-control" id="search_enddate" name="search_enddate">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Search Ticket</button>
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
                            let updateButton = '';
                            if (ticket.ticket_status == 'WAIT FOR PICKUP') {
                                updateButton = `
                                    <button type="button" class="btn btn-sm btn-primary update-ticket-btn me-2" 
                                        data-rma="${ticket.rma}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateTicketModal">
                                        Update Ticket
                                    </button>
                                `
                            }
                            row.innerHTML = `
                                <td>${ticket.rma}</td>
                                <td>${ticket.customer_name}</td>
                                <td class="d-none d-xl-table-cell">${formatDate(ticket.created_at)}</td>
                                <td class="d-none d-xl-table-cell">${ticket.close_date ? formatDate(ticket.close_date) : '-'}</td>
                                <td><span class="badge bg-${getStatusColor(ticket.ticket_status)}">${ticket.ticket_status}</span></td>
                                <td class="d-none d-md-table-cell">${ticket.engineer || '-'}</td>
                                <td>
                                    ${updateButton}
                                    <a class="btn btn-sm btn-success" href="/ticket/ticketprint/${ticket.rma}" target="_blank"><i class="fa-solid fa-print"></i> Print</a> 
                                </td>
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
            await loadBrands();
            await loadEngineer();
            await loadDevice();
        } catch (error) {
            console.error('Failed to load initial data:', error);
        }

        document.getElementById('ticket_status').addEventListener('change', function() {
            const paymentDetails = document.getElementById('paymentDetails');
            if (this.value === 'FINISHED') {
                paymentDetails.style.display = 'block';
                document.getElementById('payment').required = true;
                document.getElementById('payment_amount').required = true;
            } else {
                paymentDetails.style.display = 'none';
                document.getElementById('payment').required = false;
                document.getElementById('payment_amount').required = false;
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('update-ticket-btn')) {
                const rma = e.target.getAttribute('data-rma');
                document.getElementById('update_rma').value = rma;
            }
        });

        document.getElementById('updateTicketForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            try {
                const response = await fetch('/ticket/update/cs', {
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('updateTicketModal'));
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
                    text: 'An error occurred while updating the ticket.',
                });
            }
        });
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
                const modalElement = document.getElementById('registerTicketModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();
                document.body.classList.remove('modal-open');
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
                
                this.reset();
                await loadTickets();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
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

    document.getElementById('searchTicketForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch('/ticket/search', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data) {
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
                            if (ticket.ticket_status == 'WAIT FOR PICKUP') {
                                updateButton = `
                                    <button type="button" class="btn btn-sm btn-primary update-ticket-btn me-2" 
                                        data-rma="${ticket.rma}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateTicketModal">
                                        Update Ticket
                                    </button>
                                `
                            }
                            row.innerHTML = `
                                <td>${ticket.rma}</td>
                                <td>${ticket.customer_name}</td>
                                <td class="d-none d-xl-table-cell">${formatDate(ticket.created_at)}</td>
                                <td class="d-none d-xl-table-cell">${ticket.close_date ? formatDate(ticket.close_date) : '-'}</td>
                                <td><span class="badge bg-${getStatusColor(ticket.ticket_status)}">${ticket.ticket_status}</span></td>
                                <td class="d-none d-md-table-cell">${ticket.engineer || '-'}</td>
                                <td>
                                    ${updateButton}
                                    <a class="btn btn-sm btn-success" href="/ticket/ticketprint/${ticket.rma}" target="_blank"><i class="fa-solid fa-print"></i> Print</a> 
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    }
                const modal = bootstrap.Modal.getInstance(document.getElementById('searchTicketModal'));
                modal.hide();
                this.reset();
            } else {
                throw new Error('No ticket found');
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while search the ticket.',
            });
        }
    });

    document.getElementById("device").addEventListener("change", function () {
        var customInput = document.getElementById("customdevice");
        if (this.value === "other") {
            customInput.style.display = "block";
            customInput.setAttribute("required", "required");
        } else {
            customInput.style.display = "none";
            customInput.removeAttribute("required");
        }
    });

    async function loadBrands() {
        try {
            const response = await fetch('/brand/get');
            const data = await response.json();
            console.log('Brand Data:', data);

            const brandSelect = document.getElementById('brand');
            brandSelect.innerHTML = '<option value="">Select Brand</option>';

            data.forEach(brand => {
                const option = document.createElement('option');
                option.value = brand.brand;
                option.textContent = brand.brand;
                brandSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading brands:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to load brands. Please refresh the page.',
            });
        }
    }

    async function loadEngineer() {
        try {
            const response = await fetch('/user/get/ENGINEER');
            const data = await response.json();
            console.log('Engineer Data:', data);

            const engineerSelect = document.getElementById('engineer');
            engineerSelect.innerHTML = '<option value="">Select Engineer</option>';

            data.forEach(user => {
                const option = document.createElement('option');
                option.value = user.name;
                option.textContent = user.name;
                engineerSelect.appendChild(option);
            });

            const engineersearchSelect = document.getElementById('search_engineer');
            engineersearchSelect.innerHTML = '<option value="">Select Engineer</option>';

            data.forEach(user => {
                const option = document.createElement('option');
                option.value = user.name;
                option.textContent = user.name;
                engineersearchSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading engineer:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to load engineer. Please refresh the page.',
            });
        }
    }

    async function loadDevice() {
        try {
            const response = await fetch('/device/get');
            const data = await response.json();
            console.log('Device Data:', data);

            const deviceSelect = document.getElementById('device');
            deviceSelect.innerHTML = '<option value="">Select Device</option>';

            data.forEach(device => {
                const option = document.createElement('option');
                option.value = device.device;
                option.textContent = device.device;
                deviceSelect.appendChild(option);
            });

            const otheroption = document.createElement('option');
            otheroption.value = 'other';
            otheroption.textContent = '+ Add New Device';
            deviceSelect.appendChild(otheroption);

            const devicesearchSelect = document.getElementById('search_device');
            devicesearchSelect.innerHTML = '<option value="">Select Device</option>';

            data.forEach(device => {
                const option = document.createElement('option');
                option.value = device.device;
                option.textContent = device.device;
                devicesearchSelect.appendChild(option);
            });
            
        } catch (error) {
            console.error('Error loading device:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to load device. Please refresh the page.',
            });
        }
    }
</script>

<?= $this->endSection() ?>