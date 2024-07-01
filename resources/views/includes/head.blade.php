<!-- Searchers -->
<meta name="referrer" content="origin"/>
<meta name="document-state" content="dynamic"/>
<meta name="robots" content="noarchive"/>

<!-- SEO -->
@if(View::hasSection('page.description'))
    <meta name="description" content="@yield('page.description', '')"/>
@endif
@if(View::hasSection('page.keywords'))
    <meta name="keywords" content="@yield('page.keywords', '')"/>
@endif
@if(View::hasSection('page.canonical'))
    <link rel="canonical" href="@yield('page.canonical', '/')"/>
@endif

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
