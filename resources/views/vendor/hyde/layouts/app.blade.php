<!DOCTYPE html>
<html lang="{{ config('hyde.language', 'en') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:site_name" content="{{ config('hyde.name', 'Try HydePHP') }}">
    <title>{{ isset($title) ? config('hyde.name', 'Try HydePHP') . ' - ' . $title : config('hyde.name', 'Try HydePHP') }}</title>

    <!-- Config Defined Tags -->
    @foreach (config('hyde.meta', []) as $name => $content) 
    <meta name="{{ $name }}" content="{{ $content }}">
    @endforeach

    @stack('meta')
  
    <!-- The compiled Tailwind styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/hydephp/hydephp.github.io@00a66a5f9f76ef7af960356f4110c76b3408ceec/media/app.min.css">
    
    <!-- The core Hyde stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/hydephp/hydefront@v1.0.0/hyde.css">
  
    <!-- Include any extra tags to include in the <head> section -->
    @include('hyde::layouts.meta') 

    <script> /** Check the local storage for theme preference to avoid FOUC. */ if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) { document.documentElement.classList.add('dark'); } else { document.documentElement.classList.remove('dark') } </script>
</head>
<body id="app" class="flex flex-col min-h-screen overflow-x-hidden dark:bg-gray-900 dark:text-white">
    <a href="#content" id="skip-to-content">Skip to content</a>
    @includeUnless($withoutNavigation ?? false, 'hyde::layouts.navigation') 

    <section>
        @yield('content') 
    </section>

    @includeUnless(config('hyde.footer.enabled', true) && ($withoutNavigation ?? false), 'hyde::layouts.footer') 

    <!-- The core Hyde scripts -->
    <script defer src="https://cdn.jsdelivr.net/gh/hydephp/hydefront@v1.0.0/hyde.min.js"></script>

    @stack('scripts')

    <!-- Include any extra scripts to include in before the closing <body> tag -->
    @include('hyde::layouts.scripts') 
</body>
</html>
