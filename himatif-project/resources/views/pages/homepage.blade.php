<div>
    <div wire:poll="refreshComponent">
    @section('title' , 'Himatif-Project')
    {{-- hero --}}
    @include('components.folder.hero-section')

    {{-- tim --}}
    @include('components.folder.tim-section')

    {{-- departemen --}}
    @include('components.folder.departemen-section')

    {{-- count-number --}}
    @include('components.folder.count-number-section')

    {{-- event --}}
    @include('components.folder.event-section')
    </div>
</div>

