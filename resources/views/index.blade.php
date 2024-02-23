<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home | Gallery Michael</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper --> 
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-dark navbar-dark fixed-top shadow">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> --}}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home | Selamat Datang <b>{{ Auth::user()->name }}</b></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#baru" role="button">
          <i class="fas fa-upload"></i> Tambah Photo
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout" role="button">
          <i class="fas fa-th-large"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Timeline</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Timeline</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> --}}

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid py-5 mt-4" style="background-color: #f2f2f2">

        <!-- Timelime example  -->
        <div class="col">
     
            <!-- The time line -->
            <div class="timeline">
            
              @if(session('alert.tambah'))
                <div class="alert alert-success">
                  {{session('alert.tambah')}}
                </div>
              @endif
              
              @if(session('alert.ubah'))
                <div class="alert alert-warning" style="color: #fff">
                  {{session('alert.ubah')}}
                </div>
              @endif

              @if(session('alert.hapus'))
                <div class="alert alert-danger">
                  {{session('alert.hapus')}}
                </div>
              @endif

              
              {{-- <div class="time-label">
                <span class="bg-green">{{ date('d - M - Y', strtotime($item->created_at)) }} </span>
              </div> --}}

              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item col-11 shadow">


                  {{-- <div class="timeline-header ">
                    
                    <h1 class="ml-2">Gallery <b>{{ Auth::user()->name }}</b></h1>
                    
                  </div> --}}
                  
                  
                  <div class="timeline-body row pl-4 pr-4 pt-3">
                    
                    @foreach ($gallery as $item)
                    
                    <div class="container card col-md-2 ml-2 mr-2" style="background-color: #f2f2f2">

                      <div class="col">
                      
                        {{-- Push Menu --}}
                      
                        <i class="fas fa-bars mt-3" data-toggle="dropdown"></i>
                        <div class="dropdown-menu">

                          <div class="row">
                            
                            <a href="#" class="btn btn-warning fa fa-edit ml-4 col-sm-4" style="color: #fff" data-toggle="modal" data-target="#edit{{ $item->id }}">  </a>
  
                            <a href="{{ route('gallery.show', $item->id) }}" class="btn btn-danger col-sm-4 ml-2" onclick="return confirm('Apakah anda yakin menghapus gambar!')"><i class="fa fa-trash"></i> </a> 

                          </div>


                        
                          
                        </div>

                        <hr>

                      

                        {{-- Photo --}}
                        <div class="form-group">

                          <div class="col">
                          <a href="{{ Storage::url($item->photo) }}" 
                            data-toggle="lightbox" 
                            data-title="<b>{{ $item->judul }}</b> | {{ $item->deskripsi }}" 
                            data-gallery="gallery" 
                            data-footer="
                            <div class='sm-10'>
                              <span class='time'> <i>{{ date('d-M-Y', strtotime($item->created_at)) }} </i></span> 
                            </div>
                            
                            <div class='col-sm-2'>
                              <a href='{{ Storage::url($item->photo) }}' download='{{ basename(Storage::url($item->photo)) }}' class='btn btn-primary mr-5'><i class='fa fa-download'></i></a>
                            </div>">
                            
                            <img src="{{ Storage::url($item->photo) }}" class="img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt=""/>
                          </a>

                        </div>
                      </div>  

                      {{-- Edit --}}

                      <div class="modal fade" id="edit{{ $item->id }}">
                        <div class="modal-dialog modal-l">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">
                                Ubah Photo
                              </h4>
                              <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('gallery.update', $item->id) }}" enctype="multipart/form-data" method="post">
                              @csrf
                              @method('put')
                              <input type="hidden" id="id" name="id">
                              <div class="modal-body">
                                <div class="form-group">
                                  <label for="judul">Judul</label>
                                  <input type="text" name="judul" id="judul" class="form-control" value="{{ $item->judul }}">
                                </div>
                                <div class="form-group">
                                  <label for="Deskripsi">Deskripsi</label>
                                  <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control">{{ $item->deskripsi }}</textarea>
                                </div>
                                <div class="foorm-group">
                                  <label for="photo">Photo</label>
                                  <br>
                                  <input type="file" name="photo" id="photo">
                                </div>
                                <hr>

                                <img src="{{ Storage::url($item->photo) }}" class="img-fluid mb-2" alt=""/>

                                <hr>

                                <button type="submit" class="btn btn-warning" style="color: #fff">Simpan Perubahan</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      
                    </div>

                  </div>
                  
                  <br>
                  
                  @endforeach
                </div>
                  </div>

                </div>
                <div>
                  <i class="fas fa-clock bg-gray"></i>
                </div>
              </div>
              


            
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->

    <div class="modal fade" id="baru">
      <div class="modal-dialog modal-l">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
              Tambah Photo
            </h4>
            <button type="button" class="close" aria-label="Close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('gallery.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
              <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" placeholder="Isikan Judul" required>
              </div>
              <div class="form-group">
                <label for="Deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" placeholder="Isikan Deskripsi" required></textarea>
              </div>
              <div class="foorm-group">
                <label for="photo">Photo</label>
                <br>
                <input type="file" name="photo" id="photo" required>
              </div>
              <hr>

              <button type="submit" class="btn btn-success">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  <footer class="main-footer ml-0">
    <div class="float-right d-none d-sm-block">
      <b>Gallery</b> Michael
    </div>
    <strong>Copyright &copy; 2024 <a href="https://github.Mykerux" target="_blank">_mchlvp_</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Ekko Lightbox -->
<script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>

</body>
</html>
