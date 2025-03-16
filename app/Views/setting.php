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
                <button class="btn btn-lg btn-primary mb-3" id="btnlog">User Log</button>
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
                    <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#addbrandmodal"><i class="fa-solid fa-plus"></i> Add Brand</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Insert At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="branddata">
                            <tr>
                                <td colspan="3" class="text-center">Data Empty</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card" id="cardlog">
                <div class="card-header">
                    User Log
                    <button class="btn btn-success float-end me-2" onclick="getdatalog()"><i class="fa-solid fa-rotate fa-spin"></i></button>
                    <button class="btn btn-success float-end me-2" onclick="opensearchlog()"><i class="fa-solid fa-magnifying-glass"></i> Search Log</button>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="logdata">
                            <tr>
                                <td colspan="5" class="text-center">Data Empty</td>
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
                            <option value="CS">Customer Service</option>
                            <option value="ADMIN">Admin</option>
                            <option value="TECHNICIAN">Technician</option>
                            <option value="MANAGER">Manager</option>
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

<div class="modal fade" id="addbrandmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form id="insertbrand">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="brand" placeholder="">
                        <label for="floatingInput">Brand</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary float-end" onclick="submitbrand()">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="searchlogmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Search Log</h1>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form id="searchlogform">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="log_user" aria-label="">
                        </select>
                        <label for="log_user">Select user</label>
                    </div>
                    <div class="row">
                        <div class="form-floating col-sm-6 col-12 mb-3">
                            <input type="date" class="form-control" id="log_start" placeholder="">
                            <label for="log_start">Start</label>
                        </div>
                        <div class="form-floating col-sm-6 col-12 mb-3">
                            <input type="date" class="form-control" id="log_end" placeholder="">
                            <label for="log_end">End</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary float-end" onclick="submitsearch()">Submit</button>
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
                                    <button class="btn btn-info" onclick="resetpassword('${e.user_id}', '${e.email}', '${e.name}')"><i class="fa-solid fa-key"></i></button>
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
    }

    function resetpassword(id, email, name) {
        Swal.fire({
            title: "Reset Password",
            text: `Are you sure to reset password user ${name} ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/user/changepassword',
                    type: 'POST',
                    data: {
                        user_id: id,
                        newpassword: email
                    },
                    success: function(resp) {
                        // let data = JSON.parse(resp);
                        Swal.fire({
                            title: "Success",
                            text: `Reset password successfully`,
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

    function getdatabrand() {
        $.ajax({
            url: '/brand/get',
            type: 'get',
            success: function(resp) {
                let data = JSON.parse(resp)
                console.log(data)
                if (data.length > 0) {
                    $('#branddata').empty()
                    data.forEach(e => {
                        $('#branddata').append(`
                        <tr>
                            <td>${e.brand}</td>
                            <td>${e.created_at}</td>
                            <td>
                                <button class="btn btn-danger" onclick="deletebrand('${e.id}', '${e.brand}')"><i class="fa-solid fa-trash-can"></i></button>
                            </td>
                        <tr>
                        `)
                    });
                } else {
                    $('#branddata').empty().append(`
                        <tr>
                            <td colspan="3" class="text-center">Data Empty</td>
                        </tr>
                    `)
                }
            },
            error: function() {
                $('#branddata').empty().append(`
                    <tr>
                        <td colspan="3" class="text-center">Data Empty</td>
                    </tr>
                `)
            }
        })
    }

    function submitbrand() {
        $.ajax({
            url: '/brand/insert',
            type: 'POST',
            data: {
                brand: $('#brand').val()
            },
            success: function(resp) {
                $('#addbrandmodal').modal('hide')
                $('#addbrandmodal input').val("")
                Swal.fire({
                    title: "Success!",
                    text: "Insert Brand Successfully!",
                    icon: "success"
                });
                getdatabrand()
            }
        })
    }

    function deletebrand(id, name) {
        Swal.fire({
            title: "Delete Brand",
            text: `Are you sure to delete brand ${name} ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/brand/delete',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        // let data = JSON.parse(resp);
                        Swal.fire({
                            title: "Success",
                            text: `Delete brand successfully`,
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                getdatabrand()
                            }
                        });
                    }
                })
            }
        });
    }

    function getdatalog() {
        $.ajax({
            url: '/user/getlog',
            type: 'get',
            success: function(resp) {
                let data = JSON.parse(resp)
                console.log(data)
                if (data.length > 0) {
                    $('#logdata').empty()
                    data.forEach(e => {
                        $('#logdata').append(`
                        <tr>
                            <td>${e.created_at}</td>
                            <td>${e.userid}</td>
                            <td>${e.name}</td>
                            <td>${e.email}</td>
                            <td>${e.action}</td>
                        <tr>
                        `)
                    });
                } else {
                    $('#logdata').empty().append(`
                        <tr>
                            <td colspan="5" class="text-center">Data Empty</td>
                        </tr>
                    `)
                }
            },
            error: function() {
                $('#logdata').empty().append(`
                    <tr>
                        <td colspan="5" class="text-center">Data Empty</td>
                    </tr>
                `)
            }
        })
    }

    function fetchsearchlog(list) {
        let data = JSON.parse(list)
        console.log(data)
        if (data.length > 0) {
            $('#logdata').empty()
            data.forEach(e => {
                $('#logdata').append(`
                    <tr>
                        <td>${e.created_at}</td>
                        <td>${e.userid}</td>
                        <td>${e.name}</td>
                        <td>${e.email}</td>
                        <td>${e.action}</td>
                    <tr>
                `)
            });
        } else {
            $('#logdata').empty().append(`
                <tr>
                    <td colspan="5" class="text-center">Data Empty</td>
                </tr>
            `)
        }
    }

    function opensearchlog() {
        $.ajax({
            url: '/user/getall',
            type: 'get',
            success: function(resp) {
                let data = JSON.parse(resp);
                $('#log_user').empty()
                $.each(data, function(index, option) {
                    var newOption = $('<option>', {
                        value: option.user_id,
                        text: option.user_id + ' / ' + option.name
                    });
                    $('#log_user').append(newOption);
                });
                $('#searchlogmodal').modal('show')
            }
        })
    }

    function submitsearch() {
        $.ajax({
            url: '/user/searchlog',
            type: 'POST',
            data: {
                user: $('#log_user').val(),
                start: $('#log_start').val(),
                end: $('#log_end').val()
            },
            success: function(resp) {
                $('#searchlogmodal').modal('hide')
                fetchsearchlog(resp)
            }
        })
    }

    $(function() {
        getdatauser()
        $('#cardbrand, #cardlog').hide()
        $('#btnuser').click(function() {
            getdatauser()
            $('#carduser').show()
            $('#cardbrand, #cardlog').hide()
        })
        $('#btnbrand').click(function() {
            getdatabrand()
            $('#carduser, #cardlog').hide()
            $('#cardbrand').show()
        })
        $('#btnlog').click(function() {
            getdatalog()
            $('#carduser, #cardbrand').hide()
            $('#cardlog').show()
        })
    })
</script>



<?= $this->endSection(); ?>