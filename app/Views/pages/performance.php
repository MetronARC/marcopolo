<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0" id="page-heading"><strong>Engineer Performance</strong></h1>
    <div style="width: 200px;">
        <select class="form-select" id="engineer-select">
            <option value="">All Engineers</option>
        </select>
    </div>
</div>

<div class="w-100 mb-3">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">New Ticket</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="file-plus"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        <span id="new-ticket-count" style="display: block;">0</span>
                        <div class="spinner-border spinner-border-sm text-primary d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h1>
                    <div class="mb-0">
                        <span class="text-muted">Unit</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">In Progress</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="activity"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        <span id="in-progress-count" style="display: block;">0</span>
                        <div class="spinner-border spinner-border-sm text-primary d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h1>
                    <div class="mb-0">
                        <span class="text-muted">Unit</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Wait For Part</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="cpu"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        <span id="wait-part-count" style="display: block;">0</span>
                        <div class="spinner-border spinner-border-sm text-primary d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h1>
                    <div class="mb-0">
                        <span class="text-muted">Unit</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Wait For Escalation</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="send"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        <span id="escalation-count" style="display: block;">0</span>
                        <div class="spinner-border spinner-border-sm text-primary d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h1>
                    <div class="mb-0">
                        <span class="text-muted">Unit</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mt-0">
                            <h5 class="card-title">Ready To Pickup</h5>
                        </div>
                        <div class="col-auto">
                            <div class="stat text-primary">
                                <i class="align-middle" data-feather="truck"></i>
                            </div>
                        </div>
                    </div>
                    <h1 class="mt-1 mb-3">
                        <span id="ready-pickup-count" style="display: block;">0</span>
                        <div class="spinner-border spinner-border-sm text-primary d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h1>
                    <div class="mb-0">
                        <span class="text-muted">Unit</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Latest Tickets</h5>
            </div>
            <div class="card-body px-4 py-3">
                <div class="table-responsive">
                    <table class="table table-hover table-striped display nowrap w-100" id="ticket-table" style="margin: 0 !important;">
                        <thead>
                            <tr>
                                <th>RMA</th>
                                <th>Customer Name</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Engineer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
    </div>
</div>

<script>
    let ticketTable;

    function showLoading() {
        // Show loading for status counts
        ['new-ticket-count', 'in-progress-count', 'wait-part-count', 'escalation-count', 'ready-pickup-count']
            .forEach(id => {
                const countEl = document.getElementById(id);
                const spinnerEl = countEl.nextElementSibling;
                countEl.style.display = 'none';
                spinnerEl.classList.remove('d-none');
            });
        
        // Show loading for table
        const tbody = document.querySelector('#ticket-table tbody');
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </td>
            </tr>
        `;
    }

    function hideLoading() {
        // Hide loading for status counts
        ['new-ticket-count', 'in-progress-count', 'wait-part-count', 'escalation-count', 'ready-pickup-count']
            .forEach(id => {
                const countEl = document.getElementById(id);
                const spinnerEl = countEl.nextElementSibling;
                countEl.style.display = 'block';
                spinnerEl.classList.add('d-none');
            });
    }

    function loadEngineers() {
        fetch('/user/get/ENGINEER', {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('engineer-select');
            select.innerHTML = '<option value="">All Engineers</option>'; // Reset and add default option
            data.forEach(engineer => {
                const option = document.createElement('option');
                option.value = engineer.name;
                option.textContent = engineer.name;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading engineers:', error);
        });
    }

    function resetCounts() {
        document.getElementById('new-ticket-count').textContent = '0';
        document.getElementById('in-progress-count').textContent = '0';
        document.getElementById('wait-part-count').textContent = '0';
        document.getElementById('escalation-count').textContent = '0';
        document.getElementById('ready-pickup-count').textContent = '0';
    }

    function loadTicketData(engineer = '') {
        showLoading();
        
        const url = engineer ? `/ticket/unfinish/engineer?user=${engineer}` : '/ticket/search';
        
        fetch(url, {
            method: engineer ? 'GET' : 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: engineer ? null : JSON.stringify({})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched ticket data:', data);

            if (!data || !Array.isArray(data)) {
                resetCounts();
                throw new Error('Invalid data format received');
            }

            const statusCounts = {
                'NEW': 0,
                'CHECKING': 0,
                'WAIT FOR PART': 0,
                'WAIT FOR ESCALATION': 0,
                'WAIT FOR PICKUP': 0
            };
            
            data.forEach(ticket => {
                if (statusCounts.hasOwnProperty(ticket.ticket_status)) {
                    statusCounts[ticket.ticket_status]++;
                }
            });
            
            document.getElementById('new-ticket-count').textContent = statusCounts['NEW'] || 0;
            document.getElementById('in-progress-count').textContent = statusCounts['CHECKING'] || 0;
            document.getElementById('wait-part-count').textContent = statusCounts['WAIT FOR PART'] || 0;
            document.getElementById('escalation-count').textContent = statusCounts['WAIT FOR ESCALATION'] || 0;
            document.getElementById('ready-pickup-count').textContent = statusCounts['WAIT FOR PICKUP'] || 0;

            if (ticketTable) {
                ticketTable.destroy();
            }

            ticketTable = $('#ticket-table').DataTable({
                data: data,
                responsive: true,
                processing: true,
                columns: [
                    { data: 'rma', width: '15%' },
                    { data: 'customer_name', width: '25%' },
                    { 
                        data: 'created_at',
                        width: '15%',
                        render: function(data) {
                            return formatDate(data);
                        }
                    },
                    { 
                        data: 'ticket_status',
                        width: '15%',
                        render: function(data) {
                            return `<span class="badge bg-${getStatusColor(data)}">${data}</span>`;
                        }
                    },
                    { 
                        data: 'engineer',
                        width: '15%'
                    },
                    { 
                        data: 'rma',
                        width: '15%',
                        orderable: false,
                        render: function(data) {
                            return `
                                <form action="/set_view_ticket" method="POST" class="d-inline">
                                    <input type="hidden" name="rma" value="${data}">
                                    <button type="submit" class="btn btn-sm btn-info">View</button>
                                </form>
                            `;
                        }
                    }
                ],
                pageLength: 10,
                order: [[2, 'desc']], // Sort by created date by default
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    },
                    processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                }
            });

            hideLoading();
        })
        .catch(error => {
            console.error('Error loading ticket data:', error);
            resetCounts();
            hideLoading();
            
            if (ticketTable) {
                ticketTable.destroy();
            }
            
            const tbody = document.querySelector('#ticket-table tbody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-danger">Error loading tickets</td>
                </tr>
            `;
            
            ticketTable = $('#ticket-table').DataTable({
                pageLength: 10
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
    
    document.getElementById('engineer-select').addEventListener('change', function() {
        loadTicketData(this.value);
        // Update heading based on selected engineer
        const heading = document.getElementById('page-heading');
        if (this.value) {
            heading.innerHTML = `<strong>Engineer Performance for ${this.value}</strong>`;
        } else {
            heading.innerHTML = '<strong>Engineer Performance</strong>';
        }
    });

    $(document).ready(function() {
        loadEngineers();
        loadTicketData();

        // Add DataTables wrapper styling after initialization
        $('#ticket-table_wrapper .dataTables_length, #ticket-table_wrapper .dataTables_filter').addClass('mb-3');
        $('#ticket-table_wrapper td, #ticket-table_wrapper th').addClass('px-3 py-2');
    });
</script>

<?= $this->endSection() ?>