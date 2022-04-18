<dl class="d-flex">
    @foreach ($stats as $stat)
        <dt>{{ Str::title(str_replace('_', ' ', $stat->event)) }}:</dt>
        <dd class="ms-1 me-3">{{ number_format($stat->value) }}</dd>
    @endforeach
</dl>