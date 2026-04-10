<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label style="display:block; font-weight: 700; color: rgba(255,255,255,0.68); font-size: 13px;">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
