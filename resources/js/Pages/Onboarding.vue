<script setup>
import { computed, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import StepWizard from '@/Components/StepWizard.vue'

const steps = [
  { key: 'profile', label: 'Profile' },
  { key: 'audience', label: 'Audience' },
  { key: 'offer', label: 'Offer' },
  { key: 'tone', label: 'Tone' },
]

const activeKey = ref('profile')
const doneKeys = ref([])

const props = defineProps({
  initial: { type: Object, default: () => ({}) },
})

const form = useForm({
  niche: props.initial.niche ?? '',
  goal: props.initial.goal ?? '',
  target_audience: props.initial.target_audience ?? '',
  offer: props.initial.offer ?? '',
  tone: props.initial.tone ?? 'friendly',
})

const stepIndex = computed(() => steps.findIndex((s) => s.key === activeKey.value))

const next = () => {
  const idx = stepIndex.value
  if (idx < steps.length - 1) {
    doneKeys.value = Array.from(new Set([...doneKeys.value, activeKey.value]))
    activeKey.value = steps[idx + 1].key
  }
}

const back = () => {
  const idx = stepIndex.value
  if (idx > 0) activeKey.value = steps[idx - 1].key
}

const submit = () => {
  form.post('/onboarding')
}
</script>

<template>
  <AppLayout>
    <h1 class="page-title">Onboarding</h1>

    <div class="wizard card">
      <StepWizard :steps="steps" :active-key="activeKey" :done-keys="doneKeys" />

      <div v-if="activeKey === 'profile'" style="display:grid; gap: 12px;">
        <div style="font-weight: 700;">Your niche and goal</div>
        <div style="display:grid; gap: 10px;">
          <input v-model="form.niche" class="input" placeholder="Niche (e.g., STEM enrichment, admissions, pedagogy)" />
          <input v-model="form.goal" class="input" placeholder="Goal (e.g., grow newsletter, book calls, share research)" />
        </div>
      </div>

      <div v-else-if="activeKey === 'audience'" style="display:grid; gap: 12px;">
        <div style="font-weight: 700;">Target audience</div>
        <input v-model="form.target_audience" class="input" placeholder="Who should this reach? (e.g., department chairs)" />
      </div>

      <div v-else-if="activeKey === 'offer'" style="display:grid; gap: 12px;">
        <div style="font-weight: 700;">Your offer</div>
        <textarea v-model="form.offer" class="textarea" rows="5" placeholder="What are you offering? (lead magnet, consultation, resource)"></textarea>
      </div>

      <div v-else style="display:grid; gap: 12px;">
        <div style="font-weight: 700;">Preferred tone</div>
        <select v-model="form.tone" class="select">
          <option value="formal">Formal</option>
          <option value="friendly">Friendly</option>
          <option value="academic">Academic</option>
        </select>
      </div>

      <div style="display:flex; gap: 10px; justify-content: space-between; flex-wrap: wrap;">
        <button class="btn" type="button" @click="back" :disabled="stepIndex === 0">Back</button>
        <div style="display:flex; gap: 10px;">
          <button v-if="stepIndex < steps.length - 1" class="btn primary" type="button" @click="next">Next</button>
          <button v-else class="btn primary" type="button" @click="submit" :disabled="form.processing">Finish</button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>

