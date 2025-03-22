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
                <div class="col-md-3">
                    <div class="input-group">
                        <select class="form-select" id="searchBrand">
                            <option value="">Select brand...</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <select class="form-select" id="searchType">
                            <option value="">Select type...</option>
                            <option value="Main Part">Main Part</option>
                            <option value="Non Returnable">Non Returnable</option>
                            <option value="Add up">Add up</option>
                            <option value="Tools">Tools</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchPartNumber" placeholder="Search by part number...">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchPartName" placeholder="Search by part name...">
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
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Part Number</th>
                            <th>Part Name</th>
                            <th>Part SN</th>
                            <th>Part Case No</th>
                            <th>AWB No</th>
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
                        <label for="brand" class="form-label">Brand</label>
                        <select class="form-select" id="brand" name="brand" required>
                            <option value="">Select brand...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Select type...</option>
                            <option value="Main Part">Main Part</option>
                            <option value="Non Returnable">Non Returnable</option>
                            <option value="Add up">Add up</option>
                            <option value="Tools">Tools</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="part_number" class="form-label">Part Number</label>
                        <input type="text" class="form-control" id="part_number" name="part_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="part_name" class="form-label">Part Name</label>
                        <input type="text" class="form-control" id="part_name" name="part_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="part_sn" class="form-label">Part SN</label>
                        <input type="text" class="form-control" id="part_sn" name="part_sn" required>
                    </div>
                    <div class="mb-3">
                        <label for="part_case_no" class="form-label">Part Case Number</label>
                        <input type="text" class="form-control" id="part_case_no" name="part_case_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="awb_no" class="form-label">AWB Number</label>
                        <input type="text" class="form-control" id="awb_no" name="awb_no" required>
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

    // Load brands for dropdown
    function loadBrands() {
        $.ajax({
            url: '<?= base_url('brand/get') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const brandDropdowns = $('#brand, #searchBrand');
                brandDropdowns.find('option:not(:first)').remove(); // Clear existing options except the first one
                
                response.forEach(function(brand) {
                    brandDropdowns.append(`<option value="${brand.brand}">${brand.brand}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to load brands:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to load brands: ' + error,
                    confirmButtonColor: '#d33'
                });
            }
        });
    }

    // Load brands when page loads
    loadBrands();

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
            brand: $('#brand').val(),
            type: $('#type').val(),
            part_number: $('#part_number').val(),
            part_name: $('#part_name').val(),
            part_sn: $('#part_sn').val(),
            part_case_no: $('#part_case_no').val(),
            awb_no: $('#awb_no').val()
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
                    if ($('#searchBrand').val() || $('#searchType').val() || $('#searchPartNumber').val() || $('#searchPartName').val()) {
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
        const partNumber = $('#searchPartNumber').val();
        const partName = $('#searchPartName').val();

        if (!brand && !type && !partNumber && !partName) {
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
                        const matchPartNumber = !partNumber || part.part_number.toLowerCase().includes(partNumber.toLowerCase());
                        const matchPartName = !partName || part.part_name.toLowerCase().includes(partName.toLowerCase());
                        return matchBrand && matchType && matchPartNumber && matchPartName;
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
                                    data-part-name="${part.part_name}">Assign to Ticket</button>`;
                            } else {
                                actionButton = `<span class="badge bg-secondary">No actions available</span>`;
                            }

                            $('#searchPartsTable tbody').append(`
                                <tr>
                                    <td>${part.part_id || ''}</td>
                                    <td>${part.brand || ''}</td>
                                    <td>${part.type || ''}</td>
                                    <td>${part.part_number || ''}</td>
                                    <td>${part.part_name || ''}</td>
                                    <td>${part.part_sn || ''}</td>
                                    <td>${part.part_case_no || ''}</td>
                                    <td>${part.awb_no || ''}</td>
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