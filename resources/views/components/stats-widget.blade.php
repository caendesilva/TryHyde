<dl>
    @foreach ($stats as $stat)
    <div>
        <dt class="d-inline">{{ Str::title(str_replace('_', ' ', $stat->event)) }}:</dt>
        <dd class="d-inline">{{ number_format($stat->value) }}</dd>
    </div>
    @endforeach
</dl>