<nav class="bg-[#740C30] text-white shadow-md" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo y Nombre de la Plataforma -->
            <div class="flex items-center space-x-3">
                <img src="{{asset('images/cecyteh_horizontal_logo.png')}}" alt="Logo" class="h-10">
                <a href="{{route('panel.alumnos')}}" class="text-xl font-bold">Plantel Capula</a>
            </div>

            <!-- Menú para pantallas grandes -->
            <div class="hidden md:flex space-x-6">
                <a href="{{route('panel.alumnos')}}" class="hover:text-gray-300 transition">Inicio</a>
                <a href="{{route('students.qualifications.index')}}" class="hover:text-gray-300 transition">Calificaciones</a>
                <a href="{{route('profile.show')}}" class="hover:text-gray-300 transition">Configuración</a>
            </div>

            <!-- Menú de usuario -->
            <div class="hidden md:flex space-x-4">
                @auth
                    <span class="text-gray-200 pt-2">Hola, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-600 px-4 py-2 rounded hover:bg-red-700 transition">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-gray-800 px-4 py-2 rounded hover:bg-gray-700 transition">Iniciar sesión</a>
                @endauth
            </div>

            <!-- Botón de menú móvil -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" class="text-white focus:outline-none text-2xl">
                    ☰
                </button>
            </div>
        </div>
    </div>

    <!-- Menú desplegable en móviles -->
    <div x-show="open" class="md:hidden bg-[#800020] text-white py-2 space-y-2" x-cloak>
        <div class="flex items-center space-x-3 px-4">
            <img src="/ruta-del-logo.png" alt="Logo" class="h-10">
            <span class="text-lg font-semibold">Mi Plataforma</span>
        </div>
        <a href="{{route('panel.alumnos')}}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
        <a href="{{route('students.qualifications.index')}}" class="block px-4 py-2 hover:bg-gray-700">Calificaciones</a>
        <a href="{{route('profile.show')}}" class="block px-4 py-2 hover:bg-gray-700">Mi Perfil</a>
        @auth
            <div class="px-4 py-2 text-gray-300">Hola, {{ Auth::user()->name }}</div>
            <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2">
                @csrf
                <button class="w-full text-left hover:bg-gray-700">Cerrar sesión</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-700">Iniciar sesión</a>
        @endauth
    </div>
</nav>
