<?php

namespace App\Http\Controllers;

use Hyde\Framework\Actions\MarkdownConverter;
use Hyde\Framework\Hyde;
use Illuminate\Http\Request;
use Hyde\Framework\Models\MarkdownPost;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\Storage;

class HydePostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'markdown' => 'required|string|max:8192',
        ]);
        
        $post = $this->parseMarkdown($request->markdown);
        
        $prefix = urlencode(Hyde::version());
        $id = $prefix . '-' . hash('sha256', $prefix . json_encode($post));

        $html = $this->renderMarkdown($post, $id);

        Storage::put('temp/posts/' .  $id, $html);

        return redirect()->route('hyde.post.render', ['post' => $id]);
    }

    /**
     * Render an HTML page.
     *
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function render(string $post)
    {
        $html = Storage::get('temp/posts/' . $post);

        if (!$html) {
            abort(404);
        }

        return response($html, 200)->header('Content-Type', 'text/html');
    }

    /**
     * Download a post.
     *
     * @param  string  $post
     * @return \Illuminate\Http\Response
     */
    public function download(string $post)
    {
        $html = Storage::get('temp/posts/' . $post);

        if (!$html) {
            abort(404);
        }

        // Send a download response
        return response($html, 200)->header('Content-Type', 'text/html')->header('Content-Disposition', 'attachment; filename="try-hyde-' . $post . '.html"');
    }

    /**
     * Parse the markdown into a MarkdownPost object
     *
     * @param  string  $markdown
     * @return MarkdownPost
     */
    protected function parseMarkdown(string $markdown)
    {
        $document = YamlFrontMatter::markdownCompatibleParse($markdown);

        // Parse the markdown into a MarkdownPost object
        $post = new MarkdownPost($document->matter(), $document->body());

        // Return the post
        return $post;
    }

    /**
     * Render the markdown into HTML
     *
     * @param  MarkdownPost  $post
     * @return string
     */
    protected function renderMarkdown(MarkdownPost $post, string $id)
    {
        return view('hyde::layouts/post')->with([
            'post' => $post,
            'title' => $post->title ?? 'My New Post',
            'markdown' => MarkdownConverter::parse($post->body),
            'currentPage' => 'posts/demo',
            'downloadLink' => route('hyde.post.download', ['post' => $id]),
        ])->render();
    }
}
