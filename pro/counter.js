
const counters = document.querySelectorAll('.counter');
let hasAnimated = false;

const animateCounter = (counter) => {
    const target = +counter.getAttribute('data-target');
    const suffix = counter.getAttribute('data-suffix') || '+';
    let count = 0;
    const speed = target / 100;

    const updateCount = () => {
        if (count < target) {
            count += speed;
            counter.innerText = Math.floor(count) + suffix;
            requestAnimationFrame(updateCount);
        } else {
            counter.innerText = target + suffix;
        }
    };

    updateCount();
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !hasAnimated) {
            counters.forEach(counter => animateCounter(counter));
            hasAnimated = true;
            observer.disconnect();
        }
    });
}, { threshold: 0.5 });

observer.observe(document.querySelector('#statistics'));
