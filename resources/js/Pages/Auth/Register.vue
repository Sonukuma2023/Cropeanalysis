<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gray-50 py-12">
        <!-- Background -->
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1586771107445-d3ca888129ff?q=80&w=2940&auto=format&fit=crop')] bg-cover bg-center">
            <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm"></div>
        </div>

        <div class="relative z-10 w-full max-w-md px-6">
            <div class="bg-white/95 backdrop-blur-xl p-8 rounded-3xl shadow-2xl border border-white/20">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-700 rounded-2xl shadow-lg mb-4 transform transition hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create Account</h2>
                    <p class="text-sm text-gray-500 mt-2">Join CropAI and protect your farm today</p>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name</label>
                        <input id="name" type="text" v-model="form.name" required autofocus autocomplete="name" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all bg-gray-50 hover:bg-white" 
                            placeholder="John Doe" />
                        <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                        <input id="email" type="email" v-model="form.email" required autocomplete="username" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all bg-gray-50 hover:bg-white" 
                            placeholder="you@example.com" />
                        <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <input id="password" type="password" v-model="form.password" required autocomplete="new-password" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all bg-gray-50 hover:bg-white" 
                            placeholder="••••••••" />
                        <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password</label>
                        <input id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all bg-gray-50 hover:bg-white" 
                            placeholder="••••••••" />
                        <p v-if="form.errors.password_confirmation" class="mt-2 text-sm text-red-600">{{ form.errors.password_confirmation }}</p>
                    </div>

                    <button type="submit" :disabled="form.processing" 
                        class="w-full py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-500 hover:to-emerald-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition hover:-translate-y-1 hover:shadow-lg hover:shadow-green-500/30 disabled:opacity-70 disabled:cursor-not-allowed mt-2">
                        Create Account
                    </button>

                    <p class="text-center text-sm text-gray-600 pt-4">
                        Already have an account? 
                        <Link :href="route('login')" class="font-bold text-green-600 hover:text-green-500 transition-colors">Sign in</Link>
                    </p>
                </form>
            </div>
            
            <div class="text-center mt-6">
                <Link href="/" class="text-sm text-white/70 hover:text-white transition-colors flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Homepage
                </Link>
            </div>
        </div>
    </div>
</template>
