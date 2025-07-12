@if(app()->environment('local'))
<div class="bg-gray-100 border-l-4 border-blue-500 p-4 mb-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-blue-500"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Debug Tools</h3>
            <div class="mt-2 text-sm text-blue-700">
                <p>Storage path: {{ storage_path('app/public') }}</p>
                <p>Public storage path: {{ public_path('storage') }}</p>
                <p>Storage link exists: {{ file_exists(public_path('storage')) ? 'Yes' : 'No' }}</p>
            </div>
            <div class="mt-3">
                <a href="/debug/images" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Check Images</a>
                <a href="/debug/fix-storage" target="_blank" class="ml-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm">Fix Storage Link</a>
            </div>
        </div>
    </div>
</div>
@endif
