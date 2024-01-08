<div
    class="grid grid-cols-1 p-8 gap-2 @switch($datas->count())
    @case($datas->count() >= 4)
        md:grid-cols-4
        @break

    @case($datas->count() == 3)
        md:grid-cols-3
        @break

    @case($datas->count() == 2)
        md:grid-cols-2
        @break

    @default
        md:grid-cols-1
        md:place-items-center
@endswitch">
    @foreach ($datas as $data)
        <div wire:key="{{ $data->id }}"
            class="shadow-md border-2 px-6 py-4 flex items-center justify-between max-w-[458px]">
            <div>
                <h1>{{ $data->name }}</h1>
                <p class="uppercase">{{ $data->seat->seat . ' / ' . $data->seat->class }}</p>
            </div>
            <i class="fa-regular fa-eye"></i>
        </div>
    @endforeach
</div>
