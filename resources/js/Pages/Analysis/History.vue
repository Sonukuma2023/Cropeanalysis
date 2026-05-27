<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    uploads: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Head title="Analysis History" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Analysis History</h2>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8">
                    
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-3xl font-extrabold text-gray-900 tracking-tight">Your Past Scans</h3>
                            <p class="mt-2 text-lg text-gray-500">Track and review all previous crop health scans.</p>
                        </div>
                        <Link :href="route('analysis.index')" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-semibold rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 transition transform hover:-translate-y-0.5">
                            New Scan
                        </Link>
                    </div>

                    <!-- No Uploads Empty State -->
                    <div v-if="uploads.data.length === 0" class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">No scans found</h4>
                        <p class="text-gray-500 mb-6 max-w-sm mx-auto">You haven't uploaded any crop images for analysis yet.</p>
                        <Link :href="route('analysis.index')" class="inline-flex items-center gap-2 bg-green-600 text-white font-bold px-6 py-3 rounded-full hover:bg-green-700 transition">
                            Start First Diagnosis
                        </Link>
                    </div>

                    <!-- Uploads Grid -->
                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="upload in uploads.data" :key="upload.id" class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition duration-300 flex flex-col">
                            
                            <!-- Thumbnail -->
                            <div class="h-48 bg-gray-100 relative overflow-hidden">
                                <img :src="`/storage/${upload.image_path}`" alt="Scan Image" class="w-full h-full object-cover">
                                <span class="absolute top-4 right-4 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white shadow">
                                    {{ upload.accuracy }}% Conf.
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-bold text-green-600 uppercase tracking-widest">{{ upload.disease ? upload.disease.crop_name : 'Unknown Crop' }}</span>
                                        <span class="text-xs text-gray-400">{{ new Date(upload.created_at).toLocaleDateString() }}</span>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">
                                        {{ upload.disease ? upload.disease.disease_name : 'No Disease Detected' }}
                                    </h4>
                                    <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                                        {{ upload.disease ? upload.disease.symptoms : 'N/A' }}
                                    </p>
                                </div>
                                <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                                    <Link :href="route('analysis.result', upload.id)" class="text-sm font-bold text-green-600 hover:text-green-700 flex items-center gap-1 group">
                                        View Full Diagnosis
                                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div v-if="uploads.links.length > 3" class="mt-12 flex justify-center gap-2">
                        <template v-for="(link, key) in uploads.links" :key="key">
                            <div v-if="link.url === null" class="px-4 py-2 text-sm text-gray-400 border border-gray-100 rounded-lg cursor-not-allowed" v-html="link.label"></div>
                            <Link v-else :href="link.url" class="px-4 py-2 text-sm border rounded-lg hover:bg-gray-50 transition" :class="link.active ? 'bg-green-600 text-white border-green-600 font-semibold hover:bg-green-600' : 'text-gray-700 border-gray-200'" v-html="link.label"></Link>
                        </template>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
