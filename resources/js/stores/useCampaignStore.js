import { defineStore } from 'pinia'

export const useCampaignStore = defineStore('campaigns', {
  state: () => ({
    campaigns: [],
    activeCampaignId: null,
  }),
  getters: {
    activeCampaign(state) {
      return state.campaigns.find((c) => c.id === state.activeCampaignId) ?? null
    },
  },
  actions: {
    setCampaigns(campaigns) {
      this.campaigns = campaigns ?? []
    },
    setActiveCampaign(id) {
      this.activeCampaignId = id
    },
  },
})

