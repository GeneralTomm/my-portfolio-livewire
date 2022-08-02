<div>
  <nav
  wire:poll.keep-alive
  x-data="{show:false}"
  class="
    flex
    items-center
    justify-between
    flex-wrap
    bg-white
    lg:px-20
    px-5
    py-5
    shadow-sm
    fixed
    w-full
    top-0
    z-50
    dark:bg-hitam
  "
>
  <div class="flex items-center flex-shrink-0 text-biru-muda mr-6">
    <a
      href="/"
      class="font-semibold text-3xl tracking-tight dark:text-putih"
      >{{$setting->name_website}}</a
    >
  </div>

  <div class="block md:hidden">
    <button
      @click="show=!show"
      class="
        flex
        items-center
        px-3
        py-2
        rounded
        text-red-500
        dark:text-white
        border-gray-200
        hover:text-black
        dark:hover:text-red-500
      "
    >
      <svg
        class="fill-current h-5 w-5"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <title>Menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
      </svg>
    </button>
  </div>
  <div
    @click.away="show = true"
    :class="{ 'block': show, 'hidden': !show }"
    class="w-full block flex-grow md:flex md:justify-end md:w-auto"
  >
    <div class="md:flex items-center justify-center menu-link">
      <a
        href="/"
        class="
          block
          md:inline-block
          active
          text-sm
          px-4
          py-2
          dark:text-white dark:text-red-500
          leading-none
          rounded
          text-gray-500
          border-white
          hover:border-transparent
          mt-4
          md:mt-0
        "
        >Beranda</a
      >
      <a
        href="#layanan"
        class="
          block
          md:inline-block
          text-sm
          px-4
          py-2
          dark:text-white dark:hover:text-red-500
          leading-none
          rounded
          text-hitam
          hover:text-hijau-terang
          mt-4
          md:mt-0
        "
        >Layanan</a
      >
      <a
        href="#order"
        class="
          block
          md:inline-block
          text-sm
          px-4
          py-2
          dark:text-white dark:hover:text-red-500
          leading-none
          rounded
          text-hitam
          hover:text-hijau-terang
          mt-4
          md:mt-0
        "
        >Cara Order</a
      >
      <a
        href="#"
        class="
          block
          md:inline-block
          text-sm
          px-4
          py-2
          dark:text-white dark:hover:text-red-500
          leading-none
          rounded
          text-hitam
          hover:text-hijau-terang
          mt-4
          md:mt-0
        "
        >Testimonial</a
      >
      <a
        href="{{route('about')}}"
        class="
          block
          md:inline-block
          text-sm
          px-4
          py-2
          dark:text-white dark:hover:text-red-500
          leading-none
          rounded
          text-hitam
          hover:text-hijau-terang
          mt-4
          md:mt-0
          {{ (request()->is('about')) ? 'text-hijau-terang' : '' }}
        "
        >Tentang Kami</a
      >
      <a
        href="kontak.html"
        class="
          block
          md:inline-block
          text-sm
          px-4
          py-2
          dark:text-white dark:hover:text-red-500
          leading-none
          rounded
          text-hitam
          hover:text-hijau-terang
          mt-4
          md:mt-0
        "
        >Kontak</a
      >
      <a
        href="#"
        class="
          block
          md:inline-block
          text-sm
          px-4
          py-2
          transition
          duration-500
          ease-in-out
          leading-none
          rounded
          text-white
          bg-hijau-terang
          hover:border-transparent hover:bg-biru-muda
          mt-4
          md:mt-0
        "
        >Pesan</a
      >
    </div>
  </div>
</nav>
</div>
