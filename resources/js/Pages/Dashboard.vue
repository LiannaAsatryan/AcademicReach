<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
const user = page.props.auth?.user
</script>

<template>
  <AppLayout>
    <h1 class="page-title">Dashboard</h1>

    <div class="card" style="display: grid; gap: 10px;">
      <div style="font-weight: 900; font-size: 18px;">
        You're logged in<span v-if="user"> as {{ user.name }}</span>.
      </div>
      <div style="color: rgba(255,255,255,0.68);">
        Next steps: finish onboarding, generate a lead magnet, then create a campaign.
      </div>
      <div style="display:flex; gap: 10px; flex-wrap: wrap;">
        <a class="btn primary" href="/onboarding">Onboarding</a>
        <a class="btn" href="/lead-magnets">Lead magnets</a>
        <a class="btn" href="/campaigns">Campaigns</a>
      </div>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>
