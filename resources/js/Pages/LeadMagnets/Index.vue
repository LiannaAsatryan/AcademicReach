<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  magnets: { type: Array, required: true },
})
</script>

<template>
  <AppLayout>
    <div style="display:flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
      <h1 class="page-title" style="margin: 0;">Lead Magnets</h1>
      <Link class="btn primary" href="/lead-magnets/create">Create</Link>
    </div>

    <div class="card" style="margin-top: 18px;">
      <table class="table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Format</th>
            <th>Status</th>
            <th>Hosted slug</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="m in magnets" :key="m.id">
            <td><Link :href="`/lead-magnets/${m.id}`" style="color: $color-primary;">{{ m.title }}</Link></td>
            <td>{{ m.format }}</td>
            <td>{{ m.status }}</td>
            <td>{{ m.hosted_slug }}</td>
          </tr>
          <tr v-if="magnets.length === 0">
            <td colspan="4" style="color: rgba(255,255,255,0.68); padding: 18px;">
              No lead magnets yet.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>

