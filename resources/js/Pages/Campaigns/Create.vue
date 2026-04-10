<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

defineProps({
  leadMagnets: { type: Array, required: true },
})

const form = useForm({
  name: '',
  lead_magnet_id: null,
})

const submit = () => form.post('/campaigns')
</script>

<template>
  <AppLayout>
    <div style="display:flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
      <h1 class="page-title" style="margin: 0;">Create Campaign</h1>
      <Link class="btn" href="/campaigns">Back</Link>
    </div>

    <div class="card" style="margin-top: 18px; display:grid; gap: 12px;">
      <div style="display:grid; gap: 8px;">
        <label style="color: $color-muted;">Name</label>
        <input v-model="form.name" class="input" placeholder="E.g., Dept Chairs — Spring Outreach" />
      </div>

      <div style="display:grid; gap: 8px;">
        <label style="color: $color-muted;">Lead magnet (optional)</label>
        <select v-model="form.lead_magnet_id" class="select">
          <option :value="null">—</option>
          <option v-for="m in leadMagnets" :key="m.id" :value="m.id">{{ m.title }}</option>
        </select>
      </div>

      <div style="display:flex; gap: 10px;">
        <button class="btn primary" type="button" @click="submit" :disabled="form.processing">Save</button>
      </div>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>

