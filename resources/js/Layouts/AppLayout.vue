<script setup>
import Sidebar from '@/Components/Sidebar.vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = page.props.auth?.user
</script>

<template>
  <div class="app-shell">
    <aside class="sidebar">
      <Sidebar />
    </aside>

    <section>
      <header class="topbar">
        <div style="display:flex; align-items:center; justify-content: space-between; width: 100%; gap: 12px; flex-wrap: wrap;">
          <div style="font-weight: 900; letter-spacing: -0.02em;">AcademicReach</div>

          <div style="display:flex; align-items:center; gap: 12px; flex-wrap: wrap;">
            <div v-if="user" style="text-align:right;">
              <div style="font-weight: 800; font-size: 14px; line-height: 1.2;">{{ user.name }}</div>
              <div style="color: rgba(255,255,255,0.68); font-size: 13px; line-height: 1.2;">
                {{ user.email }}
              </div>
            </div>

            <Link v-if="user" class="btn" :href="route('logout')" method="post" as="button" type="button">
              Logout
            </Link>
            <div v-else style="color: rgba(255,255,255,0.68); font-size: 14px;">AI outreach workspace</div>
          </div>
        </div>
      </header>

      <main class="page">
        <slot />
      </main>
    </section>
  </div>
</template>

<style lang="scss" scoped>
.topbar {
  // uses shared styles from _layout.scss; keep scoped hooks minimal
}
</style>

