<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Crop Analysis Portal</h3>
                    <p class="text-gray-600 text-lg mb-8">AI-powered crop disease detection and pesticide recommendation system.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-2xl p-6 text-white shadow-lg transform transition hover:scale-105">
                            <h4 class="text-xl font-bold mb-2">New Analysis</h4>
                            <p class="mb-6 opacity-90">Upload an image of your crop to instantly detect diseases and get pesticide recommendations.</p>
                            <a href="{{ route('analysis.index') }}" class="inline-block bg-white text-green-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-50 transition shadow-md">
                                Start Detection
                            </a>
                        </div>

                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl p-6 text-white shadow-lg transform transition hover:scale-105">
                            <h4 class="text-xl font-bold mb-2">History</h4>
                            <p class="mb-6 opacity-90">View your past crop analysis results and track the health of your farm over time.</p>
                            <a href="#" class="inline-block bg-white text-blue-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-50 transition shadow-md">
                                View History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
