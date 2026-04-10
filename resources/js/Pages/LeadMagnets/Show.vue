<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  magnet: { type: Object, required: true },
})

const destroy = () => {
  router.delete(`/lead-magnets/${props.magnet.id}`)
}
</script>

<template>
  <AppLayout>
    <div style="display:flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
      <h1 class="page-title" style="margin: 0;">{{ magnet.title }}</h1>
      <div style="display:flex; gap: 10px; flex-wrap: wrap;">
        <Link class="btn" href="/lead-magnets">Back</Link>
        <button class="btn danger" type="button" @click="destroy">Delete</button>
      </div>
    </div>

    <div class="card" style="margin-top: 18px; display:grid; gap: 12px;">
      <div style="display:flex; gap: 12px; flex-wrap: wrap; color: rgba(255,255,255,0.68);">
        <div><strong style="color: $color-text;">Format:</strong> {{ magnet.format }}</div>
        <div><strong style="color: $color-text;">Status:</strong> {{ magnet.status }}</div>
        <div><strong style="color: $color-text;">Hosted slug:</strong> {{ magnet.hosted_slug }}</div>
      </div>

      <div>
        <div style="color: $color-muted; margin-bottom: 8px;">Content</div>
        <pre style="white-space: pre-wrap; margin:0; line-height: 1.5; color: rgba(255,255,255,0.9);">{{ magnet.content }}</pre>
      </div>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>

