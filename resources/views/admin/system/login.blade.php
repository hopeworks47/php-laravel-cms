<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset(env('APP_FAVICON')) }}" type="image/{{ env('APP_FAVICON_TYPE', 'png') }}" />

    <title>{{ env('APP_NAME') }} | Admin Panel</title>

    <!-- Bootstrap -->
    <link href="{{ asset('/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('/admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('/admin/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('/admin/build/css/custom.min.css') }}" rel="stylesheet">

    <style>
      .vlogin {
        background: #F7F7F7 url({{ asset('images/background.jpg') }}) no-repeat fixed center;
        background-size: cover;
      }
    </style>
  
    @if (env('RECAPTCHA_SITE_KEY_ADMIN', 'xxx') != 'xxx')
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
  </head>

  <body class="login vlogin">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">

          @include('_template_adm.message')
          
          <section class="login_content">
            <center>
              <img src="{{ asset('images/logo.png') }}" class="img-responsive" alt="{{ env('APP_NAME', 'Application Name') }}">
            </center>
            
            <form action="{{ route('admin.do_login') }}" method="POST" id="submitform">
              {{ csrf_field() }}
              <h1>{{ ucwords(lang('admin login form', $translation)) }}</h1>
              <div>
              <input type="text" name="login_id" value="{{ old('login_id') }}" class="form-control" placeholder="{{ ucwords(lang('username', $translation)) }}" required autocomplete="off" />
              </div>
              <div>
                <input type="password" name="login_pass" class="form-control" placeholder="{{ ucwords(lang('password', $translation)) }}" required autocomplete="off" />
              </div>

              @if (env('RECAPTCHA_SITE_KEY_ADMIN', 'xxx') != 'xxx')
                <div style="margin-bottom: 10px;">
                  <center>
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY_ADMIN') }}"></div>
                  </center>
                </div>
              @endif

              <div>
                <button type="submit" class="btn btn-primary btn-block submit">{{ ucfirst(lang('log in', $translation)) }}</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div>
                  <h1>{{ env('APP_NAME') }}</h1>
                  <p>
                    &copy; {{ date('Y') }} {{ env('APP_NAME') }} {{ 'v'.env('APP_VERSION') }}
                    @if (env('POWERED'))
                      - {{ lang('Powered by', $translation) }} <a href="{{ env('POWERED_URL') }}">{{ env('POWERED') }}</a>
                    @endif
                  </p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script>
      $(document).ready(function () {
        $("#submitform").on('submit',function(e) {
          // check reCAPTCHA
          var data_form = $(this).serialize();
          var split_data = data_form.split('&');
          var continue_step = true;
          // check empty reCAPTCHA
          $.each(split_data , function (index, value) {
            var split_tmp = value.split('=');
            if (split_tmp[0] == 'g-recaptcha-response' && split_tmp[1] == '') {
              continue_step = false;
              alert('Silahkan beri centang pada kotak "I\'m not a robot" (reCAPTCHA) untuk melanjutkan');
              return false;
            }
          });
          if (!continue_step) {
            return false;
          }

          return true;
        });
      });
    </script>
  </body>
</html>
