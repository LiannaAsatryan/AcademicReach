<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="guest">
        <div class="guest-inner">
            <div style="display:flex; justify-content: center;">
                <Link href="/dashboard" style="display:flex; gap: 12px; align-items:center; text-decoration:none;">
                    <div style="width: 40px; height: 40px; color: rgba(255,255,255,0.98);">
                        <ApplicationLogo />
                    </div>
                    <div class="brand-title">AcademicReach</div>
                </Link>
            </div>

            <div class="card" style="max-width: 440px; width: 100%;">
                <slot />
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.guest {
    min-height: 100vh;
    display: grid;
    place-items: center;
    padding: 32px 16px;
    background: radial-gradient(1200px 700px at 20% 0%, rgba(110, 231, 255, 0.12), transparent 60%),
        radial-gradient(900px 600px at 80% 20%, rgba(167, 139, 250, 0.14), transparent 55%), $color-bg;
}

.guest-inner {
    width: 100%;
    display: grid;
    gap: 18px;
    justify-items: center;
}

.brand-title {
    font-weight: 950;
    letter-spacing: -0.03em;
    font-size: 22px;
    color: $color-text-strong;
    text-shadow: 0 2px 18px rgba(110, 231, 255, 0.18);
}
</style>
