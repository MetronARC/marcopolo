<?= $this->extend('template/index'); ?>
<?= $this->section('page-content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>AppDesk</strong> Setting</h1>

    <div class="row">
        <div class="col-sm-2 col-12">
            <div class="col-12 d-grid">
                <button class="btn btn-lg btn-primary mb-3" id="btnuser">User Manager</button>
            </div>
            <div class="col-12 d-grid">
                <button class="btn btn-lg btn-primary mb-3" id="btnbrand">Brand</button>
            </div>
        </div>
        <div class="col-sm-10 col-12">
            <div class="card" id="carduser">
                <div class="card-header">
                    User Manager
                    <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addusermodal"><i class="fa-solid fa-plus"></i> Add User</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Last Login</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="userdata">
                            <tr>
                                <td colspan="5" class="text-center">Data Empty</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" id="cardbrand">
                <div class="card-header">
                    Brand
                    <button class="btn btn-success float-end"><i class="fa-solid fa-plus"></i> Add Brand</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Brand</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>xx</th>
                                <th>xx</th>
                                <th>
                                    <button class="btn btn-info">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="addusermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form id="insertuser">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" placeholder="">
                        <label for="floatingInput">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="">
                        <label for="floatingInput">Email Address</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="type" aria-label="">
                            <option selected disabled>User Type</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="floatingSelect">Select Type</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary float-end" onclick="submituser()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function getdatauser() {
        $.ajax({
            url: '/user/getall',
            type: 'get',
            success: function(resp) {
                let data = JSON.parse(resp)
                console.log(data)
                $('#userdata').empty()
                data.forEach(e => {
                    let lastlogin;
                    if (e.lastlogin_at == null) {
                        lastlogin = 'Never'
                    } else {
                        lastlogin = e.lastlogin_at
                    }
                    $('#userdata').append(`
                            <tr>
                                <td>${e.user_id}</td>
                                <td>${e.name}</td>
                                <td>${e.email}</td>
                                <td>${e.type}</td>
                                <td>${lastlogin}</td>
                                <td>
                                    <button class="btn btn-info"><i class="fa-solid fa-key"></i></button>
                                    <button class="btn btn-danger" onclick="deleteuser('${e.user_id}', '${e.name}')"><i class="fa-solid fa-trash-can"></i></button>
                                </td>
                            <tr>
                        `)
                });
            }
        })
    }

    function deleteuser(id, name) {
        Swal.fire({
            title: "Delete User",
            text: `Are you sure to delete user ${name} ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/user/delete',
                    type: 'POST',
                    data: {
                        user_id: id
                    },
                    success: function(resp) {
                        // let data = JSON.parse(resp);
                        Swal.fire({
                            title: "Success",
                            text: `Delete user successfully`,
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                getdatauser()
                            }
                        });
                    }
                })
            }
        });
    }

    function submituser() {
        let data = {
            name: $('#name').val(),
            email: $('#email').val(),
            type: $('#type').val()
        }

        $.ajax({
            url: '/user/create',
            type: 'POST',
            data: data,
            success: function(resp) {
                $('#addusermodal').modal('hide')
                $('#addusermodal input').val("")
                Swal.fire({
                    title: "Success!",
                    text: "Insert User Successfully!",
                    icon: "success"
                });
                getdatauser()
            }
        })
        console.log(data)
    }

    $(function() {
        getdatauser()
        $('#cardbrand').hide()
        $('#btnuser').click(function() {
            $('#carduser').show()
            $('#cardbrand').hide()
        })
        $('#btnbrand').click(function() {
            $('#carduser').hide()
            $('#cardbrand').show()
        })
    })
</script>



<?= $this->endSection(); ?>