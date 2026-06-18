@if(session('success'))
<div class="fixed bottom-6 right-6 z-50 glass-card p-6 rounded shadow-xl flex items-center gap-4 border border-brand-beige/30 bg-background/90" id="successToast">
    <div class="w-10 h-10 rounded-full bg-emerald-800 flex items-center justify-center text-white">
        <span class="material-symbols-outlined fill text-white">check_circle</span>
    </div>
    <div>
        <h4 class="font-headline-md text-[16px] text-white">Berhasil!</h4>
        <p class="text-on-surface-variant text-[13px]">{{ session('success') }}</p>
    </div>
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('successToast');
        if(toast) {
            toast.style.transition = 'opacity 0.5s';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 500);
        }
    }, 4000);
</script>
@endif

@if ($errors->any())
<div class="fixed bottom-6 right-6 z-50 glass-card p-6 rounded shadow-xl flex items-center gap-4 border border-error-container/30 bg-background/90" id="errorToast">
    <div class="w-10 h-10 rounded-full bg-error-container flex items-center justify-center text-white">
        <span class="material-symbols-outlined fill text-white">error</span>
    </div>
    <div>
        <h4 class="font-headline-md text-[16px] text-error font-bold">Gagal!</h4>
        @foreach ($errors->all() as $error)
            <p class="text-on-surface-variant text-[13px]">{{ $error }}</p>
        @endforeach
    </div>
</div>
<script>
    setTimeout(() => {
        const toast = document.getElementById('errorToast');
        if(toast) {
            toast.style.transition = 'opacity 0.5s';
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 500);
        }
    }, 5000);
</script>
@endif
