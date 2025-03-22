<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Ticket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-2">
                <img src="/assets/img/logo.png" style="width: 80px; height: auto;" class="img-fluid" alt="">
            </div>
            <div class="col-10">
                <b>PT. Karya Mura Niaga</b><br>
                <b>Alamat</b> : Komplek Ruko Mahkota Raya Blok C No 1&2, Kel. Teluk Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau, 29444 <b>Phone</b> : +62 853-6314-6277
            </div>
        </div><hr>
        <div class="row mb-2">
            <div class="col-8 text-center">
                <b>Tanda Terima Service</b>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-5">
                        Tanggal<br>Nomor
                    </div>
                    <div class="col-7">
                        <?php $dateTime = new DateTime($ticket->created_at); echo $dateTime->format('Y-m-d'); ?><br><?= $ticket->rma ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 30%;">Nama</td>
                            <td>: <?= $ticket->customer_name ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Alamat</td>
                            <td>: <?= $ticket->customer_address ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Telepon</td>
                            <td>: <?= $ticket->customer_phone ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Brand</td>
                            <td>: <?= $ticket->brand ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Type</td>
                            <td>: <?= $ticket->type ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Warranty</td>
                            <td>: <b><?= ($ticket->warranty == 1) ? 'In Warranty' : 'Not Warranty' ?></b> / <?= $ticket->warranty_date ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
            <table>
                    <tbody>
                        <tr>
                            <td style="width: 30%;">SN</td>
                            <td>: <?= $ticket->sn ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Kondisi</td>
                            <td>: <?= $ticket->device_condition ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Problem</td>
                            <td>: <?= $ticket->problem ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Aksesoris</td>
                            <td>: <?= $ticket->accessories ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Engineer</td>
                            <td>: <?= $ticket->engineer ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-2 text-center">
                <b>CS</b><br><br><br><br><?= session('name') ?>
            </div>
            <div class="col-1"></div>
            <div class="col-2 text-center">
                <b>Customer</b><br><br><br><br><?= $ticket->customer_name ?>
            </div>
            <div class="col-1"></div>
            <div class="col-6 d-flex">
                <div class="border border-dark flex-fill p-1">
                    <b>Detail Problem</b> :<br>
                    <?= $ticket->detail_problem ?>
                </div>
            </div>
        </div>
    </div><hr>
    <div class="container-fluid p-0 m-0">
        <div class="row">
            <div class="col-2">
                <img src="/assets/img/logo.png" style="width: 80px; height: auto;" class="img-fluid" alt="">
            </div>
            <div class="col-10">
                <b>PT. Karya Mura Niaga</b><br>
                <b>Alamat</b> : Komplek Ruko Mahkota Raya Blok C No 1&2, Kel. Teluk Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau, 29444 <b>Phone</b> : +62 853-6314-6277
            </div>
        </div><hr>
        <div class="row mb-2">
            <div class="col-8 text-center">
                <b>Tanda Terima Service</b>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-5">
                        Tanggal<br>Nomor
                    </div>
                    <div class="col-7">
                        <?php $dateTime = new DateTime($ticket->created_at); echo $dateTime->format('Y-m-d'); ?><br><?= $ticket->rma ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 30%;">Nama</td>
                            <td>: <?= $ticket->customer_name ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Alamat</td>
                            <td>: <?= $ticket->customer_address ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Telepon</td>
                            <td>: <?= $ticket->customer_phone ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Brand</td>
                            <td>: <?= $ticket->brand ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Type</td>
                            <td>: <?= $ticket->type ?></td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Warranty</td>
                            <td>: <b><?= ($ticket->warranty == 1) ? 'In Warranty' : 'Not Warranty' ?></b> / <?= $ticket->warranty_date ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
            <table>
                    <tbody>
                        <tr>
                            <td style="width: 30%;">SN</td>
                            <td>: <?= $ticket->sn ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Kondisi</td>
                            <td>: <?= $ticket->device_condition ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Problem</td>
                            <td>: <?= $ticket->problem ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Aksesoris</td>
                            <td>: <?= $ticket->accessories ?></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Engineer</td>
                            <td>: <?= $ticket->engineer ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-2 text-center">
                <b>CS</b><br><br><br><br><?= session('name') ?>
            </div>
            <div class="col-1"></div>
            <div class="col-2 text-center">
                <b>Customer</b><br><br><br><br><?= $ticket->customer_name ?>
            </div>
            <div class="col-1"></div>
            <div class="col-6 d-flex">
                <div class="border border-dark flex-fill p-1">
                    <b>Detail Problem</b> :<br>
                    <?= $ticket->detail_problem ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>