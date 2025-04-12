@extends('layouts.pusat')

@section('content')
    <div class="card">
        <div class="mb-3 mt-3 ms-3">
            <!-- Tombol Add New Barang -->
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addBarangModal">
                Add New Barang
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga barang</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td> <!-- Menampilkan nomor urut -->
                                <td>{{ $item->namebarang }}</td> <!-- Menampilkan nama user -->
                                <td>{{ $item->harga }}</td> <!-- Menampilkan posisi user -->
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <!-- View Button -->
                                        <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="View" data-id="{{ $item->id }}"
                                            onclick="viewBarang({{ $item->id }})">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Edit" data-id="{{ $item->id }}"
                                            onclick="editBarang({{ $item->id }})">
                                            <i class="bi bi-pencil-fill"></i>
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
    <div class="modal fade" id="addBarangModal" tabindex="-1" aria-labelledby="addBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBarangModalLabel">Add New Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addBarangForm">
                        @csrf
                        <div class="mb-3">
                            <label for="add-namebarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="add-namebarang" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-hargabarang" class="form-label">Harga Barang</label>
                            <input type="text" class="form-control" id="add-hargabarang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Barang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for View Barang -->
    <div class="modal fade" id="viewBarangModal" tabindex="-1" aria-labelledby="viewBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewBarangModalLabel">View Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Barang:</strong> <span id="view-namebarang"></span></p>
                    <p><strong>Harga Barang:</strong> <span id="view-hargabarang"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Barang -->
    <div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBarangForm">
                        @csrf
                        <input type="hidden" id="edit-barang-id">
                        <div class="mb-3">
                            <label for="edit-namebarang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="edit-namebarang" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-hargabarang" class="form-label">Harga Barang</label>
                            <input type="text" class="form-control" id="edit-hargabarang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Delete Confirmation -->
    <div class="modal fade" id="deleteBarangModal" tabindex="-1" aria-labelledby="deleteBarangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBarangModalLabel">Delete Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this barang?</p>
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
            // Handle the Add New Barang Form Submission
            document.getElementById('addBarangForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Ambil CSRF Token dari form input hidden
                var csrfToken = document.querySelector('input[name="_token"]').value;

                var namebarang = document.getElementById('add-namebarang').value;
                var hargabarang = document.getElementById('add-hargabarang').value;

                // Siapkan data untuk dikirimkan
                var data = {
                    _token: csrfToken,
                    namebarang: namebarang,
                    hargabarang: hargabarang
                };

                // Kirim data menggunakan fetch
                fetch('/barang/create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data), // Mengirim data dalam format JSON
                    })
                    .then(response => response.json())
                    .then(response => {
                        alert(response.success);
                        var addModal = new bootstrap.Modal(document.getElementById('addBarangModal'));
                        addModal.hide();
                        location
                            .reload(); // Memuat ulang halaman untuk melihat barang yang baru ditambahkan
                    })
                    .catch(error => {
                        console.error('Error adding barang:', error);
                    });
            });
        });

        // View Barang Function
        function viewBarang(id) {
            fetch(`/barang/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('view-namebarang').textContent = data.namebarang;
                    document.getElementById('view-hargabarang').textContent = data.harga;
                    var viewModal = new bootstrap.Modal(document.getElementById('viewBarangModal'));
                    viewModal.show();
                })
                .catch(error => {
                    console.error("Error fetching data: ", error);
                });
        }

        // Edit Barang Function
        function editBarang(id) {
            fetch(`/barang/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit-barang-id').value = data.id;
                    document.getElementById('edit-namebarang').value = data.namebarang;
                    document.getElementById('edit-hargabarang').value = data.harga;
                    var editModal = new bootstrap.Modal(document.getElementById('editBarangModal'));
                    editModal.show();
                })
                .catch(error => {
                    console.error("Error fetching data: ", error);
                });
        }

        // Handle the Edit Form Submission
        document.getElementById('editBarangForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // console.log('edits');
            var csrfToken = document.querySelector('input[name="_token"]').value;
            var id = document.getElementById('edit-barang-id').value;
            var namebarang = document.getElementById('edit-namebarang').value;
            var hargabarang = document.getElementById('edit-hargabarang').value;

            // Prepare data to send with fetch (FormData can also be used here)
            var data = {
                _token: csrfToken,
                namebarang: namebarang,
                hargabarang: hargabarang
            };

            fetch(`/barang/update/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data), // Sending JSON data
                })
                .then(response => response.json())
                .then(response => {
                    alert(response.success);
                    var editModal = new bootstrap.Modal(document.getElementById('editBarangModal'));
                    editModal.hide();
                    location.reload(); // Reload the page to reflect changes
                })
                .catch(error => {
                    console.error('Error updating data:', error);
                });
        });

        // Delete Confirmation Function
        function confirmDelete(id) {
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteBarangModal'));
            deleteModal.show();

            document.getElementById('confirm-delete').addEventListener('click', function() {
                fetch(`/barang/delete/${id}`, {
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
    </script>
@endsection
