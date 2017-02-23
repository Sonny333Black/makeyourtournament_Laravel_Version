<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="FIFA Turnier Party Zocken Planen">
        <meta name="author" content="Christian Schulz">

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
        <link href="https://fonts.googleapis.com/css?family=News+Cycle" rel="stylesheet">

        <title>makeyourtournament</title>

        {!! Html::style('/css/bootstrap.min.css') !!}
        {!! Html::style('/fontA/css/font-awesome.min.css') !!}
        {!! Html::style('/css/myStyle.css') !!}
        {!! Html::script('//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js') !!}


    <!-- Piwik -->
        <script type="text/javascript">
            var _paq = _paq || [];
            _paq.push(["setDomains", ["*.www.makeyourtournament.de","*.www.makeyourtournament.de"]]);
            _paq.push(["setDoNotTrack", true]);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="//sonnypiwik.de/";
                _paq.push(['setTrackerUrl', u+'piwik.php']);
                _paq.push(['setSiteId', '3']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <noscript><p><img src="//sonnypiwik.de/piwik.php?idsite=3" style="border:0;" alt="" /></p></noscript>
        <!-- End Piwik Code -->


    </head>
<body>
    @include('static/navigation')

    <div id="wrapper" class="container-fluid">
        @yield('content')
    </div>
    {{--*************scripte************--}}
    {!! Html::script('/js/bootstrap.min.js') !!}

    {{--{!! Html::script('https://www.google.com/recaptcha/api.js') !!}--}}






</body>
</html>
