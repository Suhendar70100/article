<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="{{asset('assets')}}/" data-template="horizontal-menu-template-no-customizer">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Article</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('/assets/img/favicon/favicon.ico')}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/materialdesignicons.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/fonts/fontawesome.css')}}" />
  <!-- Menu waves for no-customizer fix -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/node-waves/node-waves.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/core.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/rtl/theme-default.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/typeahead-js/typeahead.css')}}" />
  <!-- Vendor -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('/assets/vendor/css/pages/page-help-center.css')}}" />
  <!-- Helpers -->
  <script src="{{asset('/assets/vendor/js/helpers.js')}}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{asset('/assets/js/config.js')}}"></script>
</head>

<body>
  <!-- Content -->

  <div class="">
    <div class="card">
      <!-- Help Center Header -->
      <div class="help-center-header d-flex flex-column justify-content-center align-items-center">
        <h3 class="text-center text-primary fw-semibold">Halo, bagaimana kami bisa membantu seputar kanker?</h3>
        <p class="text-center px-3 mb-5">Topik umum: pencegahan kanker, pilihan pengobatan, dan perawatan pasien</p>
        <a href="{{ route('sign-in') }}" class="btn btn-primary">Kunjungi Lebih Lanjut</a>
    </div>
    
      <!-- /Help Center Header -->

      <!-- Popular Articles -->
      <div class="help-center-popular-articles py-5">
        <div class="container-xl">
          <h2 class="text-center my-4">Popular Articles</h2>
          <div class="row mb-2">
            <div class="col-lg-10 mx-auto">
                <div class="row mb-5">
                    @foreach ($articles as $article)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top img-fluid" style="height: 300px; object-fit: cover;" src="{{ $article->image }}" alt="{{ $article->title }}" />
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">
                                    {{ Str::limit($article->content, 100, '...') }}
                                </p>
                                <a href="#" data-id='{{ $article->id }}' class="btn btn-outline-primary btn-detail">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>                
            </div>
          </div>
        </div>
      </div>
      <!-- /Popular Articles -->

      <!-- Help Area -->
      <div class="help-center-contact-us bg-help-center">
        <div class="container-xl">
            <div class="row justify-content-center py-5 my-4">
                <div class="col-md-8 col-lg-6 text-center">
                    <h4>Masih butuh bantuan?</h4>
                    <p class="mb-4">
                        Spesialis kami selalu siap membantu. Hubungi kami selama jam kerja atau kirimkan email 24/7 dan kami akan segera menghubungi Anda kembali.
                    </p>
                    <div class="d-flex justify-content-center flex-wrap gap-4">
                        <a href="javascript:void(0);" class="btn btn-primary">Kunjungi komunitas kami</a>
                        <a href="javascript:void(0);" class="btn btn-primary">Hubungi kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      <!-- /Help Area -->
    </div>
  </div>

  <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-add-new-cc">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body p-md-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <img id="modal-image" src="" alt="Image" class="rounded-lg shadow-lg mb-4" style="max-width: 100%; height: auto;" />
            <h5 id="modal-title" class="text-3xl font-bold text-gray-900 mb-3">Title</h5>
            <p id="modal-content" class="text-gray-700 text-lg leading-relaxed">Content</p>
          </div>
        </div>
      </div>
    </div>
</div>


  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="{{asset('/assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{asset('/assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{asset('/assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('/assets/vendor/libs/node-waves/node-waves.js')}}"></script>

  <script src="{{asset('/assets/vendor/libs/hammer/hammer.js')}}"></script>
  <script src="{{asset('/assets/vendor/libs/i18n/i18n.js')}}"></script>
  <script src="{{asset('/assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

  <script src="{{asset('/assets/vendor/js/menu.js')}}"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{asset('/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{asset('/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
  <script src="{{asset('/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>

  <!-- Main JS -->
  <script src="{{asset('/assets/js/main.js')}}"></script>

  <script>
    const BASE_URL = `{{url('/')}}`
    const articleUrl = `${BASE_URL}/api/article`

    $(document).on('click', '.btn-detail', function () {
    const articleId = $(this).data('id');
    
    $.ajax({
        url: `${articleUrl}/${articleId}`,
        method: 'GET',
        success: function (res) {
            $('#modal-title').text(res.title);
            $('#modal-image').attr('src', res.image);
            $('#modal-content').text(res.content);
            $('#largeModal').modal('show');
        },
        error: function (err) {
            console.error("Gagal mengambil data artikel", err);
            toastr.error('Gagal mengambil data artikel.', 'Error');
        }
    });
});
  </script>
</body>

</html>