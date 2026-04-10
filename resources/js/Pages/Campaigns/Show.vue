<script setup>
import { computed, ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import ProspectTable from '@/Components/ProspectTable.vue'
import EmailTable from '@/Components/EmailTable.vue'
import { useForm, Link, router } from '@inertiajs/vue3'

const props = defineProps({
  campaign: { type: Object, required: true },
  contacts: { type: Array, required: true },
  emails: { type: Array, required: true },
})

const selectedEmail = ref(null)

const contactForm = useForm({
  name: '',
  title: '',
  institution: '',
  email: '',
  linkedin_url: '',
})

const addContact = () => {
  contactForm.post(`/campaigns/${props.campaign.id}/contacts`, {
    onSuccess: () => contactForm.reset(),
  })
}

const sendForm = useForm({
  email_id: null,
})

const canSend = computed(() => !!sendForm.email_id)

const sendSelected = () => {
  if (!sendForm.email_id) return
  sendForm.post(`/campaigns/${props.campaign.id}/send`)
}

const deleteContact = (id) => router.delete(`/contacts/${id}`)
</script>

<template>
  <AppLayout>
    <div style="display:flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
      <h1 class="page-title" style="margin: 0;">{{ campaign.name }}</h1>
      <Link class="btn" href="/campaigns">Back</Link>
    </div>

    <div class="card" style="margin-top: 18px; display:grid; gap: 12px;">
      <div style="display:flex; gap: 12px; flex-wrap: wrap; color: rgba(255,255,255,0.68);">
        <div><strong style="color: $color-text;">Status:</strong> {{ campaign.status }}</div>
        <div><strong style="color: $color-text;">Lead magnet:</strong> {{ campaign.lead_magnet?.title ?? campaign.leadMagnet?.title ?? '—' }}</div>
      </div>
    </div>

    <div style="display:grid; gap: 18px; margin-top: 18px;">
      <div class="card" style="display:grid; gap: 12px;">
        <div style="display:flex; align-items:center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
          <div style="font-weight: 800;">Prospects</div>
          <div style="color: rgba(255,255,255,0.68); font-size: 13px;">Add contacts manually (finder job later)</div>
        </div>

        <div style="display:grid; gap: 10px;">
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <input v-model="contactForm.name" class="input" placeholder="Name" />
            <input v-model="contactForm.title" class="input" placeholder="Title" />
          </div>
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <input v-model="contactForm.institution" class="input" placeholder="Institution" />
            <input v-model="contactForm.email" class="input" placeholder="Email" />
          </div>
          <input v-model="contactForm.linkedin_url" class="input" placeholder="LinkedIn URL (optional)" />
          <div style="display:flex; gap: 10px;">
            <button class="btn primary" type="button" @click="addContact" :disabled="contactForm.processing">Add contact</button>
          </div>
        </div>

        <ProspectTable :contacts="contacts" />

        <div v-if="contacts.length > 0" style="display:flex; gap: 10px; flex-wrap: wrap;">
          <button class="btn danger" type="button" @click="deleteContact(contacts[contacts.length - 1].id)">
            Delete last contact (demo)
          </button>
        </div>
      </div>

      <div class="card" style="display:grid; gap: 12px;">
        <div style="display:flex; align-items:center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
          <div style="font-weight: 800;">Email review</div>
          <div style="color: rgba(255,255,255,0.68); font-size: 13px;">
            Drafts are created by jobs (compose job stub included)
          </div>
        </div>

        <EmailTable :emails="emails" @select="(e) => (selectedEmail = e)" />

        <div style="display:grid; gap: 10px;">
          <div style="display:flex; gap: 10px; flex-wrap: wrap; align-items:center;">
            <select v-model="sendForm.email_id" class="select" style="max-width: 420px;">
              <option :value="null">Select an email to send…</option>
              <option v-for="e in emails" :key="e.id" :value="e.id">
                Step {{ e.step }} — {{ e.subject }}
              </option>
            </select>
            <button class="btn primary" type="button" @click="sendSelected" :disabled="sendForm.processing || !canSend">
              Send selected
            </button>
          </div>

          <div v-if="selectedEmail" style="border-top: 1px solid $color-border; padding-top: 12px;">
            <div style="font-weight: 700;">Preview</div>
            <div style="color: rgba(255,255,255,0.68); margin-top: 4px;">Subject: {{ selectedEmail.subject }}</div>
            <pre style="white-space: pre-wrap; margin: 10px 0 0; line-height: 1.5;">{{ selectedEmail.body }}</pre>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style lang="scss" scoped></style>

