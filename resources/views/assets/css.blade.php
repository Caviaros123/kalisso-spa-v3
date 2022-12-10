<!-- Material Design for Bootstrap fonts and icons -->

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!-- {{-- //import header css --}} -->

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">


<!-- jQuery -->
<script src="{{ asset('js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
{{-- <script src="{{asset('css/bootstrap.bundle.min.js')}}" type="text/javascript"></script> --}}
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" />

<!-- Font awesome 5 -->
<link href="{{ asset('fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">

<!-- custom style -->
<link href="{{ asset('css/ui.css') }}" rel="stylesheet" type="text/css" />
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" /> --}}
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />

<!-- custom javascript -->
<script src="{{ asset('/js/script.js') }}" type="text/javascript"></script>

<!-- get jQuery from the google apis or use your own -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- CSS STYLE-->
<link rel="stylesheet" type="text/css" href="/css/xzoom.css" media="all" />

<!-- XZOOM JQUERY PLUGIN  -->
<script type="text/javascript" src="/js/xzoom.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase.js"></script>

<!-- Facebook Pixel Code -->
<script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '242037474240129');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=242037474240129&ev=PageView&noscript=1" /></noscript>


{{-- //facebook init --}}
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '226942292235939',
            xfbml: true,
            version: 'v12.0'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


<!-- Vocads -->
<script>
    var vocadsWidgetId = '6dfc3ec2-44f3-4054-84af-eb71e38ca21f';
    var vocads_ = window.vocads_ || {};
    (function() {
        var s = document.createElement('script');
        s.async = true;
        s.src = 'https://cdn.vocads.com/widget/v1.js';
        var parent_node = document.head || document.body;
        parent_node.appendChild(s);
    })();
</script>




<!-- <script id="mcjs">
    ! function(c, h, i, m, p) {
        m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m,
            p)
    }(document, "script",
        "https://chimpstatic.com/mcjs-connected/js/users/594986ad5598a994d46f4a17f/6ddb370b31a3d957474c953ec.js");
</script> -->
<!-- {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9de644d8a0cf1a1c4aec', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        alert(JSON.stringify(data));
    });
</script> --}} -->

{{-- <script src="https://www.google.com/recaptcha/api.js?render=6Le205AcAAAAAFWEbA4Y01opWlIC5t99WUABoLSu"></script> --}}

{{-- <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
</script> --}}

{{-- <script>
    function onSubmit(token) {
      document.getElementById("recaptcha-form").submit();
    }
</script> --}}


<!-- //ZONE google analytics  -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-GYX9DFZG8J"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-GYX9DFZG8J');
</script>


<style>
    .img {
        max-width: 100%;
        /* or any custom size */
        max-height: 100%;
        object-fit: contain;
    }

    input[type=checkbox] {
        transform: scale(1.4);
        margin: 15px;
        cursor: pointer;
    }

    .c5 {
        filter: hue-rotate(299deg)
    }

    /* Prevent cursor being `text` between checkboxes */
    body {
        cursor: default
    }

    html {
        zoom: 99%
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.2s;
    }

    /* a:hover{
        color:rgb(241, 0, 0)
    } */
</style>

<script charset="UTF-8" src="//web.webpushs.com/js/push/dadb01f38dd4a150c94d667fc0bcbab5_1.js" async></script>