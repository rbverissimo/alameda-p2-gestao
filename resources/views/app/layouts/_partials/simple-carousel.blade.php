<div class="carousel">
    <div class="carousel-container">
      @foreach ($itens_carrossel as $item)
          <div class="slide-carousel">
                {{ $item }}
          </div>
      @endforeach
    </div>
    <button class="prev-carousel">&#10094;</button>
    <button class="next-carousel">&#10095;</button>
</div>