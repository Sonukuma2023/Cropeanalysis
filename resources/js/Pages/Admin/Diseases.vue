<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    diseases: {
        type: Array,
        required: true
    },
    filters: {
        type: Object,
        default: () => ({ search: '' })
    }
});

const search = ref(props.filters.search || '');
const isModalOpen = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
    crop_name: '',
    disease_name: '',
    symptoms: '',
    pesticide: '',
    organic_solution: '',
    prevention: '',
});

const openCreateModal = () => {
    isEditing.value = false;
    editingId.value = null;
    form.reset();
    isModalOpen.value = true;
};

const openEditModal = (disease) => {
    isEditing.value = true;
    editingId.value = disease.id;
    form.crop_name = disease.crop_name;
    form.disease_name = disease.disease_name;
    form.symptoms = disease.symptoms;
    form.pesticide = disease.pesticide;
    form.organic_solution = disease.organic_solution;
    form.prevention = disease.prevention;
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
    form.reset();
};

const submitForm = () => {
    if (isEditing.value) {
        form.put(route('admin.diseases.update', editingId.value), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('admin.diseases.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const deleteDisease = (id) => {
    if (confirm('Are you sure you want to delete this disease registry?')) {
        router.delete(route('admin.diseases.destroy', id));
    }
};

const triggerSearch = () => {
    router.get(route('admin.diseases.index'), { search: search.value }, { preserveState: true });
};
</script>

<template>
    <Head title="Manage Crop Diseases" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Manage Crop Diseases</h2>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Main Board -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100 p-8">
                    
                    <!-- Top Actions -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                        <div>
                            <h3 class="text-3xl font-extrabold text-gray-900 tracking-tight">Disease Library</h3>
                            <p class="mt-2 text-lg text-gray-500">Configure and refine the diagnostic details for all crops.</p>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <input 
                                    v-model="search"
                                    @keyup.enter="triggerSearch"
                                    type="text" 
                                    placeholder="Search crop or disease..." 
                                    class="w-64 rounded-full border-gray-300 focus:border-green-500 focus:ring-green-500 pl-4 pr-10 py-2.5 shadow-sm text-sm"
                                />
                                <button @click="triggerSearch" class="absolute right-3 top-3 text-gray-400 hover:text-green-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </button>
                            </div>
                            
                            <button 
                                @click="openCreateModal"
                                class="inline-flex justify-center items-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 transition"
                            >
                                Add Disease
                            </button>
                        </div>
                    </div>

                    <!-- Database Diseases Table -->
                    <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Crop / Disease</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Symptoms</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Treatments</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-widest">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="disease in diseases" :key="disease.id" class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-green-600 uppercase tracking-wider mb-0.5">{{ disease.crop_name }}</span>
                                            <span class="text-lg font-bold text-gray-900">{{ disease.disease_name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-600 line-clamp-2 max-w-sm">{{ disease.symptoms }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-1 text-xs">
                                            <span class="text-gray-500"><b class="text-red-500">Chemical:</b> {{ disease.pesticide }}</span>
                                            <span class="text-gray-500"><b class="text-green-500">Organic:</b> {{ disease.organic_solution }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-semibold">
                                        <div class="flex justify-center items-center gap-3">
                                            <button @click="openEditModal(disease)" class="text-blue-600 hover:text-blue-900 transition bg-blue-50 px-3 py-1.5 rounded-full hover:bg-blue-100">Edit</button>
                                            <button @click="deleteDisease(disease.id)" class="text-red-600 hover:text-red-900 transition bg-red-50 px-3 py-1.5 rounded-full hover:bg-red-100">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="diseases.length === 0">
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        No disease records found. Click "Add Disease" to add one!
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Add/Edit Modal Dialogue -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4">
            <div class="bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-100 max-w-2xl w-full max-h-[90vh] flex flex-col transform transition-all scale-100">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900">
                        {{ isEditing ? 'Edit Crop Disease Registry' : 'Add New Crop Disease' }}
                    </h3>
                    <button @click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <form @submit.prevent="submitForm" class="p-6 overflow-y-auto space-y-4 flex-grow">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Crop Name</label>
                            <input 
                                v-model="form.crop_name"
                                type="text" 
                                required
                                placeholder="e.g. Tomato"
                                class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm text-sm"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Disease Name</label>
                            <input 
                                v-model="form.disease_name"
                                type="text" 
                                required
                                placeholder="e.g. Late Blight"
                                class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm text-sm"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Symptoms</label>
                        <textarea 
                            v-model="form.symptoms"
                            rows="2"
                            required
                            placeholder="Describe visual disease indicators on leaves/stems..."
                            class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm text-sm"
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Recommended Chemical Pesticide</label>
                        <input 
                            v-model="form.pesticide"
                            type="text" 
                            required
                            placeholder="e.g. Chlorothalonil, Copper fungicides"
                            class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm text-sm"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Recommended Organic Solution</label>
                        <input 
                            v-model="form.organic_solution"
                            type="text" 
                            required
                            placeholder="e.g. Baking soda spray, Neem oil extract"
                            class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm text-sm"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Prevention Strategies</label>
                        <textarea 
                            v-model="form.prevention"
                            rows="2"
                            required
                            placeholder="Best farming practices to prevent this disease..."
                            class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm text-sm"
                        ></textarea>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end gap-2">
                        <button 
                            type="button" 
                            @click="closeModal" 
                            class="px-5 py-2.5 border border-gray-200 text-sm font-semibold rounded-full hover:bg-gray-50"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            :disabled="form.processing"
                            class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-sm font-semibold text-white rounded-full transition disabled:opacity-50"
                        >
                            {{ isEditing ? 'Save Changes' : 'Create Record' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
