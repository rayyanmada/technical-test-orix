@extends('shared_pages.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>{{ $dt['title'] }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('order.store') }}" name="myForm" method="POST" onsubmit="return validateForm()">
                @csrf
                @method('POST')
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div class="d-sm-flex">
                        <a href="{{ route('order.index') }}" class="btn btn-md btn-circle btn-outline-danger">
                            <i class="bi bi-skip-backward-fill"></i> Back
                        </a>
                        &nbsp;
                    </div>
                    <button type="submit" class="btn btn-outline-success btn-md btn-icon-split">
                        Submit Order <i class="bi bi-sd-card-fill"></i>
                    </button>
                </div>

                <!-- content -->
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card border-bottom-primary shadow mb-4">
                            <div class="card-header py-3 bg-orange">
                                <h6 class="m-0 font-weight-bold text-white">Data Customer</h6>
                            </div>
                            <div class="card-body">
                                <div class="input-group mb-4">
                                    <select name="customer_id" id="customer_id" class="form-control mt-2"
                                        onchange="pilihCustomer()">
                                        <option value="">--Pilih Customer--</option>
                                        <?php foreach ($dt['customer'] as $c) : ?>
                                        <option value="{{ $c->id }}">{{ $c->nama }}</option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg ms-5">
                                        <p id="namaC">-</p>
                                        <!-- Divider -->
                                        <hr class="sidebar-divider">
                                        <p id="alamatC">-</p>
                                        <!-- Divider -->
                                        <hr class="sidebar-divider">
                                        <p id="picC">-</p>
                                        <!-- Divider -->
                                        <hr class="sidebar-divider">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card border-bottom-primary shadow mb-4">
                            <div class="card-header py-3 bg-orange">
                                <h6 class="m-0 font-weight-bold text-white">Data Order</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="mt-2">Nomer Order</label>
                                    <input type="text" class="form-control" name="no_order" value="{{ $dt['no_order'] }}"
                                        readonly>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tanggal Pinjam</label>
                                            <input type="date" name="tgl_pinjam" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Tanggal Kembali</label>
                                            <input type="date" name="tgl_kembali" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Pilih Driver</label>
                                            <select name="driver_id" id="driver_id" class="form-control mt-2" required>
                                                <option value="">--Pilih Driver--</option>
                                                <?php foreach ($dt['driver'] as $d) : ?>
                                                <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Keterangan order</label>
                                            <textarea name="keterangan" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="card border-bottom-primary shadow mb-4">
                            <div class="card-header py-3 d-sm-flex justify-content-between bg-orange">
                                <h6 class="m-0 font-weight-bold text-white">Inventory yg disewa</h6>
                                <div class="d-sm-flex">
                                    <h6 class="m-0 text-white">Limit Rental:</h6>
                                    &nbsp;
                                    <h6 class="m-0 font-weight-bold text-white" id="limit">5</h6>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-lg-5">
                                        <div class="form-group mb-4">
                                            <select name="inventory_id" class="form-control" id="inventory_id"
                                                onchange="pilihInventory()">
                                                <option selected value="">--Pilih Inventory--</option>
                                                <?php foreach ($dt['inventory'] as $i) : ?>
                                                <option value="{{ $i->id }}">{{ $i->nama }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <span class="badge bg-success">Ready: <span id="stok"></span></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <span class="badge bg-success d-inline">Qtt to rent:
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 text-end">
                                        <div class="form-group">
                                            <input width="5px" type="number" name="qtt" class="form-control"
                                                value="0">
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button type="button" class="btn btn-success btn-circle btn-md"
                                            id="insertOrder">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-lg mb-4">
                                        <div class="table-responsive">
                                            <table class="table" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th width="1%">No</th>
                                                        <th>Nama Inventory</th>
                                                        <th>Harga Sewa</th>
                                                        <th>Keterangan</th>
                                                        <th>Qty</th>
                                                        <th width="1%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success btn-md btn-icon-split">
                                    Submit Order <i class="bi bi-sd-card-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        var counter = 1
        var limit

        function pesan(title, icon) {
            Swal.fire({
                title: title,
                icon: icon,
                confirmButtonColor: '#4e73df',
            });
        }

        function validasi(judul, status) {
            swal.fire({
                title: judul,
                icon: status,
                confirmButtonColor: '#4e73df',
            });
        }

        // validasi form 
        function validateForm() {
            let customer_id = document.forms["myForm"]["customer_id"].value;
            let limit = document.getElementById("limit").innerText;
            if (customer_id == "") {
                validasi('Customer wajib di isi!', 'warning');
                return false;
            } else if (limit === "5") {
                validasi('Quantity rental masih kosong!', 'warning');
                return false;
            }
        }

        function pilihCustomer() {
            let customer_id = $('#customer_id').val()
            if (customer_id == '') {
                // $('#preview').attr("src", base_url + "assets/upload/user/man.png");
                $('#stock').text("0");
                $('#qtt').text("0");
            } else {
                $.ajax({
                    url: '/getcustomer',
                    type: 'GET',
                    data: {
                        id: customer_id,
                    },
                    dataType: 'json',
                    success: function(responds) {
                        $('#namaC').text(responds.customer.nama);
                        $('#alamatC').text(responds.customer.alamat);
                        $('#picC').text(responds.customer.pic);
                    }
                });
            }
        }

        function pilihInventory() {
            let inventory_id = $('#inventory_id').val()
            if (inventory_id == '') {
                $('#stok').text(parseInt('0'));
            } else {
                $.ajax({
                    url: '/getinventory',
                    type: 'GET',
                    data: {
                        id: inventory_id,
                    },
                    dataType: 'json',
                    success: function(responds) {
                        console.log(responds)
                        $('#stok').text(responds.data.qtt);
                    }
                });
            }
        }
        // tambahkan ke list order
        function insertOrder() {
            let stok = parseInt($('#stok').text());
            let qtt = parseInt($("input[name='qtt']").val());

            if (qtt > stok) {
                pesan("Jumlah melewati stok inventory!", "warning");
                return false;
            } else {
                let newRow = $("<tr class='bounceIn'>");
                let cols = "";
                let inventory_id = $('[name="inventory_id"]').val();
                let qttRental = $('[name="qtt"]').val();
                limit = parseInt($("#limit").text());
                $.ajax({
                    url: '/getinventory',
                    type: 'GET',
                    data: {
                        id: inventory_id,
                    },
                    dataType: 'json',
                    success: function(responds) {
                        console.log(responds.data.id)
                        cols += '<td><input type="hidden" name="inventory_id[]" value="' + responds.data.id +
                            '"><input type="hidden" name="hrg_sewa[]" value="' + responds.data.harga_sewa +
                            '"><input type="hidden" name="qtt_rental[]" value="' + $("input[name='qtt']")
                            .val() +
                            '"> ' + counter + '. </td>';
                        cols += '<td>' + responds.data.nama + '</td>';
                        cols += '<td>' + responds.data.harga_sewa.toLocaleString('pl-PL') + '</td>';
                        cols += '<td>' + responds.data.keterangan + '</td>';
                        cols += '<td>' + $("input[name='qtt']").val() + '</td>';
                        cols +=
                            '<td><button type="button" class="btnDel btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </button></td>';

                        newRow.append(cols);
                        $("table").append(newRow);
                        counter++;

                        $("#limit").text(Number(limit) - Number(qttRental));
                        $("input[name='qtt']").val('0');
                    }
                });
            }
        }
        // tambah baris 
        $("#insertOrder").on("click", function() {
            if (counter > 5) {
                pesan("Limit Pinjam maksimal 5 barang!", "warning");
                return false;
            } else {
                if ($("#inventory_id").val() === '') {
                    pesan("Belum memilih barang!", "warning");
                    return false;
                } else if ($("input[name='qtt']").val() === '' || $("input[name='qtt']").val() === '0' || $(
                        "input[name='qtt']").val() < 0) {
                    pesan("Jumlah barang tidak boleh 0!", "warning");
                    return false;
                } else {
                    insertOrder();
                }
            }
        });
        // hapus baris
        $("table").on("click", ".btnDel", function(event) {
            $(this).closest("tr").remove();
            counter -= 1
            limit = parseInt($("#limit").text());
            $("#limit").text(limit + 1);
        });
    </script>
@endsection
