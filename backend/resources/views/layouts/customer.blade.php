<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer | Order Management System')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: tailwind.colors.indigo,
                        secondary: tailwind.colors.slate,
                        accent: tailwind.colors.purple,
                    }
                }
            }
        }
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- HugeIcons -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
    <!-- Customer Header -->
    <header class="bg-white shadow-sm p-4 animate__animated animate__fadeInDown">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-xl font-bold text-primary-600">OMS Customer</div>
        </div>
    </header>

    <main class="flex-1 container mx-auto p-4 sm:p-6">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>