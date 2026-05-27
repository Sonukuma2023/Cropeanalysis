<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    
    <div class="antialiased bg-gray-50 text-gray-900 selection:bg-green-500 selection:text-white">
        <!-- Navbar -->
        <nav class="fixed w-full z-50 transition-all duration-300" style="background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-bottom: 1px solid rgba(0, 0, 0, 0.05);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer transform transition hover:scale-105">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-700 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <span class="font-extrabold text-2xl tracking-tight text-gray-900">Crop<span class="text-green-600">AI</span></span>
                    </div>

                    <!-- Auth Links -->
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <template v-if="canLogin">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm font-semibold text-gray-700 hover:text-green-600 transition px-3 py-2">
                                Dashboard
                            </Link>

                            <template v-else>
                                <Link :href="route('login')" class="text-sm font-semibold text-gray-700 hover:text-green-600 transition px-3 py-2">
                                    Log in
                                </Link>

                                <Link v-if="canRegister" :href="route('register')" class="text-sm font-semibold text-white bg-gray-900 hover:bg-green-600 transition-colors px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    Register Now
                                </Link>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center justify-center pt-20" style="background-image: url('https://images.unsplash.com/photo-1592982537447-6f296d054792?q=80&w=2940&auto=format&fit=crop'); background-size: cover; background-position: center; background-attachment: fixed;">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/70 via-gray-900/50 to-gray-900/90"></div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <span class="inline-block py-1.5 px-4 rounded-full bg-green-500/20 border border-green-500/30 text-green-300 font-bold text-sm tracking-widest uppercase mb-8 backdrop-blur-sm shadow-inner">Next-Gen Agriculture</span>
                
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight mb-8 leading-tight">
                    Smart Disease Detection <br/> 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-emerald-300 to-teal-200">For Healthier Crops</span>
                </h1>
                
                <p class="mt-4 text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto mb-12 font-light leading-relaxed">
                    Upload a photo of your crop leaf and instantly identify diseases, receive targeted pesticide recommendations, and learn prevention strategies.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <template v-if="canLogin">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="w-full sm:w-auto px-10 py-4 text-lg font-bold rounded-full text-white bg-green-600 hover:bg-green-500 shadow-[0_0_30px_rgba(34,197,94,0.4)] transition-all transform hover:-translate-y-1">
                            Go to Dashboard
                        </Link>
                        <template v-else>
                            <Link v-if="canRegister" :href="route('register')" class="w-full sm:w-auto px-10 py-4 text-lg font-bold rounded-full text-gray-900 bg-white hover:bg-gray-100 shadow-[0_0_30px_rgba(255,255,255,0.2)] transition-all transform hover:-translate-y-1">
                                Get Started for Free
                            </Link>
                            <Link :href="route('login')" class="w-full sm:w-auto px-10 py-4 text-lg font-bold rounded-full text-white border-2 border-white/30 hover:border-white hover:bg-white/10 transition-all backdrop-blur-sm">
                                Sign In
                            </Link>
                        </template>
                    </template>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-24 bg-white relative">
            <div class="absolute inset-0 bg-green-50/30"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-20">
                    <h2 class="text-4xl font-extrabold text-gray-900 tracking-tight">How It Works</h2>
                    <p class="mt-4 text-xl text-gray-500 font-light">Three simple steps to secure your farm's future.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="text-center group bg-white p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                        <div class="w-20 h-20 mx-auto bg-green-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-green-600 transition-colors duration-300 shadow-sm group-hover:shadow-green-500/30 group-hover:scale-110 transform">
                            <svg class="w-10 h-10 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">1. Snap a Photo</h3>
                        <p class="text-gray-500 leading-relaxed text-lg">Take a clear picture of the infected leaf or crop area using your smartphone or camera.</p>
                    </div>

                    <div class="text-center group bg-white p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                        <div class="w-20 h-20 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-blue-600 transition-colors duration-300 shadow-sm group-hover:shadow-blue-500/30 group-hover:scale-110 transform">
                            <svg class="w-10 h-10 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">2. AI Analysis</h3>
                        <p class="text-gray-500 leading-relaxed text-lg">Our advanced algorithm instantly processes the image to identify the exact disease affecting your crop.</p>
                    </div>

                    <div class="text-center group bg-white p-8 rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 transform hover:-translate-y-2">
                        <div class="w-20 h-20 mx-auto bg-emerald-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-emerald-600 transition-colors duration-300 shadow-sm group-hover:shadow-emerald-500/30 group-hover:scale-110 transform">
                            <svg class="w-10 h-10 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">3. Get Solutions</h3>
                        <p class="text-gray-500 leading-relaxed text-lg">Receive accurate pesticide recommendations and preventive strategies to save your harvest.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 py-12 text-center relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex justify-center items-center gap-2 mb-6 opacity-70">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    <span class="font-bold text-xl tracking-tight text-white">Crop<span class="text-green-500">AI</span></span>
                </div>
                <p class="text-gray-500">© 2026 Crop Analysis Portal. All rights reserved.</p>
            </div>
        </footer>
    </div>
</template>
