@if($errors->any())
    <div class="pb-5">
        <x-message type="error" :messages="$errors->all()"></x-message>
    </div>
@endif
@if (session('success'))
    <div class="pb-5">
        <x-message type="success" :messages="session('success')"></x-message>
    </div>
@endif
