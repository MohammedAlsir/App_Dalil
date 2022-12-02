<!DOCTYPE html>
<html lang="ar" dir="rtl">
@include('layouts.head')
<!-- /header content -->
<body class="nav-md .">
<div class="container body">
    <div class="main_container">
       @include('layouts.header')

        <!-- top navigation -->
        @include('layouts.top_nav')
        <!-- /top navigation -->
        <!-- /header content -->

        <!-- page content -->


        <div class="right_col" role="main">

         @include('sweetalert::alert')
         @include('partials._msg')


            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
       @include('layouts.footer')
        <!-- /footer content -->
    </div>
</div>
<div id="lock_screen">
    <table>
        <tr>
            <td>
                <div class="clock"></div>
                <span class="unlock">
                    <span class="fa-stack fa-5x">
                      <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
                      <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                </span>
            </td>
        </tr>
    </table>
</div>


@include('layouts.js')

{{-- @stack('js') --}}





</body>



</html>
