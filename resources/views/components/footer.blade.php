@section('footer')

<div class="text-center">
    {{-- Pega o Nome Do sistema no .env --}}
    {{ '@ copyrigth' }} {{ date('Y') }} - {{ config('app.name') }}
</div>

@endsection