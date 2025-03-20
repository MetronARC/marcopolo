<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><strong>Ticket</strong> Data for Engineer: <?= session('name') ?></h1>
</div>

<div class="w-100">
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
                    <h1 class="mt-1 mb-3" id="new-ticket-count">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
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
                    <h1 class="mt-1 mb-3" id="in-progress-count">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
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
                    <h1 class="mt-1 mb-3" id="wait-part-count">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
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
                    <h1 class="mt-1 mb-3" id="escalation-count">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
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
                    <h1 class="mt-1 mb-3" id="ready-pickup-count">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
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
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Latest Tickets</h5>
            </div>
            <table class="table table-hover my-0" id="ticket-table">
                <thead>
                    <tr>
                        <th>RMA</th>
                        <th>Customer Name</th>
                        <th class="d-none d-xl-table-cell">Created Date</th>
                        <th>Status</th>
                        <th class="d-none d-md-table-cell">Engineer</th>
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

<script>
    function loadTicketData() {
        const user = '<?= session('name') ?>';

        fetch(`/ticket/unfinish/engineer?user=${user}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                console.log('Fetched ticket data:');
                console.log(JSON.stringify(data, null, 2));
                const tbody = document.querySelector('#ticket-table tbody');
                tbody.innerHTML = '';

                if (data.length === 0) {
                    tbody.innerHTML = `
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
                            <td><span class="badge bg-${getStatusColor(ticket.ticket_status)}">${ticket.ticket_status}</span></td>
                            <td class="d-none d-md-table-cell">${ticket.engineer}</td>
                            <td>
                                <form action="/set_view_ticket" method="POST" class="d-inline">
                                    <input type="hidden" name="rma" value="${ticket.rma}">
                                    <button type="submit" class="btn btn-sm btn-info">View</button>
                                </form>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading ticket data:', error);
                const tbody = document.querySelector('#ticket-table tbody');
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center text-danger">Error loading tickets</td>
                    </tr>
                `;
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

    document.addEventListener('DOMContentLoaded', loadTicketData);
</script>

<script>
    function updateStats() {
        const user = '<?= session('name') ?>';
        fetch('/ticket/stat_engineer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    user: user
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Fetched ticket data:', data);
                document.getElementById('new-ticket-count').textContent = data['NEW'] || 0;
                document.getElementById('in-progress-count').textContent = data['CHECKING'] || 0;
                document.getElementById('wait-part-count').textContent = data['WAIT FOR PART'] || 0;
                document.getElementById('escalation-count').textContent = data['WAIT FOR ESCALATION'] || 0;
                document.getElementById('ready-pickup-count').textContent = data['WAIT FOR PICKUP'] || 0;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('new-ticket-count').textContent = 'Error';
                document.getElementById('in-progress-count').textContent = 'Error';
                document.getElementById('wait-part-count').textContent = 'Error';
                document.getElementById('escalation-count').textContent = 'Error';
                document.getElementById('ready-pickup-count').textContent = 'Error';
            });
    }
    updateStats();
</script>

<?= $this->endSection() ?>