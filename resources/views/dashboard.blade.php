<x-app-layout>
    @section('content')
        @auth
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- إحصائيات -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- إجمالي التذاكر -->
                        <div
                            class="bg-gradient-to-r from-purple-400 to-indigo-500 text-white overflow-hidden shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $totalTickets }}</div>
                                <div class="text-sm">{{ __('Total Tickets') }}</div>
                            </div>
                            <div class="text-4xl">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                        </div>

                        <!-- التذاكر المفتوحة -->
                        <div
                            class="bg-gradient-to-r from-green-400 to-teal-500 text-white overflow-hidden shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $openTickets }}</div>
                                <div class="text-sm">{{ __('Open Tickets') }}</div>
                            </div>
                            <div class="text-4xl">
                                <i class="fas fa-folder-open"></i>
                            </div>
                        </div>

                        <!-- التذاكر المغلقة -->
                        <div
                            class="bg-gradient-to-r from-red-400 to-pink-500 text-white overflow-hidden shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $closedTickets }}</div>
                                <div class="text-sm">{{ __('Closed Tickets') }}</div>
                            </div>
                            <div class="text-4xl">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>

                        <!-- إجمالي التعليقات -->
                        <div
                            class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white overflow-hidden shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $totalComments }}</div>
                                <div class="text-sm">{{ __('Total Comments') }}</div>
                            </div>
                            <div class="text-4xl">
                                <i class="fas fa-comments"></i>
                            </div>
                        </div>

                        <!-- إجمالي المستخدمين -->
                        <div
                            class="bg-gradient-to-r from-blue-400 to-cyan-500 text-white overflow-hidden shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-bold">{{ $totalUsers }}</div>
                                <div class="text-sm">{{ __('Total Users') }}</div>
                            </div>
                            <div class="text-4xl">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>

                        @if (Auth::user()->role === 'admin')
                            <!-- إجمالي الفئات (للمسؤول) -->
                            <div
                                class="bg-gradient-to-r from-pink-400 to-red-500 text-white overflow-hidden shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                                <div>
                                    <div class="text-2xl font-bold">{{ $totalCategories }}</div>
                                    <div class="text-sm">{{ __('Total Categories') }}</div>
                                </div>
                                <div class="text-4xl">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                                                <!-- أحدث الأنشطة -->
                        @endif
                    </div>
                    @if (Auth::user()->role === 'admin')
                    <div class="py-8">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-75 shadow-lg rounded-lg p-6 mb-6">
                                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-black">{{ __('Recent Activities') }}</h3>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entity</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($activities as $activity)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $activity->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $activity->user->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($activity->action) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ class_basename($activity->subject_type) }} #{{ $activity->subject_id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- يمكنك إضافة المزيد من المحتوى هنا -->
                </div>
            </div>
        @else
            <h3>You need to log in</h3>
        @endauth
    @endsection
</x-app-layout>
