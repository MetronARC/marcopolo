<?php
helper('auth');
?>

<?= $this->extend('template/index') ?>

<?= $this->section('page-content') ?>

<div class="container-fluid p-0">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h1 class="h3 mb-3"><strong>Ship Inquiry</strong></h1>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInquiryModal">
                <i class="fas fa-plus"></i> New Ship Inquiry
            </button>
        </div>
    </div>

    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="inquiryTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Ship Name</th>
                                <th>Ship Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Smith</td>
                                <td>Ocean Enterprises Ltd</td>
                                <td>Star Voyager</td>
                                <td>Cargo</td>
                                <td><span class="badge bg-warning">Under Construction</span></td>
                            </tr>
                            <tr>
                                <td>Emma Johnson</td>
                                <td>Pacific Marine Co</td>
                                <td>Blue Horizon</td>
                                <td>Tanker</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>Michael Chen</td>
                                <td>Asian Shipping Inc</td>
                                <td>Golden Fish</td>
                                <td>Fishing</td>
                                <td><span class="badge bg-danger">Delayed</span></td>
                            </tr>
                            <tr>
                                <td>Sarah Wilson</td>
                                <td>Atlantic Fleet Corp</td>
                                <td>Swift Current</td>
                                <td>Cargo</td>
                                <td><span class="badge bg-info">Awaiting Delivery</span></td>
                            </tr>
                            <tr>
                                <td>Robert Davis</td>
                                <td>Global Marine Solutions</td>
                                <td>Ocean Guardian</td>
                                <td>Tanker</td>
                                <td><span class="badge bg-secondary">Archived</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Inquiry Modal -->
<div class="modal fade" id="addInquiryModal" tabindex="-1" aria-labelledby="addInquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addInquiryModalLabel">New Ship Inquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inquiryForm">
                    <div class="mb-4">
                        <h6 class="fw-bold">👤 Client Info</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">🛳️ Ship / Project Info</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Ship Type</label>
                                <select class="form-select" required>
                                    <option value="">Select Ship Type</option>
                                    <option value="Cargo">Cargo</option>
                                    <option value="Tanker">Tanker</option>
                                    <option value="Fishing">Fishing</option>
                                    <option value="Passenger">Passenger</option>
                                    <option value="Container">Container</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ship Name</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Purpose</label>
                                <select class="form-select" required>
                                    <option value="">Select Purpose</option>
                                    <option value="New Building">New Building</option>
                                    <option value="Retrofit">Retrofit</option>
                                    <option value="Repair">Repair</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Preferred Delivery Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Additional Notes</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Attachments</label>
                                <input type="file" class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit Inquiry</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#inquiryTable').DataTable({
        responsive: true
    });
});
</script>

<?= $this->endSection() ?>