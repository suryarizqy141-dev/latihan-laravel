@php
    $toasts = [
        'success' => 'border-emerald-200 bg-white text-emerald-800',
        'error' => 'border-rose-200 bg-white text-rose-800',
        'warning' => 'border-amber-200 bg-white text-amber-800',
        'info' => 'border-indigo-200 bg-white text-indigo-800',
    ];
@endphp

@if (session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
    <div class="pointer-events-none fixed inset-x-0 bottom-0 z-[60] flex flex-col items-center gap-2 p-4 sm:items-end">
        @foreach ($toasts as $key => $classes)
            @if (session()->has($key))
                <div data-toast
                    class="animate-toast pointer-events-auto flex w-full max-w-sm items-start gap-3 rounded-2xl border p-4 shadow-lg shadow-slate-900/5 {{ $classes }}">
                    @switch($key)
                        @case('success')
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </span>
                        @break

                        @case('error')
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-rose-100">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </span>
                        @break

                        @case('warning')
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-amber-100">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                </svg>
                            </span>
                        @break

                        @default
                            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-100">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                </svg>
                            </span>
                    @endswitch

                    <p class="flex-1 pt-1 text-sm font-medium">{{ session($key) }}</p>

                    <button type="button" data-toast-close
                        class="rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                        <span class="sr-only">Tutup</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
        @endforeach
    </div>

    <script>
        document.querySelectorAll('[data-toast]').forEach((toast) => {
            const dismiss = () => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(0.5rem)';
                toast.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                setTimeout(() => toast.remove(), 200);
            };

            toast.querySelector('[data-toast-close]')?.addEventListener('click', dismiss);
            setTimeout(dismiss, 5000);
        });
    </script>
@endif
