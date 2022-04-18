<dl>
    @foreach ($stats as $stat)
        <dt>{{ Str::title(str_replace('_', ' ', $stat->event)) }}</dt>
        <dd>{{ $stat->value }}</dd>
    @endforeach
</dl>