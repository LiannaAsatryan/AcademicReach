import { defineStore } from 'pinia'

export const useProspectStore = defineStore('prospects', {
  state: () => ({
    contactsByCampaignId: {},
    selectedContactId: null,
  }),
  actions: {
    setContacts(campaignId, contacts) {
      this.contactsByCampaignId[campaignId] = contacts ?? []
    },
    selectContact(id) {
      this.selectedContactId = id
    },
  },
})

