<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Try HydePHP!</title>
</head>

<body>
    <header class="mx">
    </header>
    <div class="p-5 bg-light">
        <div class="container d-flex mx-auto">
            <div class="col-lg-6">
                <h1>Try HydePHP!</h1>
                <p class="lead">Try HydePHP right in your browser</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p>
                    <a class="btn btn-outline-primary m-1" href="https://hydephp.github.io/" role="button">Learn More</a>
                    <a class="btn btn-primary m-1" href="https://hydephp.github.io/docs/master/installation" role="button">Install Hyde!</a>
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto my-4">
        <h2>Try writing a blog post in Markdown</h2>
        <p class="lead">Hyde will generate a page with your content</p>

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
                <label for="markdown">Write some Markdown</label>
                <textarea class="form-control" id="markdown" name="markdown"
                    rows="20">{{ file_get_contents(resource_path('markdown/example.md')) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>