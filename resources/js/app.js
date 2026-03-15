window.addEventListener('resize', () => {
    this.init();
});

document.addEventListener('livewire:init', () => {

    Livewire.on('room-items-loaded', ({ items }) => {

        items.forEach(item => {

            const el = document.getElementById(item.css_id);
            if (!el) return;

            if (el.dataset.listenerAttached) return;
            el.dataset.listenerAttached = "true";

            el.style.cursor = "pointer";

            el.addEventListener("pointerdown", e => {
                e.stopPropagation(); // prevents drag
            });

            el.addEventListener("click", () => {

                console.log("SVG item clicked:", item.id);

                Livewire.dispatch("roomItemClicked", {
                    css_id: item.css_id
                });

            });

        });

    });

});


// splash screen---------------------------------
/*

window.addEventListener('load', () => {
    const splash = document.getElementById('splash-screen');
    setTimeout(() => {
        splash.style.opacity = '0';
        setTimeout(() => {
            splash.style.display = 'none';
        }, 700);
    }, 2000);
});

*/