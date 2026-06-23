<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_zackana_store.png') }}">
  <title>Admin Panel</title>
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/extra-libs/multicheck/multicheck.css') }}">
  <link href="{{ asset('backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">

  <style>
    /* ============================================================== */
    /* DESIGN SYSTEM - ROOT VARIABLES                                 */
    /* ============================================================== */
    :root {
      /* Brand Colors */
      --digital-blue: #0062FF;
      --slate-black: #0F172A;
      --alert-red: #EF4444;
      --warning-amber: #F59E0B;
      --safe-emerald: #10B981;

      /* Grayscale */
      --gray-90: #1E293B;
      --gray-70: #475569;
      --gray-50: #94A3B8;
      --gray-30: #CBD5E1;
      --gray-10: #F8FAFC;
      --white: #FFFFFF;

      /* Blue Ramps (Hover/Focus States) */
      --blue-90: #0038B3;
      --blue-70: #004EE6;
      --blue-30: #66A3FF;
      --blue-10: #E5F0FF;
      --blue-5: #F0F7FF;
    }

    /* ============================================================== */
    /* TYPOGRAPHY & BODY                                              */
    /* ============================================================== */
    body,
    .page-wrapper {
      background-color: var(--gray-10) !important;
      color: var(--gray-90);
      font-size: 14px;
      line-height: 24px;
      font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    h1,
    .h1 {
      font-size: 36px;
      line-height: 48px;
      font-weight: 700;
      color: var(--slate-black);
    }

    h2,
    .h2 {
      font-size: 24px;
      line-height: 36px;
      font-weight: 700;
      color: var(--slate-black);
    }

    h3,
    .h3 {
      font-size: 18px;
      line-height: 28px;
      font-weight: 700;
      color: var(--slate-black);
    }

    h4,
    .h4 {
      font-size: 16px;
      line-height: 24px;
      font-weight: 700;
      color: var(--slate-black);
    }

    .text-micro {
      font-size: 10px;
      line-height: 16px;
    }

    .text-small {
      font-size: 12px;
      line-height: 20px;
      color: var(--gray-70);
    }

    /* ============================================================== */
    /* SPACING & LAYOUT                                               */
    /* ============================================================== */
    #main-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .page-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .container-fluid {
      flex: 1;
      padding: 24px;
    }

    /* ============================================================== */
    /* UI COMPONENTS (Card, Button, Form, Table)                      */
    /* ============================================================== */
    .card {
      border-radius: 12px;
      border: 1px solid var(--gray-30);
      background-color: var(--white);
      box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
      margin-bottom: 24px;
    }

    .btn {
      border-radius: 8px;
      font-weight: 700;
      font-size: 14px;
      padding: 8px 16px;
      transition: all 0.2s ease;
      border: none;
    }

    .btn-primary {
      background-color: var(--digital-blue);
      color: var(--white);
    }

    .btn-primary:hover {
      background-color: var(--blue-70);
    }

    .btn-success {
      background-color: var(--safe-emerald);
      color: var(--white);
    }

    .btn-danger {
      background-color: var(--alert-red);
      color: var(--white);
    }

    .btn-warning {
      background-color: var(--warning-amber);
      color: var(--slate-black);
    }

    .btn-secondary {
      background-color: var(--gray-30);
      color: var(--slate-black);
    }

    .btn-secondary:hover {
      background-color: var(--gray-50);
      color: var(--white);
    }

    label {
      font-size: 12px;
      font-weight: 700;
      color: var(--gray-70);
      margin-bottom: 8px;
    }

    .form-control,
    .form-select {
      border-radius: 8px;
      border: 1px solid var(--gray-50);
      padding: 12px 16px;
      font-size: 14px;
      color: var(--gray-90);
      background-color: var(--white);
      transition: all 0.2s ease;
    }

    /* FIX KHUSUS DROPDOWN/SELECT YANG KEPOTONG */
    select.form-control,
    select.form-select,
    .form-select {
      height: 48px !important;
      /* Paksa tingginya presisi 48px biar sama kayak input lain */
      padding-top: 8px !important;
      /* Adjust dikit padding atas-bawah biar teksnya di tengah */
      padding-bottom: 8px !important;
      vertical-align: middle !important;
    }

    .table th {
      background-color: var(--gray-10);
      border-bottom: 2px solid var(--gray-30) !important;
      border-top: none !important;
      font-weight: 700;
      color: var(--gray-70);
      font-size: 12px;
      text-transform: uppercase;
      padding: 12px 16px;
    }

    .table td {
      vertical-align: middle !important;
      border-top: 1px solid var(--gray-30);
      color: var(--gray-90);
      padding: 16px;
    }

    .table-hover tbody tr:hover {
      background-color: var(--blue-5);
    }

    /* ============================================================== */
    /* 1. FIX TOTAL TOPBAR: FULL AKRILIK PUTIH (ANTI HITAM BELANG)    */
    /* ============================================================== */
    .topbar,
    header.topbar,
    .topbar .top-navbar,
    .topbar .top-navbar .navbar-header,
    .topbar .top-navbar .navbar-collapse,
    .topbar .navbar-collapse[data-navbarbg="skin5"],
    #main-wrapper[data-layout="vertical"] .topbar .top-navbar .navbar-header {
      background: rgba(255, 255, 255, 0.85) !important;
      backdrop-filter: blur(12px) !important;
      -webkit-backdrop-filter: blur(12px) !important;
      border-bottom: 1px solid rgba(15, 23, 42, 0.08) !important;
    }

    /* PAKSA SEMUA ICON & TEKS DI NAVBAR JADI GELAP (BIAR KONTRAS) */
    .topbar .nav-toggler,
    .topbar .nav-toggler i,
    .topbar .topbartoggler,
    .topbar .topbartoggler i,
    .topbar .nav-link,
    .topbar .nav-link i,
    .topbar .navbar-nav .nav-link,
    .topbar .dropdown-toggle,
    .topbar i {
      color: var(--slate-black) !important;
      opacity: 1 !important;
    }

    /* EFEK HOVER BIAR MODERN PAS DI-SOREK MOUSE */
    .topbar .nav-link:hover,
    .topbar .nav-toggler:hover i,
    .topbar .navbar-nav .nav-link:hover i {
      color: var(--digital-blue) !important;
    }

    /* Garis pembatas tipis antar item biar rapi */
    .topbar .navbar-nav>.nav-item {
      border-left: 1px solid rgba(0, 0, 0, 0.05);
    }

    /* 2. Sidebar Akrilik Putih Transparan */
    .left-sidebar[data-sidebarbg="skin5"],
    .left-sidebar[data-sidebarbg="skin5"] ul {
      background: rgba(255, 255, 255, 0.6) !important;
      backdrop-filter: blur(16px) !important;
      -webkit-backdrop-filter: blur(16px) !important;
      border-right: 1px solid rgba(255, 255, 255, 0.8) !important;
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.03) !important;
    }

    /* 3. Teks Menu Sidebar Normal Mode */
    .sidebar-nav ul .sidebar-item .sidebar-link {
      color: var(--gray-70) !important;
      opacity: 1;
      padding: 12px 16px;
      border-radius: 8px;
      margin: 4px 16px;
      transition: all 0.2s ease;
    }

    .sidebar-nav ul .sidebar-item .sidebar-link i {
      color: var(--gray-70) !important;
    }

    /* 4. Efek Normal Hover */
    .sidebar-nav ul .sidebar-item .sidebar-link:hover {
      background-color: var(--blue-10) !important;
      color: var(--digital-blue) !important;
    }

    .sidebar-nav ul .sidebar-item .sidebar-link:hover i {
      color: var(--digital-blue) !important;
    }

    /* 5. Menu Sidebar yang AKTIF */
    .sidebar-nav ul .sidebar-item.selected>.sidebar-link,
    .sidebar-nav ul .sidebar-item.active>.sidebar-link {
      background-color: var(--digital-blue) !important;
      color: var(--white) !important;
      box-shadow: 0 4px 12px rgba(0, 98, 255, 0.25);
    }

    .sidebar-nav ul .sidebar-item.selected>.sidebar-link i,
    .sidebar-nav ul .sidebar-item.active>.sidebar-link i {
      color: var(--white) !important;
    }

    /* 6. Kotak Alert di Beranda */
    .alert,
    .card-body>div[style*="background"] {
      background-color: var(--blue-5) !important;
      border: 1px solid var(--blue-10) !important;
      color: var(--blue-90) !important;
      border-radius: 12px;
    }

    .alert h4,
    .alert strong,
    .card-body>div[style*="background"] strong {
      color: var(--digital-blue) !important;
      font-size: 18px;
      font-weight: 700;
    }

    .alert hr,
    .card-body>div[style*="background"] hr {
      border-top-color: var(--blue-30) !important;
      opacity: 0.3;
    }

    /* ============================================================== */
    /* 7. FIX FINAL: HOVER MENU & SUBMENU NYATU ANTI HILANG           */
    /* ============================================================== */

    /* 1. Bebaskan elemen dari kurungan mini-sidebar */
    #main-wrapper[data-sidebartype="mini-sidebar"] .left-sidebar,
    #main-wrapper[data-sidebartype="mini-sidebar"] .scroll-sidebar {
      overflow: visible !important;
    }

    /* 2. Container tiap menu dibikin relative sbg patokan */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item {
      position: relative !important;
    }

    /* 3. Bentuk kotak menu (icon doang) pas lagi diam */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>.sidebar-link {
      width: 45px !important;
      height: 45px !important;
      margin: 8px auto !important;
      padding: 10px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      border-radius: 8px !important;
      transition: none !important;
    }

    /* Sembunyikan teks & panah dropdown saat diam */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>.sidebar-link span.hide-menu,
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>.sidebar-link.has-arrow:after {
      display: none !important;
    }

    /* ============================================================== */
    /* 4. EFEK PAS MOUSE DIARAHIN (HOVER)                             */
    /* ============================================================== */

    /* A. Link utama langsung memanjang (Tulisan Laporan/Produk nongol) */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item:hover>.sidebar-link {
      width: 230px !important;
      position: absolute !important;
      left: 12px !important;
      /* Sejajar sama icon */
      top: 0 !important;
      justify-content: flex-start !important;
      padding-left: 16px !important;
      background-color: var(--blue-10) !important;
      color: var(--digital-blue) !important;
      z-index: 99999 !important;
      box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.05) !important;
    }

    /* Paksa tulisan utama muncul di sebelah icon */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item:hover>.sidebar-link span.hide-menu {
      display: inline-block !important;
      margin-left: 12px !important;
      font-weight: 600 !important;
    }

    /* B. Submenu (User/Produk) nempel PRESISI di bawah link utama */
    /* Normalnya disembunyikan dulu */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>ul.collapse {
      display: none !important;
    }

    /* Pas di-hover, munculin langsung nempel tanpa celah */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item:hover>ul.collapse {
      display: block !important;
      height: auto !important;
      position: absolute !important;
      left: 12px !important;
      /* Harus sama persis kayak menu utama */
      top: 45px !important;
      /* Nempel presisi di garis bawah menu utama */
      width: 230px !important;
      background-color: var(--white) !important;
      z-index: 99998 !important;
      border-radius: 0 0 8px 8px !important;
      /* Ujung bawahnya aja yang melengkung */
      box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.1) !important;
      padding: 8px 0 !important;
    }

    /* C. Benerin posisi teks di dalem submenu-nya */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>ul.collapse .sidebar-item .sidebar-link {
      width: 100% !important;
      position: relative !important;
      left: auto !important;
      top: auto !important;
      margin: 0 !important;
      padding: 10px 16px 10px 20px !important;
      background: transparent !important;
      box-shadow: none !important;
      border-radius: 0 !important;
    }

    /* Tulisan "User" & "Produk" wajib tampil! */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>ul.collapse .sidebar-item .sidebar-link span.hide-menu {
      display: inline-block !important;
      color: var(--gray-70) !important;
      margin-left: 10px !important;
    }

    /* Efek pas submenu di-hover */
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>ul.collapse .sidebar-item .sidebar-link:hover span.hide-menu,
    #main-wrapper[data-sidebartype="mini-sidebar"] .sidebar-nav ul .sidebar-item>ul.collapse .sidebar-item .sidebar-link:hover i {
      color: var(--digital-blue) !important;
    }
  </style>

