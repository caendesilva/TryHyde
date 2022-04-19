<?php

namespace App\Http\Controllers;

use App\Models\Stats;
use Hyde\Framework\Actions\MarkdownConverter;
use Hyde\Framework\Hyde;
use Illuminate\Http\Request;
use Hyde\Framework\Models\MarkdownPost;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

        Stats::dispatch('pages_generated', 1);

        Stats::dispatch('lines_of_markdown_converted', substr_count( $request->markdown, "\n" ));
        Stats::dispatch('lines_of_html_generated', substr_count( $html, "\n" ));

        return $this->download($html, $id);
    }

    /**
     * Download a post.
     *
     * @param  string  $post
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function download(string $html, string $id)
    {
        Stats::dispatch('pages_downloaded', 1);

        return response($html, 200)->header('Content-Type', 'text/html')->header('Content-Disposition', 'attachment; filename="try-hyde-' . $id . '.html"');
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
        ])->render();
    }
}
