<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p style="margin: 8px 0 0; font-size: 13px; color: rgba(251, 113, 133, 0.95);">
            {{ message }}
        </p>
    </div>
</template>
