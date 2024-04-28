<script type="module">
    const prevBtn = document.querySelector('.prev-carousel');
    const nextBtn = document.querySelector('.next-carousel');
    const container = document.querySelector('.carousel-container');

    let currentIndex = 0;

    prevBtn.addEventListener('click', () => {
        currentIndex = Math.max(currentIndex - 1, 0);
        updateSlidePosition();
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = Math.min(currentIndex + 1, container.children.length - 1);
        updateSlidePosition();
    });

    function updateSlidePosition() {
        const slideWidth = container.clientWidth;
        container.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
    }

</script>