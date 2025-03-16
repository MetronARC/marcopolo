<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0"><strong>Ticket</strong> Table for Engineer: <?= session('name') ?></h1>
</div>

<div class="row">
    <div class="col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Latest Projects</h5>
            </div>
            <table class="table table-hover my-0" id="ticket-table">
                <thead>
                    <tr>
                        <th>RMA</th>
                        <th>Customer Name</th>
                        <th class="d-none d-xl-table-cell">Created Date</th>
                        <th>Status</th>
                        <th class="d-none d-md-table-cell">Engineer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">
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
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
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
                            <td colspan="5" class="text-center">No tickets found</td>
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
                        <td colspan="5" class="text-center text-danger">Error loading tickets</td>
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

<?= $this->endSection() ?>