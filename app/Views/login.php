<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="assets/img/icons/icon-48x48.png" />

	<title>AppDesk - Login</title>

	<link href="assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<?php if (session()->getFlashdata('error')): ?>
		<script>
			$(function() {
				Swal.fire({
					title: "Oops !",
					text: "<?= session()->getFlashdata('error') ?>",
					icon: "error"
				});
			})
		</script>
	<?php endif; ?>

	<?php if (session()->getFlashdata('debug')): ?>
		<script>
			console.log('Debug:', '<?= session()->getFlashdata('debug') ?>');
		</script>
	<?php endif; ?>

	<!-- First Login Modal -->
	<div class="modal fade" id="firstLoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="firstLoginModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="firstLoginModalLabel">Change Password Required</h5>
				</div>
				<div class="modal-body">
					<form id="changePasswordForm">
						<input type="hidden" id="user_id" name="user_id">
						<div class="mb-3">
							<label for="newpassword" class="form-label">New Password</label>
							<input type="password" class="form-control" id="newpassword" name="newpassword" required>
						</div>
						<div class="mb-3">
							<label for="retypepassword" class="form-label">Retype Password</label>
							<input type="password" class="form-control" id="retypepassword" name="retypepassword" required>
						</div>
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary">Change Password</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">AppDesk v1.0</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form action="actionlogin" method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email" />
										</div>
										<div class="mb-5">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Sign in</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="assets/js/app.js"></script>
	<script>
		$(document).ready(function() {
			console.log('Document ready');
			console.log('First login status:', <?= json_encode(session()->get('firstlogin')) ?>);
			
			// Check if this is first login
			<?php if(session()->get('firstlogin')): ?>
				console.log('First login detected');
				$('#user_id').val('<?= session()->get('userid') ?>');
				console.log('User ID set to:', '<?= session()->get('userid') ?>');
				
				// Initialize and show modal
				var modal = document.getElementById('firstLoginModal');
				var bootstrapModal = new bootstrap.Modal(modal, {
					backdrop: 'static',
					keyboard: false
				});
				bootstrapModal.show();
			<?php endif; ?>

			// Handle password change form submission
			$('#changePasswordForm').on('submit', function(e) {
				e.preventDefault();
				console.log('Form submitted');
				
				var newPassword = $('#newpassword').val();
				var retypePassword = $('#retypepassword').val();
				
				if (newPassword !== retypePassword) {
					Swal.fire({
						title: "Error!",
						text: "Passwords do not match!",
						icon: "error"
					});
					return;
				}

				$.ajax({
					url: 'user/changepassword',
					method: 'POST',
					data: {
						user_id: $('#user_id').val(),
						newpassword: newPassword
					},
					success: function(response) {
						Swal.fire({
							title: "Success!",
							text: "Password changed successfully!",
							icon: "success"
						}).then((result) => {
							window.location.href = '/';
						});
					},
					error: function() {
						Swal.fire({
							title: "Error!",
							text: "Failed to change password. Please try again.",
							icon: "error"
						});
					}
				});
			});
		});
	</script>

</body>

</html>