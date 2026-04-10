<script setup>
const props = defineProps({
  contacts: { type: Array, required: true }, // [{ id, name, title, institution, email, linkedin_url, email_verified }]
})
</script>

<template>
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Title</th>
        <th>Institution</th>
        <th>Email</th>
        <th>Verified</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="c in contacts" :key="c.id">
        <td>{{ c.name }}</td>
        <td>{{ c.title }}</td>
        <td>{{ c.institution }}</td>
        <td>
          <div style="display:flex; gap:10px; align-items:center; flex-wrap: wrap;">
            <span>{{ c.email }}</span>
            <a v-if="c.linkedin_url" :href="c.linkedin_url" target="_blank" rel="noreferrer" style="color: $color-primary;">
              LinkedIn
            </a>
          </div>
        </td>
        <td>{{ c.email_verified ? 'Yes' : 'No' }}</td>
      </tr>
      <tr v-if="contacts.length === 0">
        <td colspan="5" style="color: rgba(255,255,255,0.68); padding: 18px;">
          No prospects yet. Add contacts or run prospect finding.
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style lang="scss" scoped></style>

