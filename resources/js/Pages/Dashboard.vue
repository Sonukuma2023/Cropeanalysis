<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    stats: {
        type: Object,
        required: true
    },
    recentScans: {
        type: Array,
        required: true
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-bold leading-tight text-gray-800">
                CropAI Dashboard
            </h2>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8">
                
                <!-- Quick Statistics Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Scans -->
                    <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Total Scans</p>
                            <h4 class="text-3xl font-extrabold text-gray-900">{{ stats.totalScans }}</h4>
                        </div>
                    </div>

                    <!-- Common Disease -->
                    <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Common Disease</p>
                            <h4 class="text-lg font-bold text-gray-900 truncate max-w-[180px]" :title="stats.commonDisease">{{ stats.commonDisease }}</h4>
                        </div>
                    </div>

                    <!-- Total Diseases -->
                    <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Diseases Library</p>
                            <h4 class="text-3xl font-extrabold text-gray-900">{{ stats.totalDiseases }}</h4>
                        </div>
                    </div>

                    <!-- Last Scan -->
                    <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Last Scan Date</p>
                            <h4 class="text-lg font-bold text-gray-900">{{ stats.lastScanDate }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Main Action and Navigation Cards -->
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-3xl border border-gray-100">
                    <div class="p-8 text-gray-900 lg:p-12">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-3xl font-extrabold text-gray-900 tracking-tight">Welcome to CropAI Portal</h3>
                        </div>
                        <p class="text-gray-600 text-lg mb-10 leading-relaxed max-w-2xl">Your AI-powered crop disease detection and pesticide recommendation system is ready. What would you like to do today?</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- New Analysis Card -->
                            <div class="relative overflow-hidden bg-gradient-to-br from-green-500 to-emerald-700 rounded-3xl p-8 text-white shadow-lg transform transition-all duration-300 hover:scale-[1.03] hover:shadow-green-500/20 group">
                                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl group-hover:opacity-20 transition-opacity"></div>
                                <div class="relative z-10 flex flex-col justify-between h-full">
                                    <div>
                                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                        </div>
                                        <h4 class="text-2xl font-bold mb-3">New Analysis</h4>
                                        <p class="mb-8 text-green-50 text-base leading-relaxed">Upload crop leaf photo to diagnose diseases and fetch targeted treatment.</p>
                                    </div>
                                    <Link :href="route('analysis.index')" class="inline-flex items-center gap-2 bg-white text-green-700 font-bold px-6 py-3 rounded-full hover:bg-gray-50 transition shadow-md w-fit">
                                        Scan Now
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </Link>
                                </div>
                            </div>

                            <!-- History Card -->
                            <div class="relative overflow-hidden bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl p-8 text-white shadow-lg transform transition-all duration-300 hover:scale-[1.03] hover:shadow-gray-900/20 group">
                                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl group-hover:opacity-10 transition-opacity"></div>
                                <div class="relative z-10 flex flex-col justify-between h-full">
                                    <div>
                                        <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <h4 class="text-2xl font-bold mb-3">Scan History</h4>
                                        <p class="mb-8 text-gray-300 text-base leading-relaxed">Review history scans, track crop conditions and view remedies archive.</p>
                                    </div>
                                    <Link :href="route('analysis.history')" class="inline-flex items-center gap-2 bg-gray-700 text-white font-bold px-6 py-3 rounded-full hover:bg-gray-600 transition shadow-md w-fit">
                                        View History
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </Link>
                                </div>
                            </div>

                            <!-- Admin CRUD Card -->
                            <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl p-8 text-white shadow-lg transform transition-all duration-300 hover:scale-[1.03] hover:shadow-blue-600/20 group">
                                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl group-hover:opacity-20 transition-opacity"></div>
                                <div class="relative z-10 flex flex-col justify-between h-full">
                                    <div>
                                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                        </div>
                                        <h4 class="text-2xl font-bold mb-3">Admin Panel</h4>
                                        <p class="mb-8 text-blue-50 text-base leading-relaxed">Add, modify, and delete disease registry records and pesticide parameters.</p>
                                    </div>
                                    <Link :href="route('admin.diseases.index')" class="inline-flex items-center gap-2 bg-white text-blue-700 font-bold px-6 py-3 rounded-full hover:bg-gray-50 transition shadow-md w-fit">
                                        Manage Diseases
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </Link>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Recent Scans Board -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-6">Recent Diagnostic Activity</h3>
                    
                    <div v-if="recentScans.length === 0" class="text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <p class="text-gray-500">No recent diagnoses found. Hit "Scan Now" to run your first crop disease detection!</p>
                    </div>
                    
                    <div v-else class="overflow-x-auto rounded-2xl border border-gray-100">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Crop</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Detected Disease</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Scan Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Accuracy</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-widest">Report</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="scan in recentScans" :key="scan.id" class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600 uppercase tracking-wider">
                                        {{ scan.disease ? scan.disease.crop_name : 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        {{ scan.disease ? scan.disease.disease_name : 'No Disease Detected' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ new Date(scan.created_at).toLocaleDateString() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                            {{ scan.accuracy }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-semibold">
                                        <Link :href="route('analysis.result', scan.id)" class="text-green-600 hover:text-green-900 transition">View Report</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
