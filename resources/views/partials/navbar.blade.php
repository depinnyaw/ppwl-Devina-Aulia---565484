<nav class="mb-8 border-b border-gray-200 bg-white">
    <div class="max-w-5xl mx-auto flex items-center gap-6 px-6 py-4">
        
        <a href="{{ route('home') }}"
           class="mr-4 text-lg font-bold text-gray-800">
            My Portfolio
        </a>
    
        <a href="{{ route('home') }}"
           class="font-semibold text-gray-800 hover:text-blue-500">
            Home
        </a>

        <a href="{{ route('about') }}"
           class="text-gray-600 hover:text-blue-500">
            About
        </a>

        <a href="{{ route('education') }}"
           class="text-gray-600 hover:text-blue-500">
            Education
        </a>

        <a href="{{ route('projects.index') }}"
           class="text-gray-600 hover:text-blue-500">
            Projects
        </a>


        <a href="{{ route('projects.create') }}"
            class="text-gray-600 hover:text-blue-500">
            Post
        </a>
    </div>
</nav>