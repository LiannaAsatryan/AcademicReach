<script setup>
import { computed } from 'vue'

const props = defineProps({
  steps: { type: Array, required: true }, // [{ key, label }]
  activeKey: { type: String, required: true },
  doneKeys: { type: Array, default: () => [] },
})

const isDone = (key) => props.doneKeys.includes(key)
const isActive = (key) => props.activeKey === key

const normalized = computed(() =>
  props.steps.map((s) => ({
    key: s.key,
    label: s.label,
    state: isActive(s.key) ? 'active' : isDone(s.key) ? 'done' : 'todo',
  })),
)
</script>

<template>
  <div class="wizard-steps">
    <div
      v-for="s in normalized"
      :key="s.key"
      class="wizard-step"
      :class="{ active: s.state === 'active', done: s.state === 'done' }"
    >
      {{ s.label }}
    </div>
  </div>
</template>

<style lang="scss" scoped></style>

