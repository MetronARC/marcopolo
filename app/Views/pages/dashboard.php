<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>AppDesk</strong> Dashboard</h1>

    <div class="w-100">
        <div class="row">
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
            <div class="col-sm-3">
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
        <div class="col-12 col-md-12 col-xxl-4 d-flex order-2 order-xxl-3">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Device</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="py-3">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                        </div>

                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>Desktop</td>
                                    <td class="text-end">4306</td>
                                </tr>
                                <tr>
                                    <td>Laptop</td>
                                    <td class="text-end">3801</td>
                                </tr>
                                <tr>
                                    <td>Printer</td>
                                    <td class="text-end">1689</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-xxl-8 d-flex order-3 order-xxl-2">
            <div class="card flex-fill">
                <div class="card-header">

                    <h5 class="card-title mb-0">Latest Ticket</h5>
                </div>
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>RMA</th>
                            <th>Customer Name</th>
                            <th class="d-none d-xl-table-cell">Created Date</th>
                            <th class="d-none d-xl-table-cell">Close Date</th>
                            <th>Status</th>
                            <th class="d-none d-md-table-cell">Engineer</th>
                        </tr>
                    </thead>
                    <tbody id="latest-tickets-body">
                        <tr id="loading-row">
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

</div>

<script>
    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return dateString; // Return original string if invalid date
        
        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
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

    function updateStats() {
        fetch('/ticket/stat')
            .then(response => response.json())
            .then(data => {
                console.log('Ticket Statistics:', data);
                document.getElementById('new-ticket-count').textContent = data.new;
                document.getElementById('in-progress-count').textContent = data.checking;
                document.getElementById('wait-part-count').textContent = data.waitpart;
                document.getElementById('ready-pickup-count').textContent = data.waitpickup;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('new-ticket-count').textContent = 'Error';
                document.getElementById('in-progress-count').textContent = 'Error';
                document.getElementById('wait-part-count').textContent = 'Error';
                document.getElementById('ready-pickup-count').textContent = 'Error';
            });
    }

    function updateLatestTickets() {
        fetch('/ticket/unfinish/checkin', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('latest-tickets-body');
                console.log(data)
                tbody.innerHTML = ''; // Clear loading state

                if (data.length === 0) {
                    tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center">No tickets found</td>
                    </tr>
                `;
                    return;
                }

                data.forEach(ticket => {
                    const row = `
                    <tr>
                        <td>${ticket.rma}</td>
                        <td>${ticket.customer_name}</td>
                        <td class="d-none d-xl-table-cell">${formatDate(ticket.created_at)}</td>
                        <td class="d-none d-xl-table-cell">${ticket.close_date ? formatDate(ticket.close_date) : '-'}</td>
                        <td><span class="badge bg-${getStatusColor(ticket.ticket_status)}">${ticket.ticket_status}</span></td>
                        <td class="d-none d-md-table-cell">${ticket.engineer || '-'}</td>
                    </tr>
                `;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                const tbody = document.getElementById('latest-tickets-body');
                tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center text-danger">Error loading tickets</td>
                </tr>
            `;
            });
    }

    // Initial load
    updateStats();
    updateLatestTickets();

    // Refresh data every 30 seconds
    setInterval(() => {
        updateStats();
        updateLatestTickets();
    }, 30000);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let deviceChart = null;

        function updateDeviceChart() {
            fetch('/ticket/stat_device')
                .then(response => response.json())
                .then(data => {
                    console.log('Device Statistics:', data);
                    
                    // Destroy existing chart if it exists
                    if (deviceChart) {
                        deviceChart.destroy();
                    }

                    // Create new chart with fetched data
                    deviceChart = new Chart(document.getElementById("chartjs-dashboard-pie"), {
                        type: "pie",
                        data: {
                            labels: ["Laptop", "Smartphone", "Smartwatch", "Tablet"],
                            datasets: [{
                                data: [
                                    data.Laptop || 0,
                                    data.Smartphone || 0,
                                    data.Smartwatch || 0,
                                    data.Tablet || 0
                                ],
                                backgroundColor: [
                                    window.theme.primary,
                                    window.theme.warning,
                                    window.theme.danger,
                                    window.theme.info
                                ],
                                borderWidth: 5
                            }]
                        },
                        options: {
                            responsive: !window.MSInputMethodContext,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            cutoutPercentage: 75
                        }
                    });

                    // Update the table data
                    const tableBody = document.querySelector('table tbody');
                    tableBody.innerHTML = `
                        <tr>
                            <td>Laptop</td>
                            <td class="text-end">${data.Laptop || 0}</td>
                        </tr>
                        <tr>
                            <td>Smartphone</td>
                            <td class="text-end">${data.Smartphone || 0}</td>
                        </tr>
                        <tr>
                            <td>Smartwatch</td>
                            <td class="text-end">${data.Smartwatch || 0}</td>
                        </tr>
                        <tr>
                            <td>Tablet</td>
                            <td class="text-end">${data.Tablet || 0}</td>
                        </tr>
                    `;
                })
                .catch(error => {
                    console.error('Error fetching device statistics:', error);
                });
        }

        // Initial load
        updateDeviceChart();

        // Refresh every 30 seconds along with other stats
        setInterval(updateDeviceChart, 30000);
    });
</script>

<?= $this->endSection() ?>