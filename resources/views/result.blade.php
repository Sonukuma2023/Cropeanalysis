<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Analysis Result') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 flex flex-col md:flex-row">
                
                <!-- Image Section -->
                <div class="w-full md:w-2/5 bg-gray-100 p-8 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-gray-200">
                    <h3 class="text-xl font-bold text-gray-700 mb-6">Uploaded Image</h3>
                    <div class="rounded-2xl overflow-hidden shadow-lg border-4 border-white">
                        <img src="{{ asset('storage/' . $upload->image_path) }}" alt="Crop Image" class="w-full h-auto object-cover max-h-80">
                    </div>
                </div>

                <!-- Result Section -->
                <div class="w-full md:w-3/5 p-8 md:p-12">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-3xl font-extrabold text-gray-900">Diagnosis Report</h3>
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            Confidence: 94% (Dummy)
                        </span>
                    </div>

                    @if($upload->disease)
                        <div class="space-y-6">
                            
                            <!-- Disease & Crop Info -->
                            <div class="bg-red-50 rounded-2xl p-6 border border-red-100">
                                <p class="text-sm font-bold text-red-500 uppercase tracking-wide mb-1">Detected Disease</p>
                                <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ $upload->disease->disease_name }}</h4>
                                <p class="text-gray-700"><span class="font-semibold">Crop:</span> {{ $upload->disease->crop_name }}</p>
                            </div>

                            <!-- Symptoms -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-900 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Symptoms
                                </h5>
                                <p class="text-gray-600 leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    {{ $upload->disease->symptoms }}
                                </p>
                            </div>

                            <!-- Treatment (Pesticide) -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-900 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                    Recommended Pesticide
                                </h5>
                                <p class="text-gray-600 leading-relaxed bg-green-50 p-4 rounded-xl border border-green-100">
                                    {{ $upload->disease->pesticide }}
                                </p>
                            </div>

                            <!-- Prevention -->
                            <div>
                                <h5 class="text-lg font-bold text-gray-900 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    Prevention Strategies
                                </h5>
                                <p class="text-gray-600 leading-relaxed bg-blue-50 p-4 rounded-xl border border-blue-100">
                                    {{ $upload->disease->prevention }}
                                </p>
                            </div>

                        </div>
                    @else
                        <div class="bg-gray-100 p-8 rounded-2xl text-center">
                            <p class="text-gray-500 text-lg">No disease information found for this upload.</p>
                        </div>
                    @endif

                    <div class="mt-10 pt-6 border-t border-gray-100 text-center">
                        <a href="{{ route('analysis.index') }}" class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-gray-900 hover:bg-gray-800 transition transform hover:-translate-y-1">
                            Analyze Another Crop
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
