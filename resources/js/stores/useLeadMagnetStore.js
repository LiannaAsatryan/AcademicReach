import { defineStore } from 'pinia'

export const useLeadMagnetStore = defineStore('leadMagnets', {
  state: () => ({
    magnets: [],
    activeMagnetId: null,
  }),
  getters: {
    activeMagnet(state) {
      return state.magnets.find((m) => m.id === state.activeMagnetId) ?? null
    },
  },
  actions: {
    setMagnets(magnets) {
      this.magnets = magnets ?? []
    },
    setActiveMagnet(id) {
      this.activeMagnetId = id
    },
  },
})

