<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div style="margin-bottom: 12px;">
            <div style="font-size: 20px; font-weight: 900; letter-spacing: -0.02em;">Log in</div>
            <div style="margin-top: 6px; color: rgba(255,255,255,0.68); font-size: 14px;">
                Continue building your lead magnets and outreach campaigns.
            </div>
        </div>

        <div v-if="status" style="margin-bottom: 12px; font-size: 13px; color: rgba(110, 231, 255, 0.95);">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div style="display:grid; gap: 8px;">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div style="display:grid; gap: 8px; margin-top: 12px;">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div style="margin-top: 12px;">
                <label style="display:flex; align-items:center; gap: 10px;">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span style="font-size: 13px; color: rgba(255,255,255,0.68);">Remember me</span>
                </label>
            </div>

            <div style="margin-top: 16px; display:flex; align-items:center; justify-content: space-between; gap: 10px; flex-wrap: wrap;">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    style="font-size: 13px; color: rgba(255,255,255,0.68);"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>

            <div style="margin-top: 14px; font-size: 13px; color: rgba(255,255,255,0.68);">
                New here?
                <Link :href="route('register')" style="color: rgba(110,231,255,0.95); text-decoration: none;">
                    Create an account
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
