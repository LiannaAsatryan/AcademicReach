<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
const currentUrl = computed(() => page.url)

const isActive = (href) => currentUrl.value === href || currentUrl.value.startsWith(href + '/')
</script>

<template>
  <div style="display: grid; gap: 18px;">
    <div>
      <div style="font-weight: 900; font-size: 18px;">AcademicReach</div>
      <div style="color: rgba(255,255,255,0.68); font-size: 13px; margin-top: 4px;">
        Lead magnets • prospects • sequences
      </div>
    </div>

    <nav style="display: grid; gap: 8px;">
      <Link class="nav-link" :class="{ active: isActive('/dashboard') }" href="/dashboard">Dashboard</Link>
      <Link class="nav-link" :class="{ active: isActive('/lead-magnets') }" href="/lead-magnets">Lead Magnets</Link>
      <Link class="nav-link" :class="{ active: isActive('/campaigns') }" href="/campaigns">Campaigns</Link>
      <Link class="nav-link" :class="{ active: isActive('/onboarding') }" href="/onboarding">Onboarding</Link>
    </nav>
  </div>
</template>

<style lang="scss" scoped>
</style>

