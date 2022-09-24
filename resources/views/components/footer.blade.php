@section('footer')

<div class="text-center">
    {{-- Pega o Nome Do sistema no .env --}}
    {{ '@ copyright' }} {{ date('Y') }} - {{ config('app.name') }}
</div>

@endsection