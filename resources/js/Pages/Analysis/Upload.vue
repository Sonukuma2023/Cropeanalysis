<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    image: null,
});

const imagePreview = ref(null);

const handleFileChange = (e) => {
    const file = e.target.files[0];
    form.image = file;
    if (file) {
        imagePreview.value = URL.createObjectURL(file);
    }
};

const handleDrop = (e) => {
    const file = e.dataTransfer.files[0];
    form.image = file;
    if (file) {
        imagePreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    form.post(route('analysis.upload'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Upload Crop Image" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Upload Crop Image</h2>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
            <div class="max-w-3xl w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 p-10">
                    
                    <div class="text-center mb-10">
                        <h3 class="text-3xl font-extrabold text-gray-900 tracking-tight">Detect Disease</h3>
                        <p class="mt-2 text-lg text-gray-500">Upload a clear image of the affected crop leaf.</p>
                    </div>

                    <div v-if="form.errors.image" class="bg-red-50 border-l-4 border-red-400 p-4 mb-8 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">{{ form.errors.image }}</h3>
                            </div>
                        </div>
                    </div>

                    <form @submit.prevent="submit" class="space-y-8">
                        
                        <div 
                            @dragover.prevent 
                            @drop.prevent="handleDrop"
                            class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-2xl transition-colors bg-gray-50 group"
                            :class="form.errors.image ? 'border-red-300' : 'border-gray-300 hover:border-green-500'"
                        >
                            <div class="space-y-2 text-center" v-if="!imagePreview">
                                <svg class="mx-auto h-16 w-16 text-gray-400 group-hover:text-green-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500 px-2 py-1 shadow-sm">
                                        <span>Upload a file</span>
                                        <input id="image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg" @change="handleFileChange">
                                    </label>
                                    <p class="pl-1 pt-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, JPEG up to 2MB
                                </p>
                            </div>
                            <div v-else class="text-center">
                                <img :src="imagePreview" class="mx-auto max-h-48 rounded-lg shadow-sm mb-4" />
                                <button type="button" @click="imagePreview = null; form.image = null" class="text-sm text-red-500 hover:text-red-700 font-medium">Remove Image</button>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" :disabled="form.processing || !form.image" class="w-full sm:w-auto flex justify-center py-3 px-8 border border-transparent rounded-full shadow-sm text-lg font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform transition hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span v-if="form.processing">Analyzing...</span>
                                <span v-else>Analyze Crop</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
