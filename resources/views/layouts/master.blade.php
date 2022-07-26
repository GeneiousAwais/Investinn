<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

    <head>
        
        <meta charset="utf-8" />
        <title>Investinn | Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @include('layouts.header_scripts')
    	@stack('header_scripts')

    </head>

    <body>

        <div id="layout-wrapper">

            @include('layouts.header')
            @include('layouts.side_nav')

            <div class="vertical-overlay"></div>

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        
                        @include('layouts.breadcrum')
                        @yield('content')
                       
                    </div>
                </div>

                @include('layouts.footer')

            </div>
        </div>
        
        @include('layouts.theme_setting')
        @include('layouts.footer_scripts')

    	@stack('footer_scripts')


    </body>

</html>