</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin6">
      <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header" data-logobg="skin6">
          <a class="nav-toggler waves-effect waves-light d-block d-md-none"
            href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

          <a class="navbar-brand" href="{{ route('backend.beranda') }}">
            <b class="logo-icon p-l-10">
              <img src="{{ asset('image/icon_zackana_store.png') }}" alt="homepage" class="light-logo" />
            </b>
            <span class="logo-text">
              <img src="{{ asset('image/logo_text.png') }}" alt="homepage" class="light-logo" />
            </span>
          </a>

          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
          <ul class="navbar-nav float-left mr-auto">
            <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
          </ul>

          <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if (Auth::user()->foto)
                <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user" class="rounded-circle" width="40">
                @else
                <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="rounded-circle" width="40" alt="user">
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated">
                <a class="dropdown-item" href="{{ route('backend.user.edit', Auth::user()->id) }}"><i class="ti-user m-r-5 m-l-5"></i> Profil Saya</a>
                <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Keluar</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="p-t-30">

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.beranda') }}" aria-expanded="false">
                <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Beranda</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.user.index') }}" aria-expanded="false">
                <i class="mdi mdi-account"></i><span class="hide-menu">User</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.banner.index') }}" aria-expanded="false">
                <i class="mdi mdi-image"></i><span class="hide-menu">Banner</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-shopping"></i><span class="hide-menu">Data Produk </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="{{ route('backend.kategori.index') }}" class="sidebar-link">
                    <i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Kategori </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ route('backend.produk.index') }}" class="sidebar-link">
                    <i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Produk </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ route('backend.transaksi.index') }}" class="sidebar-link">
                    <i class="mdi mdi-chevron-right"></i><span class="hide-menu">Data Transaksi</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-receipt"></i><span class="hide-menu">Laporan </span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="{{ route('backend.laporan.formuser') }}" class="sidebar-link">
                    <i class="mdi mdi-chevron-right"></i><span class="hide-menu"> User </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ route('backend.laporan.formproduk') }}" class="sidebar-link">
                    <i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Produk </span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->

      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->

        <!-- @yieldAwal -->
        @yield('content')
        <!-- @yieldAkhir-->

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <footer class="footer text-center">
        <span>© 2026 Toko Paling Sikma. All rights reserved.</span>
      </footer>
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="{{ asset('backend/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('backend/extra-libs/sparkline/sparkline.js') }}"></script>
  <!--Wave Effects -->
  <script src="{{ asset('backend/dist/js/waves.js') }}"></script>
  <!--Menu sidebar -->
  <script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
  <!--Custom JavaScript -->
  <script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
  <!-- this page js -->
  <script src="{{ asset('backend/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
  <script src="{{ asset('backend/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
  <script src="{{ asset('backend/extra-libs/DataTables/datatables.min.js') }}"></script>
  <script>
    /**************************************** 
     *       Basic Table                   * 
     ****************************************/
    $('#zero_config').DataTable();
  </script>

  <!-- form keluar app -->
  <form id="keluar-app" action="{{ route('backend.logout') }}" method="POST" class="d-none">
    @csrf
  </form>
  <!-- form keluar app end -->

  <!-- sweetalert -->
  <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}"></script>
  <!-- sweetalert End -->
  <!-- konfirmasi success-->
  @if (session('success'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: "{{ session('success') }}"
    });
  </script>
  @endif
  <!-- konfirmasi success End-->

  <script type="text/javascript">
    //Konfirmasi delete 
    $('.show_confirm').click(function(event) {
      var form = $(this).closest("form");
      var konfdelete = $(this).data("konf-delete");
      event.preventDefault();
      Swal.fire({
        title: 'Konfirmasi Hapus Data?',
        html: "Data yang dihapus <strong>" + konfdelete + "</strong> tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, dihapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success')
            .then(() => {
              form.submit();
            });
        }
      });
    });
  </script>
  <script>
    // previewFoto 
    function previewFoto() {
      const foto = document.querySelector('input[name="foto"]');
      const fotoPreview = document.querySelector('.foto-preview');
      fotoPreview.style.display = 'block';
      const fotoReader = new FileReader();
      fotoReader.readAsDataURL(foto.files[0]);
      fotoReader.onload = function(fotoEvent) {
        fotoPreview.src = fotoEvent.target.result;
        fotoPreview.style.width = '100%';
      }
    }
  </script>
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <!-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> -->
  <script>
    // Cari elemen dengan id 'ckeditor'
    const editorElement = document.querySelector('#ckeditor');

    // Hanya jalankan CKEditor jika elemen tersebut ditemukan di halaman ini
    if (editorElement) {
      ClassicEditor
        .create(editorElement)
        .catch(error => {
          console.error(error);
        });
    }
  </script>
</body>

</html>