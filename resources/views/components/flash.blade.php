@if (session()->has('success'))
<!-- <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
    <p>{{ session('success') }}</p>
</div> -->

<div class="py-2 px-4 alert-dismissible alert-success fixed bottom-3 right-3">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <p>{{ session('success') }}</p>
</div>
@endif