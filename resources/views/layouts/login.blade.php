{{-- <!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layouts.head')
<!-- /header content -->
<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <a class="hiddenanchor" id="reset"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{ route('login') }}" method="POST">
                @csrf
              <h1>تسجيل الدخول </h1>
              <div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="text" class="form-control" placeholder="البريد الالكتروني" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>

              </div>
              <div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" class="form-control" placeholder="كلمة المرور"  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />

              </div>
              <div>
                <button class="btn btn-default submit" >تسجيل الدخول </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">


                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> سوداكود </h1>
                  <p>2022 جميع الحقوق محفوظة لشركة سوداكود</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html> --}}
