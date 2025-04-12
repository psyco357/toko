<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir Modern</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .product-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #fff;
        }

        .cart-table td,
        .cart-table th {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-center">🛒 Sistem Kasir Sederhana</h2>

        <div class="row">
            <!-- Daftar Produk -->
            <div class="col-md-6">
                <h4>Daftar Produk</h4>
                <div id="product-list">
                    <!-- Produk akan di-generate oleh JS -->
                </div>
            </div>

            <!-- Keranjang Belanja -->
            <div class="col-md-6">
                <h4>Keranjang Belanja</h4>
                <table class="table table-bordered cart-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        <!-- Keranjang akan diisi oleh JS -->
                    </tbody>
                </table>

                <div class="text-right">
                    <h5>Total Bayar: <span id="grand-total">Rp 0</span></h5>
                    <button class="btn btn-success" onclick="checkout()">Bayar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @dd($data) --}}
    <!-- JavaScript -->
    <script>
        // Daftar produk (bisa diganti dari backend)
        const products = @json($data);

        const cart = {};

        // Tampilkan daftar produk
        function renderProducts() {
            const container = document.getElementById('product-list');
            container.innerHTML = '';
            products.forEach(product => {
                // console.log(product);
                const html = `
        <div class="product-card">
          <div class="d-flex justify-content-between">
            <div>
              <strong>${product.barang.namebarang}</strong><br>
              <small>Rp ${product.barang.harga.toLocaleString()}</small><br>
              <small>stok ${product.jumlah}</small>
            </div>
            <button class="btn btn-primary btn-sm" onclick="addToCart(${product.id})">+ Tambah</button>
          </div>
        </div>
      `;
                container.innerHTML += html;
            });
        }

        // Tambah produk ke keranjang
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            // console.log(product);
            if (!cart[productId]) {
                cart[productId] = {
                    ...product,
                    qty: 1
                };
            } else {
                cart[productId].qty += 1;
            }
            renderCart();
        }

        // Hapus produk dari keranjang
        function removeFromCart(productId) {
            delete cart[productId];
            renderCart();
        }

        // Render keranjang belanja
        function renderCart() {
            const cartBody = document.getElementById('cart-body');
            cartBody.innerHTML = '';
            let grandTotal = 0;

            Object.values(cart).forEach(item => {
                // console.log(item);
                const total = item.qty * item.barang.harga;
                grandTotal += total;

                cartBody.innerHTML += `
        <tr>
          <td>${item.barang.namebarang}</td>
          <td>${item.qty}</td>
          <td>Rp ${total.toLocaleString()}</td>
          <td><button class="btn btn-danger btn-sm" onclick="removeFromCart(${item.id})">✕</button></td>
        </tr>
      `;
            });

            document.getElementById('grand-total').innerText = `Rp ${grandTotal.toLocaleString()}`;
        }

        // Checkout (simulasi)
        function checkout() {
            if (Object.keys(cart).length === 0) {
                alert("Keranjang kosong!");
            } else {
                const cartItems = Object.values(cart);

                fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            items: cartItems
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert("Transaksi berhasil!");
                            Object.keys(cart).forEach(id => delete cart[id]); // Kosongkan keranjang
                            renderCart();
                            location.reload(); // 🔄 Reload halaman
                        } else {
                            alert("Gagal menyimpan transaksi!");
                        }
                    });
            }
        }

        // Initial render
        renderProducts();
        renderCart();
    </script>
</body>

</html>
