<script setup>
import {computed} from 'vue';
import {Head, useForm} from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    if (!isFormValid.value) return;

    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const isFormValid = computed(() => {
    return form.email.trim() !== '' && form.password.trim() !== '';
});

const rules = {
    required: value => !!value || 'This field is required',
    email: value => {
        if (!value) return 'This field is required';
        if (!/.+@.+\..+/.test(value)) return 'Invalid email';
        return true;
    },
}

</script>

<template>
    <Head title="Log in"/>
    <v-app>
        <v-main>
            <v-container class="fill-height justify-center">
                <v-row style="max-width: 450px">
                    <v-card class="pa-0 pa-sm-10 w-100" elevation="3">
                        <v-img
                            src="/images/logo.svg"
                            max-height="100"
                            contain
                            height="100"
                        />
                        <v-card-title class="mb-5">
                            <h1 class="text-center text-h3 mb-1">Sign in</h1>
                            <p class="text-center text-body-1 text-wrap">Please sign in to your account.</p>
                        </v-card-title>
                        <v-card-text>
                            <v-form @submit.prevent="submit" class="text-right">
                                <v-text-field
                                    v-model="form.email"
                                    label="Email"
                                    type="email"
                                    variant="outlined"
                                    color="primary"
                                    :rules="[rules.required, rules.email]"
                                    class="mb-2"
                                />
                                <v-text-field
                                    v-model="form.password"
                                    label="Password"
                                    type="password"
                                    variant="outlined"
                                    color="primary"
                                    :rules="[rules.required]"
                                    class="mb-2"
                                />
                                <v-btn
                                    type="submit"
                                    color="primary"
                                    :loading="form.processing"
                                    class="w-100"
                                >
                                    Log in
                                </v-btn>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>
<style>
.v-input__details {
    text-align: left;
}
</style>
