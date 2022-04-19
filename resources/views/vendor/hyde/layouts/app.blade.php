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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/hydephp/hydefront@v1.1.0/tailwind.min.css">
    
    <!-- The core Hyde stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/hydephp/hydefront@v1.0.0/hyde.css">
  
    <!-- Include any extra tags to include in the <head> section -->
    @include('hyde::layouts.meta') 

    <script> /** Check the local storage for theme preference to avoid FOUC. */ if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) { document.documentElement.classList.add('dark'); } else { document.documentElement.classList.remove('dark') } </script>
</head>
<header style="width: 100%; height: 4rem; padding: 0.5rem 2rem; background-color: purple; color: white; font-family: sans-serif; font-weight: 500; display: flex; align-items: center; justify-content: space-between;">
   <div>
    <span>This preview page was rendered using HydePHP through the <a href="{{ config('app.url') }}" style="font-weight: 700; text-decoration: underline;">TryHyde!</a> website</span>
    <a href="{{ config('app.url') }}" role="button" style="box-sizing: border-box; color: rgb(255, 255, 255); text-decoration: none; cursor: pointer; display: inline-block; font-weight: 400; line-height: 1.5; text-align: center; vertical-align: middle; user-select: none; background-color: rgb(13, 110, 253); border: 1px solid rgb(13, 110, 253); padding: 0.25rem 0.5rem; font-size: 0.875rem; border-radius: 0.2rem; transition: color 0.15s ease-in-out 0s, background-color 0.15s ease-in-out 0s, border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s; margin: 0.25rem 0.25rem !important; font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Try it yourself!</a>
   </div>

    <div>
        @isset($downloadLink)
            <a href="{{ $downloadLink }}" role="button" style="box-sizing: border-box; color: rgb(255, 255, 255); text-decoration: none; cursor: pointer; display: inline-block; font-weight: 400; line-height: 1.5; text-align: center; vertical-align: middle; user-select: none; background-color: rgb(13, 110, 253); border: 1px solid rgb(13, 110, 253); padding: 0.25rem 0.5rem; font-size: 0.875rem; border-radius: 0.2rem; transition: color 0.15s ease-in-out 0s, background-color 0.15s ease-in-out 0s, border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s; margin: 0.25rem 0.25rem !important; font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Download HTML</a>
        @endisset
       
        <a href="https://hydephp.github.io/docs/master/installation" role="button" style="box-sizing: border-box; color: rgb(255, 255, 255); text-decoration: none; cursor: pointer; display: inline-block; font-weight: 400; line-height: 1.5; text-align: center; vertical-align: middle; user-select: none; background-color: rgb(13, 110, 253); border: 1px solid rgb(13, 110, 253); padding: 0.25rem 0.5rem; font-size: 0.875rem; border-radius: 0.2rem; transition: color 0.15s ease-in-out 0s, background-color 0.15s ease-in-out 0s, border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s; margin: 0.25rem 0.25rem !important; font-family: system-ui, -apple-system, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px;">Install Hyde</a>
    </div>
</header>
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
