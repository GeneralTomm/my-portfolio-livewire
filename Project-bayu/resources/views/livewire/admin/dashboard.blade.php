<div>

    <div class="container px-5 py-10 mx-auto">

        <div class="flex flex-wrap -m-4 text-center">
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900">{{ count($project) }}</h2>
            <p class="leading-relaxed">
                <a href="{{ route('project') }}">Projects</a>

            </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900">{{ count($categories_project) }}</h2>
            <p class="leading-relaxed">
                <a href="{{ route('categories-project') }}">Categories Projects</a>
                </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900">{{ count($service) }}</h2>
            <p class="leading-relaxed">
                <a href="{{ route('services') }}">Services</a>
            </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900"></h2>
            <p class="leading-relaxed">
                <a href="#">Blog</a>
            </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900">{{ count($testimonial) }}</h2>
            <p class="leading-relaxed">
                <a href="{{ route('testimonial') }}">Testimonial</a>
            </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900"></h2>
            <p class="leading-relaxed">
                <a href="#">Categories Blog</a>
            </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900">{{ count($order) }}</h2>
            <p class="leading-relaxed">
                <a href="{{ route('order-step') }}">Orders Step</a>
            </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900">{{ count($about) }}</h2>
            <p class="leading-relaxed">
                <a href="{{ route('about-me') }}">About</a>
            </p>
          </div>
          <div class="p-4 md:w-1/5 w-full bg-white shadow border-t-4 border-green-500 m-3">
            <h2 class="title-font font-medium md:text-4xl sm:text-3xl text-gray-900">{{ count($settings) }}</h2>
            <p class="leading-relaxed">
                <a href="{{ route('settings') }}">Settings</a>
            </p>
          </div>
        </div>
      </div>
</div>
