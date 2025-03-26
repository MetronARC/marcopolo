<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3">All Tickets</h1>

    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <button class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#searchTicketModal">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <table id="ticketTable" class="table table-striped table-hover dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>RMA</th>
                        <th>Customer Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Engineer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">
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
                                <option value="FINISHED">FINISHED</option>
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
$(document).ready(function() {
    function formatDate(dateString) {
        if (!dateString || dateString === '0000-00-00' || dateString === 'null') return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    $('#ticketTable').DataTable({
        responsive: true,
        processing: false,
        serverSide: false,
        pageLength: 10,
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
        },
        ajax: {
            url: '/ticket/unfinish/cs',
            type: 'POST',
            dataType: 'json',
            error: function(xhr, error, thrown) {
                console.error('AJAX Error:', error);
                console.error('Details:', thrown);
                console.error('Response:', xhr.responseText);
            },
            dataSrc: function(response) {
                console.log('Raw Response:', response);
                
                if (response && !Array.isArray(response)) {
                    if (response.data) {
                        response = response.data;
                    } else {
                        response = [response];
                    }
                }
                
                console.log('Processed Response:', response);
                return response;
            }
        },
        columns: [
            { 
                data: 'rma',
                render: function(data, type, row) {
                    return data || '-';
                }
            },
            { 
                data: 'customer_name',
                render: function(data) {
                    return data || '-';
                }
            },
            { 
                data: 'created_at',
                render: function(data) {
                    return formatDate(data);
                }
            },
            { 
                data: 'close_date',
                render: function(data) {
                    return formatDate(data);
                }
            },
            { 
                data: 'ticket_status',
                render: function(data) {
                    let badgeClass = 'badge bg-';
                    switch(data) {
                        case 'CHECKING':
                            badgeClass += 'warning';
                            break;
                        case 'DONE':
                            badgeClass += 'success';
                            break;
                        case 'PENDING':
                            badgeClass += 'danger';
                            break;
                        default:
                            badgeClass += 'secondary';
                    }
                    return '<span class="' + badgeClass + '">' + (data || 'N/A') + '</span>';
                }
            },
            { 
                data: 'engineer',
                render: function(data) {
                    return data || '-';
                }
            },
            {
                data: 'rma',
                render: function(data, type, row) {
                    return `
                        <form action="/set_view_ticket" method="POST" class="d-inline">
                            <input type="hidden" name="rma" value="${data}">
                            <button type="submit" class="btn btn-primary btn-sm">View Ticket</button>
                        </form>
                    `;
                }
            }
        ],
        order: [[2, 'desc']]
    });

    async function loadEngineer() {
        try {
            const response = await fetch('/user/get/ENGINEER');
            const data = await response.json();
            console.log('Engineer Data:', data);

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

    // Load engineer and device data when page loads
    loadEngineer();
    loadDevice();

    // Handle search form submission
    $('#searchTicketForm').on('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch('/ticket/search', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data) {
                const table = $('#ticketTable').DataTable();
                table.clear();
                
                if (data.length === 0) {
                    table.draw();
                } else {
                    table.rows.add(data).draw();
                }

                // Properly close the modal and clean up
                const modalElement = document.getElementById('searchTicketModal');
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();
                
                // Remove modal backdrop and reset body classes
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
                $('body').css('padding-right', '');
                
                this.reset();
            } else {
                throw new Error('No ticket found');
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'An error occurred while searching for tickets.',
            });
        }
    });
});
</script>

<?= $this->endSection() ?>