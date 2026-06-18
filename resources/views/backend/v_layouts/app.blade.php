<!DOCTYPE html>
<html dir="ltr" lang="en">

<style>
  /* ============================================================== */
  /* CUSTOM UI TWEAKS - BIKIN BACKEND MAKIN SIKMA                     */
  /* ============================================================== */

  /* 1. Background Halaman Lebih Soft */
  body,
  .page-wrapper {
    background-color: #f4f6f9 !important;
  }

  /* 2. Percantik Card (Kotak Konten) */
  .card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    /* Shadow halus */
    transition: all 0.3s ease-in-out;
  }

  /* 3. Percantik Input Form */
  .form-control,
  .form-select {
    border-radius: 8px;
    border: 1px solid #dce1e7;
    padding: 10px 15px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  .form-control:focus,
  .form-select:focus {
    border-color: #0062FF !important;
    /* Warna biru saat diklik */
    box-shadow: 0 0 0 0.2rem rgba(0, 98, 255, 0.25) !important;
    /* Efek glow biru transparan */
    outline: 0;
  }

  /* 4. Percantik Tombol */
  .btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 8px 20px;
    letter-spacing: 0.3px;
    transition: all 0.2s;
  }

  .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  /* 5. Percantik Tabel */
  .table th {
    background-color: #f8f9fa;
    border-top: none !important;
    border-bottom: 2px solid #e9ecef !important;
    font-weight: 600;
    color: #4f5467;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
  }

  .table td {
    vertical-align: middle !important;
    border-top: 1px solid #f1f3f5;
  }

  .table-hover tbody tr:hover {
    background-color: #f8faff;
    /* Warna biru super muda pas di-hover */
  }

  /* 6. Label Form Biar Lebih Rapi */
  label {
    font-weight: 600;
    color: #3e5569;
    margin-bottom: 8px;
    font-size: 0.9rem;
  }


  /* Mengatur agar wrapper utama mengambil tinggi layar penuh */
  #main-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  /* Membuat page-wrapper mengisi ruang kosong agar footer terdorong ke bawah */
  .page-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  /* Memastikan konten di dalam page-wrapper mengisi ruang */
  .container-fluid {
    flex: 1;
  }
</style>

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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]> 
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> 
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> 
<![endif]-->
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
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none"
            href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <a class="navbar-brand" href="{{ route('backend.beranda') }}">
            <!-- Logo icon -->
            <b class="logo-icon p-l-10">
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <img src="{{ asset('image/icon_zackana_store.png') }}" alt="homepage" class="light-logo" />
            </b>
            <!--End Logo icon -->
            <!-- Logo text -->
            <span class="logo-text">
              <!-- dark Logo text -->
              <img src="{{ asset('image/logo_text.png') }}" alt="homepage"
                class="light-logo" />

            </span>
            <!-- Logo icon -->
            <!-- <b class="logo-icon"> -->
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

            <!-- </b> -->
            <!--End Logo icon -->
          </a>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-left mr-auto">
            <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
            <!-- ============================================================== -->
            <!-- create new -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->

          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-right">
            <!-- ============================================================== -->
            <!-- Comment -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- End Comment -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Messages -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- End Messages -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-
                expanded="false">
                @if (Auth::user()->foto)
                <img src="{{ asset('storage/img-user/' . Auth::user()->foto) }}" alt="user" class="rounded-circle" width="40">
                @else
                <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="rounded-circle" width="40"
                  alt="user" class="rounded-circle" width="31">
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated">
                <a class="dropdown-item" href="{{ route('backend.user.edit', Auth::user()->id) }}"><i class="ti-user m-r-5 m-l-5"></i> Profil
                  Saya</a>
                <a class="dropdown-item" href=""
                  onclick="event.preventDefault(); document.getElementById('keluar-app').submit();"><i
                    class="fa fa-power-off m-r-5 m-l-5"></i> Keluar</a>
                <div class="dropdown-divider"></div>

              </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
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
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav" class="p-t-30">
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.beranda') }}" aria-expanded="false"><i
                  class="mdi mdi-view-dashboard"></i><span class="hide-menu">Beranda</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('backend.user.index') }}" aria-expanded="false"><i
                  class="mdi mdi-account"></i><span class="hide-menu">User</span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-shopping"></i><span class="hide-menu">Data Produk </span></a>
              <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item">
                  <a href="{{ route('backend.kategori.index') }}" class="sidebar-link">
                    <i class="mdi mdi-chevron-right"></i>
                    <span class="hide-menu"> Kategori </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ route('backend.produk.index') }}" class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Produk </span></a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link" href="{{ route('backend.transaksi.index') }}">
                    <i class="mdi mdi-chevron-right"></i>
                    <span>Data Transaksi</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Laporan </span></a>
              <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item">
                  <a href="{{ route('backend.laporan.formuser') }}" class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> User </span></a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ route('backend.laporan.formproduk') }}" class="sidebar-link"><i class="mdi mdi-chevron-right"></i><span class="hide-menu"> Produk </span></a>
                </li>
              </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
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