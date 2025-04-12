@extends('layouts.pusat')

@section('content')
    <div class="card">
        <div class="mb-3 mt-3 ms-3 me-3 d-flex justify-content-between">

            <div class="mb-3 d-flex justify-content-between align-items-center">
                <label class="form-label me-3 col-6"><strong>Pilih Toko</strong></label>
                <div class="col-12">
                    <select class="single-select" id="selectToko">
                        <option value="">Pilih Toko</option>
                        @foreach ($toko as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->nametoko }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Tombol Add New Toko -->
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addStokModal">
                Add New Stok Barang
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Toko</th>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">

                        @foreach ($data as $key => $item)
                            {{-- @dd($data) --}}
                            <tr class="toko-{{ $item->idtoko }}">
                                <td>{{ $key + 1 }}</td> <!-- Menampilkan nomor urut -->
                                <td>{{ $item->toko->nametoko }}</td> <!-- Menampilkan nama user -->
                                <td>{{ $item->barang->namebarang }}</td> <!-- Menampilkan posisi user -->
                                <td>{{ $item->jumlah }}</td> <!-- Menampilkan posisi user -->
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <!-- View Button -->
                                        {{-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="View" data-id="{{ $item->id }}"
                                            onclick="viewToko({{ $item->id }})">
                                            <i class="bi bi-eye-fill"></i>
                                        </a> --}}
                                        <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Add Stok" data-id="{{ $item->id }}"
                                            onclick="editStok({{ $item->id }})">
                                            <i class="bi bi-plus-circle"></i>
                                        </a>
                                        <!-- Delete Button -->
                                        <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Delete" data-id="{{ $item->id }}"
                                            onclick="confirmDelete({{ $item->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add New Barang -->
    <div class="modal fade" id="addStokModal" tabindex="-1" aria-labelledby="addStokModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStokModalLabel">Add New Stok Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStokBarangForm">
                        @csrf
                        <div class="mb-3">
                            <label for="add-namebarang" class="form-label">Pilih Toko</label>
                            <select class="form-control" id="pilihtoko">
                                {{-- <option value="">Pilih Toko</option> --}}
                                @foreach ($toko as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->nametoko }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add-namabarang" class="form-label">Pilih Nama Barang</label>
                            {{-- <input type="text" class="form-control" id="add-namabarang" required> --}}
                            <select class="form-control" id="pilihbarang">
                                {{-- <option value="">Pilih Toko</option> --}}
                                @foreach ($barang as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->namebarang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlahbarang" class="form-label">Jumlah Barang</label>
                            <input type="text" class="form-control" id="jumlahbarang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Stok Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for View Toko -->
    <div class="modal fade" id="viewTokoModal" tabindex="-1" aria-labelledby="viewTokoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewTokoModalLabel">View Toko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Toko:</strong> <span id="view-nametoko"></span></p>
                    <p><strong>Alamat Toko:</strong> <span id="view-alamattoko"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Toko -->
    <div class="modal fade" id="editStokModal" tabindex="-1" aria-labelledby="editStokModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStokModalLabel">Tambah Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editStokForm">
                        @csrf
                        <input type="hidden" id="idstok">
                        <div class="mb-3">
                            <label for="nametoko" class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" id="nametoko" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="namabarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="namabarang" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Tambah Stok</label>
                            <input type="text" class="form-control" id="jumlah" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteStokModal" tabindex="-1" aria-labelledby="deleteStokModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteStokModalLabel">Delete Toko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Stok?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm-delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani perubahan pada select element 'selectToko'
            const selectToko = document.getElementById('selectToko');

            // Pastikan Select2 sudah terinisialisasi terlebih dahulu
            $(selectToko).on('change', function() {
                var selectedTokoId = $(this).val();

                // Jika tidak ada toko yang dipilih, hapus data di tabel
                if (!selectedTokoId) {
                    $('#tableData').empty(); // Kosongkan tabel jika tidak ada toko yang dipilih
                    return;
                }


                // Ambil data baru berdasarkan ID toko yang dipilih
                $.ajax({
                    url: '/tokobarang/' + selectedTokoId,
                    method: 'GET',
                    success: function(data) {
                        // Pastikan data yang diterima dalam format array
                        if (Array.isArray(data)) {
                            updateTable(data);
                        } else {
                            // Jika data yang diterima bukan array, konversikan menjadi array
                            updateTable([data]);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Fungsi untuk memperbarui tabel
            function updateTable(data) {
                var tableBody = $('#tableData');
                tableBody.empty(); // Menghapus data lama di tabel

                if (data.length === 0) {
                    // Jika tidak ada data, tampilkan pesan
                    tableBody.append(
                        '<tr><td colspan="5" class="text-center">Tidak ada data yang ditemukan</td></tr>');
                    return;
                }

                // <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                //                data-bs-placement="bottom" title="View" onclick="viewToko(${item.id})">
                //                 <i class="bi bi-eye-fill"></i>
                //             </a>
                // Menyiapkan data dalam format yang sesuai dengan DataTables
                var rows = data.map(function(item, index) {
                    var actions = `
                        <div class="table-actions d-flex align-items-center gap-3 fs-6">
                            
                            <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                               data-bs-placement="bottom" title="Add Stok" onclick="editStok(${item.id})" data-id=(${item.id})>
                                <i class="bi bi-plus-circle"></i>
                            </a>
                            <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                               data-bs-placement="bottom" title="Delete" onclick="confirmDelete(${item.id})">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </div>
                    `;

                    return [
                        index + 1, // No
                        item.toko.nametoko, // Nama Toko
                        item.barang.namebarang, // Nama Produk
                        item.jumlah, // Qty
                        actions // Kolom aksi
                    ];
                });

                // Menambahkan data ke DataTables
                var table = $('#example2').DataTable();
                table.clear(); // Menghapus data lama dari DataTables
                table.rows.add(rows); // Menambahkan data baru
                table.draw(); // Merender ulang DataTables
            };

        });

        // View Toko Function
        function viewToko(id) {
            fetch(`/toko/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('view-nametoko').textContent = data.nametoko;
                    document.getElementById('view-alamattoko').textContent = data.alamattoko;
                    var viewModal = new bootstrap.Modal(document.getElementById('viewTokoModal'));
                    viewModal.show();
                })
                .catch(error => {
                    console.error("Error fetching data: ", error);
                });
        }

        // Edit Toko Function
        function editStok(id) {
            fetch(`/tokobarang/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('idstok').value = data[0].id;
                    document.getElementById('nametoko').value = data[0].toko.nametoko;
                    document.getElementById('namabarang').value = data[0].barang.namebarang;
                    // document.getElementById('jumlah').value = 0;
                    var editModal = new bootstrap.Modal(document.getElementById('editStokModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error("Error fetching data: ", error);
                });
        }

        // Handle the Edit Form Submission
        document.getElementById('editStokForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // console.log('edits');
            var csrfToken = document.querySelector('input[name="_token"]').value;
            var id = document.getElementById('idstok').value;
            // var nametoko = document.getElementById('nametoko').value;
            var jumlah = document.getElementById('jumlah').value;

            // Prepare data to send with fetch (FormData can also be used here)
            var data = {
                _token: csrfToken,
                jumlah: jumlah
            };
            // console.log(data);
            fetch(`/stok/update/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data), // Sending JSON data
                })
                .then(response => response.json())
                .then(response => {
                    alert(response.success);
                    var editModal = new bootstrap.Modal(document.getElementById('editStokModal'));
                    editModal.hide();
                    location.reload(); // Reload the page to reflect changes
                })
                .catch(error => {
                    console.error('Error updating data:', error);
                });
        });

        // Delete Confirmation Function
        function confirmDelete(id) {
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteStokModal'));
            deleteModal.show();

            document.getElementById('confirm-delete').addEventListener('click', function() {
                fetch(`/stok/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            _token: document.querySelector('input[name="_token"]').value,
                        }), // Sending CSRF token with the DELETE request
                    })
                    .then(response => response.json())
                    .then(response => {
                        alert(response.success);
                        deleteModal.hide();
                        location.reload(); // Reload the page to reflect changes
                    })
                    .catch(error => {
                        console.error('Error deleting data:', error);
                    });
            });
        }

        // Handle the Add New Barang Form Submission
        document.getElementById('addStokBarangForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Ambil CSRF Token dari form input hidden
            var csrfToken = document.querySelector('input[name="_token"]').value;

            var toko = document.getElementById('pilihtoko').value;
            var barang = document.getElementById('pilihbarang').value;
            var jumlah = document.getElementById('jumlahbarang').value;

            // Siapkan data untuk dikirimkan
            var data = {
                _token: csrfToken,
                barang: barang,
                toko: toko,
                jumlah: jumlah,
            };

            // Kirim data menggunakan fetch
            fetch('/stok/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data), // Mengirim data dalam format JSON
                })
                .then(response => response.json())
                .then(response => {
                    alert(response.message);
                    var addModal = new bootstrap.Modal(document.getElementById('addStokModal'));
                    addModal.hide();
                    location
                        .reload(); // Memuat ulang halaman untuk melihat barang yang baru ditambahkan
                })
                .catch(error => {
                    console.error('Error adding barang:', error);
                });
        });
    </script>
@endsection
