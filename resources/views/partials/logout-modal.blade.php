<!-- Modal Konfirmasi Logout Global SIPERFAS (Semua Role) -->
<div id="logoutConfirmationModal" class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4 transition-opacity duration-200" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle">
    <!-- Backdrop dismiss overlay -->
    <div class="fixed inset-0" onclick="closeLogoutModal()"></div>

    <!-- Modal Card -->
    <div id="logoutModalContent" class="relative bg-white rounded-3xl shadow-2xl border border-slate-100 p-6 sm:p-7 max-w-sm w-full mx-auto transform transition-all duration-200 scale-95 opacity-0 z-10 text-center">
        <!-- Icon Warning / Logout -->
        <div class="w-14 h-14 mx-auto rounded-2xl bg-red-50 border border-red-100 text-red-600 flex items-center justify-center mb-4 shadow-sm shadow-red-100">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
        </div>

        <!-- Title & Description -->
        <h3 id="logoutModalTitle" class="text-lg font-extrabold text-slate-800 tracking-tight mb-2">
            Konfirmasi Keluar
        </h3>
        <p class="text-xs text-slate-500 leading-relaxed mb-6">
            Apakah Anda yakin ingin keluar dari sistem <strong class="text-slate-700">SIPERFAS</strong>? Anda harus login kembali untuk mengakses akun Anda.
        </p>

        <!-- Action Buttons -->
        <div class="grid grid-cols-2 gap-3">
            <button type="button" onclick="closeLogoutModal()" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 font-semibold text-xs transition-colors cursor-pointer">
                Batal
            </button>
            <button type="button" id="confirmLogoutButton" onclick="submitActiveLogoutForm()" class="w-full px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md shadow-red-600/20 transition-all flex items-center justify-center space-x-1.5 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Ya, Keluar</span>
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    let pendingLogoutForm = null;

    window.openLogoutModal = function(form) {
        pendingLogoutForm = form;
        const modal = document.getElementById('logoutConfirmationModal');
        const content = document.getElementById('logoutModalContent');
        if (!modal || !content) {
            if (form) form.submit();
            return;
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    };

    window.closeLogoutModal = function() {
        const modal = document.getElementById('logoutConfirmationModal');
        const content = document.getElementById('logoutModalContent');
        if (!modal || !content) return;

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            pendingLogoutForm = null;
        }, 180);
    };

    window.submitActiveLogoutForm = function() {
        const btn = document.getElementById('confirmLogoutButton');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';
        }

        if (pendingLogoutForm) {
            pendingLogoutForm.submit();
        } else {
            const fallbackForm = document.querySelector('form[action*="logout"]');
            if (fallbackForm) {
                fallbackForm.submit();
            } else {
                window.location.href = "{{ route('logout') }}";
            }
        }
    };

    // Keyboard ESC to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('logoutConfirmationModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeLogoutModal();
            }
        }
    });

    // Auto-intercept any form with action containing 'logout'
    function bindLogoutForms() {
        document.querySelectorAll('form[action*="logout"]').forEach(function(form) {
            form.removeAttribute('onsubmit');
            if (!form.dataset.logoutBound) {
                form.dataset.logoutBound = "true";
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    window.openLogoutModal(form);
                });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindLogoutForms);
    } else {
        bindLogoutForms();
    }
})();
</script>
