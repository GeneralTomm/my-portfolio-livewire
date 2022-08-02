<div>
    <section
      class="bg-hijau-terang bg-gradient-to-t from-biru-muda lg:px-20 px-5 py-32" id="home"
    >
      <div class="flex flex-col items-center justify-center">
        <h2 class="text-putih font-bold md:text-4xl text-3xl text-center">
          {{$about->title}}
        </h2>
        <p class="mt-4 font-medium tracking-wider text-base md:text-left text-center text-putih">
            {{$about->short_title}}
        </p>
      </div>
    </section>
    <section class="lg:px-20 px-5 py-10">
        <p class="text-justify font-medium">
            {!!$about->description!!}
        </p>
    </section>
</div>
