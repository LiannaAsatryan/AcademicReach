<script setup>
const props = defineProps({
  emails: { type: Array, required: true }, // [{ id, contact_id, step, subject, body, status, sent_at, opened_at, replied_at, contact? }]
})

const emit = defineEmits(['select'])
</script>

<template>
  <table class="table">
    <thead>
      <tr>
        <th>Step</th>
        <th>To</th>
        <th>Subject</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="e in emails" :key="e.id" style="cursor:pointer;" @click="emit('select', e)">
        <td>{{ e.step }}</td>
        <td>{{ e.contact?.email ?? e.contact_id }}</td>
        <td>{{ e.subject }}</td>
        <td>{{ e.status }}</td>
      </tr>
      <tr v-if="emails.length === 0">
        <td colspan="4" style="color: rgba(255,255,255,0.68); padding: 18px;">
          No emails drafted yet. Compose step 1 emails for your contacts.
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style lang="scss" scoped></style>

