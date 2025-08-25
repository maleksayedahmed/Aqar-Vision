const buttons = document.querySelectorAll('.toggle-btn');
        const activeClasses = ['bg-indigo-100', 'text-indigo-700', 'shadow-sm'];
        const inactiveClasses = ['text-gray-500', 'hover:bg-gray-50'];

        // Function to set the initial state
        function setInitialState() {
            buttons.forEach(button => {
                if (button.classList.contains('active')) {
                    button.classList.add(...activeClasses);
                    button.classList.remove(...inactiveClasses);
                } else {
                    button.classList.add(...inactiveClasses);
                    button.classList.remove(...activeClasses);
                }
            });
        }

        buttons.forEach(clickedButton => {
            clickedButton.addEventListener('click', () => {
                // Remove active state from all buttons
                buttons.forEach(button => {
                    button.classList.remove('active', ...activeClasses);
                    button.classList.add(...inactiveClasses);
                });

                // Add active state to the clicked button
                clickedButton.classList.add('active', ...activeClasses);
                clickedButton.classList.remove(...inactiveClasses);
            });
        });

        // Set the initial styles on page load
        setInitialState();


        // Property slider functionality
document.addEventListener('DOMContentLoaded', function() {
    const sliderTrack = document.getElementById('sliderTrack');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const cards = document.querySelectorAll('.slider-card');

    let currentIndex = 0;
    const cardWidth = 320; // Card width in pixels
    const gap = 16; // Gap between cards (assuming 1rem = 16px)
    const slideDistance = cardWidth + gap;
    const maxIndex = cards.length - 1;

    // Function to update slider position
    function updateSliderPosition() {
        const translateX = currentIndex * slideDistance;
        if (sliderTrack) {
            sliderTrack.style.transform = `translateX(${translateX}px)`;
        }

        // Update button states
        if (prevBtn) {
            prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
        nextBtn.style.opacity = currentIndex === maxIndex ? '0.5' : '1';
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex === maxIndex;
        }

    }

    // Next button click handler
    if(nextBtn){
    nextBtn.addEventListener('click', function() {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateSliderPosition();
        }
    });
}

    // Previous button click handler
    if(prevBtn){
    prevBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });
}

    // Initialize slider
    updateSliderPosition();


    // Optional: Add touch/swipe support for mobile
    let startX = 0;
    let currentX = 0;
    let isDragging = false;

    if (!sliderTrack) return; // Ensure sliderTrack exists before adding listeners
    sliderTrack.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
        isDragging = true;
    });

    sliderTrack.addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        currentX = e.touches[0].clientX;
        e.preventDefault();
    });

    sliderTrack.addEventListener('touchend', function() {
        if (!isDragging) return;
        isDragging = false;

        const diffX = startX - currentX;
        const threshold = 50; // Minimum swipe distance

        if (Math.abs(diffX) > threshold) {
            if (diffX > 0 && currentIndex < maxIndex) {
                // Swipe left - go to next
                currentIndex++;
                updateSliderPosition();
            } else if (diffX < 0 && currentIndex > 0) {
                // Swipe right - go to previous
                currentIndex--;
                updateSliderPosition();
            }
        }
    });



});


//agents slider functionality
document.addEventListener('DOMContentLoaded', () => {

  const slider = document.querySelector('#agents-slider');
  const gradientLeft = document.querySelector('#gradient-left');
  const gradientRight = document.querySelector('#gradient-right');

  // ======== Dynamic Gradient Logic ========
  const checkGradients = () => {
    if (!slider) return;

    // For RTL: scrollLeft is negative or 0. We use Math.abs for simplicity.
    const scrollPos = Math.abs(slider.scrollLeft);
    const maxScroll = slider.scrollWidth - slider.clientWidth;

    // Show/hide left gradient (at the start of the scroll)
    if (scrollPos > 10) {
      gradientLeft.classList.remove('opacity-0');
    } else {
      gradientLeft.classList.add('opacity-0');
    }

    // Show/hide right gradient (at the end of the scroll)
    if (scrollPos < maxScroll - 10) {
      gradientRight.classList.remove('opacity-0');
    } else {
      gradientRight.classList.add('opacity-0');
    }
  };


  // ======== Drag-to-Scroll Logic ========
  let isDown = false;
  let startX;
  let scrollLeft;

  if(slider){
  slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });

  slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
  });

  slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
  });

  slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 2;
    slider.scrollLeft = scrollLeft - walk;
  });

  // ======== Event Listeners ========
  slider.addEventListener('scroll', checkGradients);
}
  window.addEventListener('resize', checkGradients);

  // Initial check on load
  checkGradients();




});



//header scroll functionality
    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    const header = document.getElementById('main-header');
    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        if (currentScrollY <= 0) {
            console.log('At the very top');
            header.classList.remove('-translate-y-full');
        }
        else if (currentScrollY < lastScrollY) {
            // console.log('Scrolling down');
            header.classList.remove('-translate-y-full');
        }
        else {
            // console.log('Scrolling up');
            header.classList.add('-translate-y-full');
        }

        lastScrollY = currentScrollY < 0 ? 0 : currentScrollY;
    });



    // --- User Profile Dropdown Logic ---
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        if (userMenuButton && userMenu) {
            // Toggle menu on button click
            userMenuButton.addEventListener('click', (event) => {
                event.stopPropagation(); // Prevent the window click listener from firing immediately
                const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
                userMenu.classList.toggle('hidden');
                userMenuButton.setAttribute('aria-expanded', !isExpanded);
            });

            // Close menu when clicking outside of it
            window.addEventListener('click', (event) => {
                if (!userMenu.classList.contains('hidden') && !userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                    userMenu.classList.add('hidden');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                }
            });

        }
