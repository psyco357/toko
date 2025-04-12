   <!--start sidebar -->
   {{-- @dd($user->getOriginal('idtoko')) --}}
   <aside class="sidebar-wrapper" data-simplebar="true">
       <div class="sidebar-header">
           <div>
               <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
           </div>
           <div>
               <h4 class="logo-text">Onedash</h4>
           </div>
           <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
           </div>
       </div>
       <!--navigation-->
       <ul class="metismenu" id="menu">
           @if ($user->getOriginal('idtoko') == null || $user->getOriginal('idtoko') == '')
               <li>
                   <a href="dashboard">
                       <div class="parent-icon"><i class="bi bi-house-fill"></i>
                       </div>
                       <div class="menu-title">Dashboard</div>
                   </a>
               </li>
               <li>
                   <a href="toko">
                       <div class="parent-icon"><i class="bi bi-house-fill"></i>
                       </div>
                       <div class="menu-title">Data Toko</div>
                   </a>
               </li>
               <li>
                   <a href="javascricpt:;" class="has-arrow">
                       <div class="parent-icon"><i class="bi bi-house-fill"></i>
                       </div>
                       <div class="menu-title">Barang</div>
                   </a>
                   <ul>
                       <li><a href="barang"> <i class="bi bi-circle"></i> Barang Master</a></li>
                       <li><a href="stok"> <i class="bi bi-circle"></i> Stok Barang</a></li>
                   </ul>
               </li>
               <li>
                   <a href="javascript:;" class="has-arrow">
                       <div class="parent-icon"><i class="bi bi-house-fill"></i>
                       </div>
                       <div class="menu-title">Penjualan</div>
                   </a>
                   <ul>
                       {{-- <li> <a href="penjualan"><i class="bi bi-circle"></i>Penjualan</a>
                       </li> --}}
                       <li> <a href="reportjual"><i class="bi bi-circle"></i>Report Penjualan</a>
                       </li>
                   </ul>
               </li>
           @else
               <li>
                   <a href="dashboard">
                       <div class="parent-icon"><i class="bi bi-house-fill"></i>
                       </div>
                       <div class="menu-title">Dashboard</div>
                   </a>
               </li>
               <li>
                   <a href="javascript:;" class="has-arrow">
                       <div class="parent-icon"><i class="bi bi-house-fill"></i>
                       </div>
                       <div class="menu-title">Penjualan</div>
                   </a>
                   <ul>
                       <li> <a href="penjualan"><i class="bi bi-circle"></i>Penjualan</a>
                       </li>
                       <li> <a href="reportjual"><i class="bi bi-circle"></i>Report Penjualan</a>
                       </li>
                   </ul>
               </li>
           @endif

       </ul>
       <!--end navigation-->
   </aside>
   <!--end sidebar -->
