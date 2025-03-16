<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>

<div class="container-fluid">
    <!-- Header Section with Insert Button -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Parts Management</h6>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertPartModal">
                <i class="align-middle" data-feather="plus"></i> Insert Part
            </button>
        </div>
    </div>

    <!-- Search Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Search Parts</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <select class="form-select" id="searchBrand">
                            <option value="">Select brand...</option>
                            <option value="HP">HP</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchType" placeholder="Search by type...">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchName" placeholder="Search by name...">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 text-end">
                    <button class="btn btn-primary" type="button" id="searchButton">
                        <i class="align-middle" data-feather="search"></i> Search Parts
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="searchPartsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Part ID</th>
                            <th>Device</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Insert Part Modal -->
<div class="modal fade" id="insertPartModal" tabindex="-1" aria-labelledby="insertPartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertPartModalLabel">Insert New Part</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="insertPartForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="device" class="form-label">Device</label>
                        <input type="text" class="form-control" id="device" name="device" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-text">Enter price in Rupiah</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Insert Part</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assign to Ticket Modal -->
<div class="modal fade" id="assignTicketModal" tabindex="-1" aria-labelledby="assignTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignTicketModalLabel">Assign Part to Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="ticketsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>RMA</th>
                                <th>Customer</th>
                                <th>Device</th>
                                <th>Problem</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Tickets will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    const insertModal = new bootstrap.Modal(document.getElementById('insertPartModal'));
    const assignTicketModal = new bootstrap.Modal(document.getElementById('assignTicketModal'));
    const user = '<?= session('name') ?>';

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

    $('#insertPartForm').on('submit', function(e) {
        e.preventDefault();

        const formData = {
            device: $('#device').val(),
            brand: $('#brand').val(),
            type: $('#type').val(),
            name: $('#name').val(),
            price: $('#price').val()
        };

        // Send AJAX request to insert part
        $.ajax({
            url: '<?= base_url('parts/insert') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Close the modal and reset form
                insertModal.hide();
                $('#insertPartForm')[0].reset();

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 1500
                }).then(() => {
                    // Refresh the search results if any search parameters are set
                    if ($('#searchBrand').val() || $('#searchType').val() || $('#searchName').val()) {
                        $('#searchButton').click();
                    }
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to insert part: ' + error,
                    confirmButtonColor: '#d33'
                });
            }
        });
    });

    // Handle Assign to Ticket button click
    $(document).on('click', '.assignToTicket', function() {
        const partId = $(this).data('part-id');
        const partName = $(this).data('part-name');
        
        // Load unfinished tickets
        $.ajax({
            url: '<?= base_url('ticket/unfinish/engineer') ?>?user=<?= session('name') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#ticketsTable tbody').empty();
                
                if (!response || response.length === 0) {
                    $('#ticketsTable tbody').append(`
                        <tr>
                            <td colspan="6" class="text-center">No unfinished tickets available</td>
                        </tr>
                    `);
                } else {
                    response.forEach(ticket => {
                        $('#ticketsTable tbody').append(`
                            <tr>
                                <td>${ticket.rma || ''}</td>
                                <td>${ticket.customer_name || ''}</td>
                                <td>${ticket.device || ''}</td>
                                <td>${ticket.problem || ''}</td>
                                <td><span class="badge bg-${getStatusColor(ticket.ticket_status)}">${ticket.ticket_status || ''}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary selectTicket" 
                                            data-rma="${ticket.rma}"
                                            data-part-id="${partId}"
                                            data-part-name="${partName}">
                                        Select
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                }
                
                assignTicketModal.show();
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load tickets: ' + error,
                    confirmButtonColor: '#d33'
                });
            }
        });
    });

    // Handle ticket selection
    $(document).on('click', '.selectTicket', function() {
        const rma = $(this).data('rma');
        const partId = $(this).data('part-id');
        const partName = $(this).data('part-name');
        
        // Directly assign the part to the ticket
        $.ajax({
            url: '<?= base_url('parts/assign') ?>',
            type: 'POST',
            data: {
                part_id: partId,
                rma: rma,
                part_name: partName,
                user: user
            },
            dataType: 'json',
            success: function(response) {
                assignTicketModal.hide();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    showConfirmButton: true,
                    timer: 1500
                }).then(() => {
                    // Refresh the search results
                    $('#searchButton').click();
                });
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to assign part: ' + error,
                    confirmButtonColor: '#d33'
                });
            }
        });
    });

    $('#searchButton').on('click', function() {
        const brand = $('#searchBrand').val();
        const type = $('#searchType').val();
        const name = $('#searchName').val();

        if (!brand && !type && !name) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please input at least 1 parameter',
                confirmButtonColor: '#3085d6'
            });
            return;
        }

        $.ajax({
            url: '<?= base_url('parts/search') ?>',
            type: 'POST',
            data: {},  // Send empty data to get all records
            success: function(response) {
                try {
                    const allData = JSON.parse(response);
                    
                    const filteredData = allData.filter(part => {
                        const matchBrand = !brand || part.brand.toLowerCase().includes(brand.toLowerCase());
                        const matchType = !type || part.type.toLowerCase().includes(type.toLowerCase());
                        const matchName = !name || part.name.toLowerCase().includes(name.toLowerCase());
                        return matchBrand && matchType && matchName;
                    });
                    
                    $('#searchPartsTable tbody').empty();
                    
                    if (!filteredData || filteredData.length === 0) {
                        $('#searchPartsTable tbody').append(`
                            <tr>
                                <td colspan="8" class="text-center">No parts found matching your search criteria</td>
                            </tr>
                        `);
                    } else {
                        filteredData.forEach(function(part) {
                            let actionButton = '';
                            if (part.status === 'STOCK') {
                                actionButton = `<button class="btn btn-sm btn-primary assignToTicket" 
                                    data-part-id="${part.part_id}"
                                    data-part-name="${part.name}">Assign to Ticket</button>`;
                            } else {
                                actionButton = `<span class="badge bg-secondary">No actions available</span>`;
                            }

                            $('#searchPartsTable tbody').append(`
                                <tr>
                                    <td>${part.part_id || ''}</td>
                                    <td>${part.device || ''}</td>
                                    <td>${part.brand || ''}</td>
                                    <td>${part.type || ''}</td>
                                    <td>${part.name || ''}</td>
                                    <td>${part.price ? 'Rp ' + parseFloat(part.price).toLocaleString('id-ID') : ''}</td>
                                    <td>${part.status || ''}</td>
                                    <td>${actionButton}</td>
                                </tr>
                            `);
                        });
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to parse search results: ' + e.message,
                        confirmButtonColor: '#d33'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to search parts: ' + error,
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});
</script>

<?= $this->endSection() ?>