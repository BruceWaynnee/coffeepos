{{-- BEGIN:: Navbar --}}
<div class="pos-header">
    {{-- pos logo --}}
    <div class="logo-wrapper">
        <div class="logo-image-wrapper">
            <img src="{{ asset('img/dashboard/logo/coffee_logo.png') }}" alt="">
        </div>
    </div>
    {{-- place holder --}}
    <div class="place-holder-wrapper">

    </div>
    {{-- system options --}}
    <div class="system-options-wrapper">
        {{-- user --}}
        <div class="system-user-wrapper">
            <span>{{ ucwords( Auth::user()->username ) }}</span>
        </div>
        {{-- system close btn --}}
        <div class="system-close-btn-wrapper">
            <form id='logout-form' method="POST" action="{{ route('close-pos') }}">
                @csrf
                <button class="nav-link btn btn-sm btn-outline-danger mr-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > 
                    {{ __('Close System') }} 
                </button>
            </form>
        </div>
    </div>
</div>
{{-- END:: Navbar --}}
