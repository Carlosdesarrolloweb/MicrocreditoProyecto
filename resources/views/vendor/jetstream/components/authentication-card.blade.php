
{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white-100">
    <div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
    <img src="{{URL::asset('https://files.fm/thumb_show.php?i=rh59me2xy')}}">
        {{ $slot }}
    </div>
</div> --}}
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white-100">
    <div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <img src="{{ asset('logomicrocreditosmary.png') }}" alt="Logo Microcréditos Mary">
        {{ $slot }}
    </div>
</div>
