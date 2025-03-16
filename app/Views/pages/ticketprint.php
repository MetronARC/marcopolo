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
                <img src="/assets/img/logo.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-10">
                <b>PT. Karya Mura Niaga</b><br>
                Alamat : lorem ipsum dolor sit amet bla bla bla<br>
                Phone : 081289898989<br>
                Email : test@admin.com
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
                        <?= date('d F Y') ?><br>T240101011
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
                            <td>: biji</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Alamat</td>
                            <td>: jalan biji meledak no. 5</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Telepon</td>
                            <td>: 081289898989</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Brand</td>
                            <td>: ASUS</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Type</td>
                            <td>: HAHA2525</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">SN</td>
                            <td>: ASD89Q5G</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Warranty</td>
                            <td>: <b>Not Warranty</b> / Warranty until</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
            <table>
                    <tbody>
                        <tr>
                            <td style="width: 30%;">Kondisi</td>
                            <td>: black screen, lcd retak</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Problem</td>
                            <td>: biji meledak</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Detail Problem</td>
                            <td>: biji nya meledak tiba tiba</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Aksesoris</td>
                            <td>: SD Card</td>
                        </tr>
                        <tr>
                            <td style="width: 30%;">Engineer</td>
                            <td>: YUDISTA RAHADIAN</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-3 text-center">
                CS<br><br><br><br><?= session('name') ?>
            </div>
            <div class="col-3 text-center">
                Customer<br><br><br><br>Halimah
            </div>
            <div class="col-6"></div>
        </div>
    </div>
</body>
</html>