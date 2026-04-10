<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

defineProps({
  formats: { type: Array, required: true },
})

const form = useForm({
  format: 'guide',
  title: '',
  content: '',
})

const submit = () => form.post('/lead-magnets')
</script>

<template>
  <AppLayout>
    <div style="display:flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
      <h1 class="page-title" style="margin: 0;">Create Lead Magnet</h1>
      <Link class="btn" href="/lead-magnets">Back</Link>
    </div>

    <div class="card" style="margin-top: 18px; display:grid; gap: 12px;">
      <div style="display:grid; gap: 8px;">
        <label style="color: $color-muted;">Format</label>
        <select v-model="form.format" class="select">
          <option v-for="f in formats" :key="f" :value="f">{{ f }}</option>
        </select>
      </div>

      <div style="display:grid; gap: 8px;">
        <label style="color: $color-muted;">Title</label>
        <input v-model="form.title" class="input" placeholder="E.g., Department Chair Outreach Checklist" />
      </div>

      <div style="display:grid; gap: 8px;">
        <label style="color: $color-muted;">Content (draft)</label>
        <textarea v-model="form.content" class="textarea" rows="8" placeholder="Paste an outline or initial draft..."></textarea>
      </div>

      <div style="display:flex; gap: 10px;">
        <button class="btn primary" type="button" @click="submit" :disabled="form.processing">Save</button>
      </div>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>

