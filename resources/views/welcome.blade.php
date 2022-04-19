<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
        <!-- Minified BootstrapCSS --->
        <link rel="stylesheet" href="{{ asset('app.css') }}">
        <title>Try HydePHP!</title>
    </head>
    <body>
        <div class="p-3 pt-4 bg-light">
            <div class="container d-flex mx-auto">
                <div class="col-lg-6">
                    <h1>Try HydePHP! <sup class="badge bg-primary" style="font-size: 14px">Beta</sup></h1>
                    <p class="lead">Hyde is a CLI based static site generator that can try right in your browser using this website.</p>
                </div>
                <div class="col-lg-6 my-auto text-lg-end">
                    <p>
                        <a class="btn btn-outline-primary m-1" href="https://hydephp.github.io/" role="button">Learn
                        More</a>
                        <a class="btn btn-primary m-1" href="https://hydephp.github.io/docs/master/installation"
                            role="button">Install Hyde!</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="container mx-auto my-4">
            <div class="row align-items-end flex-sm-nowrap">
                <header class="flex-shrink" style="width: fit-content; flex-shrink: 1;">
                    <h2>Writing a blog post in Markdown</h2>
                    <p class="lead">Hyde will generate a page with your content that you can view in your browser and
                        download.
                    </p>
                </header>
                <form id="preset-form" action="" method="GET" class="ms-auto my-3" style="max-width: 200px;">
                    <select name="preset" id="preset" class="form-select" onchange="loadPreset()">
                        <option value="">Load an example</option>
                        <optgroup label="Presets:">
                            <option value="lorem">Lorem Markdownum</option>
                            <option value="recipe">Recipe</option>
                        </optgroup>
                    </select>
                    <noscript>
                        <input type="submit" value="Load" />
                        <small>Note that any existing content will be overwritten.</small>
                    </noscript>
                </form>
            </div>
            <form action="{{ route('hyde.post.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group mb-3">
                    <label for="markdown" class="visually-hidden">Write some Markdown</label>
                    <textarea class="form-control" id="markdown" name="markdown" rows="20" maxlength="8192">{{ $preset }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Submit & Download HTML</button>
                </div>
            </form>
        </div>
        <div class="container mx-auto">
            <hr>
        </div>
        <div class="container mx-auto row px-0">
            <footer class="container mx-auto col-lg-6">
                <h4>Resources:</h4>
                <p class="text-center">
                <dl>
                    <div>
                        <dt class="d-inline">
                            Website:
                        </dt>
                        <dd class="d-inline">
                            <a href="https://hydephp.github.io/">https://hydephp.github.io/</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="d-inline">
                            Documentation:
                        </dt>
                        <dd class="d-inline">
                            <a href="https://hydephp.github.io/docs/">https://hydephp.github.io/docs/</a>
                        </dd>
                    </div>
                    <div>
                        <dt class="d-inline">
                            GitHub:
                        </dt>
                        <dd class="d-inline">
                            <a href="https://github.com/hydephp/hyde">https://github.com/hydephp/hyde</a>
                        </dd>
                    </div>
                </dl>
                </p>
            </footer>
            <div class="container mx-auto d-lg-none">
                <hr>
            </div>
            <section class="container mx-auto col-lg-6">
                <h4>Statistics:</h4>
                <div>
                    <x-stats-widget />
                </div>
            </section>
        </div>
        <div class="container mx-auto">
            <hr>
        </div>
        <section class="container mx-auto">
            <h4 class="h5">Attributions:</h4>
            <div>
                <ul>
                    <li>
                        Lorem Mardownum example by <a href="https://jaspervdj.be/lorem-markdownum/"
                            rel="nofollow noopener">https://jaspervdj.be/lorem-markdownum/</a>
                    </li>
                    <li>
                        <details>
                            <summary>
                                Recipe example adapted by Wikibooks, with cover image from Wikimedia Commons
                            </summary>
                            <small>
                                <ul>
                                    <li>
                                        Wikibooks contributors, "<a
                                            href="https://en.wikibooks.org/w/index.php?title=Cookbook:Swedish_Meatballs&oldid=2691161">Cookbook:
                                        Swedish Meatballs</a>," Wikibooks, The Free Textbook Project
                                        license Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0)
                                    </li>
                                    <li>
                                        Image "<a
                                            href="https://commons.wikimedia.org/wiki/File:DSC00045-swedish_meatballs.jpg">DSC00045-swedish_meatballs.jpg</a>"
                                        by Øyvind Holmstad, CC BY-SA 4.0 <https: //creativecommons.org/licenses/by-sa/4.0>,
                                        via Wikimedia Commons
                                    </li>
                                </ul>
                            </small>
                        </details>
                    </li>
                </ul>
            </div>
        </section>
        <script>
            function loadPreset() {
                if (confirm('Are you sure you want to load this preset? Any existing content will be overwritten.')) {
                    document.getElementById('preset-form').submit();
                } else {
                    document.getElementById('preset').value = '';
                }
            }
        </script>
    </body>
</html>