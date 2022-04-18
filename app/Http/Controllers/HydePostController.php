<?php

namespace App\Http\Controllers;

use Hyde\Framework\Actions\MarkdownConverter;
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
            'markdown' => 'required|string|max:4096',
        ]);
        
        $post = $this->parseMarkdown($request->markdown);
        $html = $this->renderMarkdown($post);

        $id = hash('sha256', json_encode($post));

        Storage::put('temp/posts/' . $id, $html);

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
    protected function renderMarkdown(MarkdownPost $post)
    {
        return view('hyde::layouts/post')->with([
            'post' => $post,
            'title' => $post->title ?? 'My New Post',
            'markdown' => MarkdownConverter::parse($post->body),
            'currentPage' => 'posts/demo',
        ])->render();
    }
}
