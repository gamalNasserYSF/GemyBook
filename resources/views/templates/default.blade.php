<!DOCTYPE html>
<html>
    <head>       
        <title>GemyBook|Home</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />                    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        
        @yield('style')        
    </head>
    
    <body>
        
        @include('templates.partials.nav')      
            
            <section id="wrapper">
                <section id="content" class="padding-top-lg">
                    <div class="container padding-top-lg margin-top-lg">
                       @include('templates.partials.alerts')
                       @yield('content')
                    </div>
                </section>
            </section>
        
        @yield('script')
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.js"></script>
        <script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {    
                $("#aaa").delay(4000).fadeOut("slow");
            });
        </script>

    </body>
</html>
