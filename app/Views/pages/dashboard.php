<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Dashboard</strong></h1>

    <div class="w-100">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Customers</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3" id="total-customers-count"></h1>
                        <div class="mb-0">
                            <span class="text-muted">Customers</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">New Ship Inquiry</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="book"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3" id="new-ship-inquiry-count"></h1>
                        <div class="mb-0">
                            <span class="text-muted">Ships</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Pending Ship Inquiry</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="file"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3" id="pending-ship-inquiry-count"></h1>
                        <div class="mb-0">
                            <span class="text-muted">Ships</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Docked Ships</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="anchor"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3" id="docked-ships-count"></h1>
                        <div class="mb-0">
                            <span class="text-muted">Ships</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    let ticketTable;

    // Add dummy data for dashboard cards
    const dashboardStats = {
        'total_customers': 31,
        'new_ship_inquiry': 5,
        'pending_ship_inquiry': 2,
        'docked_ships': 7,
    };

    function updateDashboardStats() {
        // Update dashboard card counts
        document.getElementById('total-customers-count').innerHTML = dashboardStats.total_customers;
        document.getElementById('new-ship-inquiry-count').innerHTML = dashboardStats.new_ship_inquiry;
        document.getElementById('pending-ship-inquiry-count').innerHTML = dashboardStats.pending_ship_inquiry;
        document.getElementById('docked-ships-count').innerHTML = dashboardStats.docked_ships;
    }

    // Initial load
    $(document).ready(function() {
        updateDashboardStats();

        // Refresh data every 30 seconds
        setInterval(() => {
            updateDashboardStats();
        }, 30000);
    });
</script>

<?= $this->endSection() ?>