<?= $this->extend('template/index') ?>
<?= $this->section('page-content') ?>

<!-- Title Section -->
<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3"><strong>Customer Database</strong></h1>
            <p class="text-muted">Manage and view all customer information</p>
        </div>
    </div>

    <!-- Search and Insert Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="customerSearch" placeholder="Search customers...">
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                                <i class="fas fa-plus"></i> Add New Customer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Cards Section -->
    <div class="row" id="customerCards">
        <!-- Customer Card 1 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 customer-card" data-customer-name="nasa" data-customer-id="CUST-001">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="logo-container">
                            <img src="<?= base_url('assets/customer-logo/nasa.png') ?>" class="rounded-circle" alt="Company Logo">
                        </div>
                        <h4 class="card-title">Nasa</h4>
                        <p class="text-muted">ID: CUST-001</p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/1234567890" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="mailto:contact@nasa.com" class="btn btn-info btn-sm">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                        <a href="/customer/details/1" class="btn btn-primary btn-sm">
                            <i class="fas fa-info-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Card 2 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 customer-card" data-customer-name="starlink" data-customer-id="CUST-002">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="logo-container">
                            <img src="<?= base_url('assets/customer-logo/starlink.png') ?>" class="rounded-circle" alt="Company Logo">
                        </div>
                        <h4 class="card-title">Starlink</h4>
                        <p class="text-muted">ID: CUST-002</p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/1234567890" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="mailto:contact@starlink.com" class="btn btn-info btn-sm">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                        <a href="/customer/details/2" class="btn btn-primary btn-sm">
                            <i class="fas fa-info-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Card 3 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 customer-card" data-customer-name="google" data-customer-id="CUST-003">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="logo-container">
                            <img src="<?= base_url('assets/customer-logo/google.png') ?>" class="rounded-circle" alt="Company Logo">
                        </div>
                        <h4 class="card-title">Google</h4>
                        <p class="text-muted">ID: CUST-003</p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/1234567890" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="mailto:contact@google.com" class="btn btn-info btn-sm">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                        <a href="/customer/details/3" class="btn btn-primary btn-sm">
                            <i class="fas fa-info-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Card 4 (Hidden by default) -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 customer-card d-none" data-customer-name="microsoft" data-customer-id="CUST-004">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="logo-container">
                            <img src="<?= base_url('assets/customer-logo/microsoft.png') ?>" class="rounded-circle" alt="Company Logo">
                        </div>
                        <h4 class="card-title">Microsoft</h4>
                        <p class="text-muted">ID: CUST-004</p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/1234567890" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="mailto:contact@microsoft.com" class="btn btn-info btn-sm">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                        <a href="/customer/details/4" class="btn btn-primary btn-sm">
                            <i class="fas fa-info-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Card 5 (Hidden by default) -->
        <div class="col-12 col-md-6 col-lg-4 mb-4 customer-card d-none" data-customer-name="apple" data-customer-id="CUST-005">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="logo-container">
                            <img src="<?= base_url('assets/customer-logo/apple.png') ?>" class="rounded-circle" alt="Company Logo">
                        </div>
                        <h4 class="card-title">Apple</h4>
                        <p class="text-muted">ID: CUST-005</p>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/1234567890" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="mailto:contact@apple.com" class="btn btn-info btn-sm">
                            <i class="fas fa-envelope"></i> Email
                        </a>
                        <a href="/customer/details/5" class="btn btn-primary btn-sm">
                            <i class="fas fa-info-circle"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" required>
                    </div>
                    <div class="mb-3">
                        <label for="companyLogo" class="form-label">Company Logo</label>
                        <input type="file" class="form-control" id="companyLogo" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">WhatsApp Number</label>
                        <input type="tel" class="form-control" id="whatsapp">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Customer</button>
            </div>
        </div>
    </div>
</div>

<!-- Add custom styles -->
<style>
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .btn-sm {
        padding: 0.5rem;
        margin: 0.2rem 0;
    }

    .rounded-circle {
        border: 3px solid #f8f9fa;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        object-fit: cover;
        width: 100px;
        height: 100px;
        background-color: white;
        padding: 10px;
        display: inline-block;
        position: relative;
    }

    .rounded-circle img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Logo container styling */
    .logo-container {
        width: 100px;
        height: 100px;
        margin: 0 auto 1rem;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<!-- Add search functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('customerSearch');
    const customerCards = document.querySelectorAll('.customer-card');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase().trim();

        customerCards.forEach(card => {
            const customerName = card.getAttribute('data-customer-name').toLowerCase();
            const customerId = card.getAttribute('data-customer-id').toLowerCase();
            
            if (searchTerm === '') {
                // If search is empty, show only first 3 cards
                const index = Array.from(customerCards).indexOf(card);
                card.classList.toggle('d-none', index >= 3);
            } else {
                // During search, show/hide based on match
                const matches = customerName.includes(searchTerm) || customerId.includes(searchTerm);
                card.classList.toggle('d-none', !matches);
            }
        });
    });
});
</script>

<?= $this->endSection() ?>