@extends('layouts.pusat')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12  d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    {{-- @dd($data) --}}
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Penjualan Toko Terbanyak</h6>
                        {{-- <div class="fs-5 ms-auto dropdown">
                            <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                                    class="bi bi-three-dots"></i></div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Toko Cabang</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $val)
                                    {{-- @dd($val)
                                    {{ $key = 0 }} --}}
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val->toko->nametoko }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-box border">
                                                    <img src="assets/images/products/11.png" alt="">
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-name mb-1">{{ $val->barang->namebarang }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $val->total_jual }}</td>
                                        <td>Rp. {{ number_format($val->barang->harga, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($val->created_at)->format('M j, Y') }}</td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->
@endsection
