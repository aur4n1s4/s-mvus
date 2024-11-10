<div>
    @foreach ($antrianPolis as $key => $poli)
        <div class="p-5 lighten-3 {{ $key % 2 ? 'light' : '' }}">
            <h5 class="font-weight-normal s-14"> {{ strtoupper($poli->nama) }}</h5>
            <span class="s-48 font-weight-normal text-{{ $poli->color }}">
                {{ sprintf('%03s', $poli->antrian) . '/' . sprintf('%03s', $poli->total) }}
            </span>
        </div>
    @endforeach
</div>
