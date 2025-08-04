<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Company Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-gradient-start': '#3B82F6',
                        'blue-gradient-end': '#1E40AF',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
        }
        .gradient-card {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50">
    @auth
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-white text-xl font-bold">Company Management</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('companies.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Companies</a>
                    @endif
                    
                    @if(Auth::user()->isAdmin() || Auth::user()->isCompany())
                        <a href="{{ route('employees.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Employees</a>
                    @endif
                    
                    <div class="flex items-center space-x-2 text-white">
                        <span>{{ Auth::user()->name }}</span>
                        <span class="text-blue-200">({{ ucfirst(Auth::user()->role) }})</span>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <!-- Main Content -->
    <main class="@guest  @else pt-8 @endguest">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
