<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <?php setlocale(LC_TIME, 'fr_FR.utf8', 'fr'); ?>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <meta name="robots" content="noindex" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Kalisso.com">
    <meta name="home" content="Achat et vente en ligne parmi des millions de produits en stock. Livraison gratuite à partir de 2.000Fcfa d'achats. Vos articles à petits prix : culture, high-tech, mode, jouets, sport ...">
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="facebook-domain-verification" content="gzle0io231unljen9dwbd88zbu03w0" />
    <meta name="p:domain_verify" content="54a2f03ee61e85df18a9aee867e4baa4" />
    <title>Kalisso.com - Le centre commercial en ligne</title>
    <link rel="shortcut icon" href="{{ asset('site_kali_icon.png') }}" type="image/png" title="icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    @include('assets.css')

    <!-- Global site tag (gtag.js) - Google Ads: 10852532037 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10852532037"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-10852532037');
    </script>

    <!-- Event snippet for Website traffic conversion page -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-10852532037/Fy9UCMqHwKMDEMX-8bYo'
        });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6116222440625591" crossorigin="anonymous"></script>



</head>

<body>
    <div id="app">
        <!-- <transition name="slide"
        enter-active-class="animated fadeIn"
        leave-active-class="animated fadeOut"
        mode="out-in"
        >
    </transition>  -->
        <router-view></router-view>
    </div>

    <script async src="https://pop-ups.sendpulse.com/assets/loader.js" data-chats-widget-id="e88d5045-6c08-4758-840a-7f6310d7eb6b"></script>
    <script async src="{{ mix('js/app.js') }}"></script>
    <!-- Start of kalisso Zendesk Widget script -->
</body>

</html>