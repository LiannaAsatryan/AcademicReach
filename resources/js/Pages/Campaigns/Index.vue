<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  campaigns: { type: Array, required: true },
})
</script>

<template>
  <AppLayout>
    <div style="display:flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
      <h1 class="page-title" style="margin: 0;">Campaigns</h1>
      <Link class="btn primary" href="/campaigns/create">Create</Link>
    </div>

    <div class="card" style="margin-top: 18px;">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Lead magnet</th>
            <th>Scheduled</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="c in campaigns" :key="c.id">
            <td><Link :href="`/campaigns/${c.id}`" style="color: $color-primary;">{{ c.name }}</Link></td>
            <td>{{ c.status }}</td>
            <td>{{ c.lead_magnet?.title ?? c.leadMagnet?.title ?? '—' }}</td>
            <td>{{ c.scheduled_at ?? '—' }}</td>
          </tr>
          <tr v-if="campaigns.length === 0">
            <td colspan="4" style="color: rgba(255,255,255,0.68); padding: 18px;">
              No campaigns yet.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>

