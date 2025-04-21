<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="assets/img/icons/icon-48x48.png" />

	<title>Marcopolo Marine - Login</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<img class="img-fluid" src="<?= base_url('assets/img/logo.png') ?>" style="width: 150px; height:auto;">
							<h1 class="h2">Marcopolo Marine</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form id="loginForm" action="actionlogin" method="post">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Enter your email" />
										</div>
										<div class="mb-5">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Enter your password" />
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
			var userId = null;

			$('#loginForm').on('submit', function(e) {
				e.preventDefault();
				
				var email = $('#email').val();
				var password = $('#password').val();
				
				$.ajax({
					url: 'actionlogin',
					method: 'POST',
					data: {
						email: email,
						password: password
					},
					success: function(response) {
						try {
							const jsonResponse = JSON.parse(response);
							if (jsonResponse.status === 'error') {
								Swal.fire({
									title: "Error!",
									text: jsonResponse.message,
									icon: "error"
								});
								return;
							}
						} catch (e) {
							// Not JSON, handle as before
							if (response.indexOf('login') !== -1) {
								$('#loginForm')[0].submit();
							} else {
								if (email === password) {
									$.ajax({
										url: 'user/view',
										method: 'POST',
										data: {
											email: email
										},
										success: function(userResponse) {
											const userData = JSON.parse(userResponse);
											userId = userData.user_id;
											var passwordModal = new bootstrap.Modal(document.getElementById('passwordChangeModal'));
											passwordModal.show();
										}
									});
								} else {
									window.location.href = '/';
								}
							}
						}
					},
					error: function() {
						$('#loginForm')[0].submit();
					}
				});
			});

			$('#passwordChangeForm').on('submit', function(e) {
				e.preventDefault();
				
				var newPassword = $('#newPassword').val();
				var retypePassword = $('#retypePassword').val();
				var email = $('#email').val();
				
				if (newPassword !== retypePassword) {
					$('#passwordError').removeClass('d-none').text('Passwords do not match!');
					return;
				}

				if (newPassword === email) {
					$('#passwordError').removeClass('d-none').text('New password cannot be the same as your email!');
					return;
				}

				$.ajax({
					url: 'user/changepassword',
					method: 'POST',
					data: {
						newpassword: newPassword,
						user_id: userId
					},
					success: function(response) {
						if (response.message === 'Change password successfully!') {
							Swal.fire({
								title: "Success!",
								text: "Password changed successfully. Please login with your new password.",
								icon: "success"
							}).then((result) => {
								window.location.href = 'login';
							});
						} else {
							$('#passwordError').removeClass('d-none').text(response.message || 'Error changing password');
						}
					},
					error: function(xhr) {
						var errorMessage = 'Error changing password';
						if (xhr.responseJSON && xhr.responseJSON.message) {
							errorMessage = xhr.responseJSON.message;
						}
						$('#passwordError').removeClass('d-none').text(errorMessage);
					}
				});
			});

			function validatePasswords() {
				var newPassword = $('#newPassword').val();
				var retypePassword = $('#retypePassword').val();
				var email = $('#email').val();

				if (newPassword || retypePassword) {
					if (newPassword !== retypePassword) {
						$('#passwordError').removeClass('d-none').text('Passwords do not match!');
						return false;
					} else if (newPassword === email) {
						$('#passwordError').removeClass('d-none').text('New password cannot be the same as your email!');
						return false;
					} else {
						$('#passwordError').addClass('d-none').text('');
						return true;
					}
				} else {
					$('#passwordError').addClass('d-none').text('');
					return false;
				}
			}

			$('#newPassword, #retypePassword').on('input', validatePasswords);
		});
	</script>

</body>

</html>