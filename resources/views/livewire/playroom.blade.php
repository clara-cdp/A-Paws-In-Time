<div class="relative h-full w-full overflow-hidden bg-black" x-data="roomMap('{{ $roomType }}')" x-init="init()">
    <div class="absolute top-4 left-4 z-50 pointer-events-none ">
        <h1>{{ $room->name }}</h1>
    </div>
    {{-- dialog --}}
    <div id="game-dialog"
        class="absolute top-16 left-4 z-50 w-[90vw] md:w-[600px] pointer-events-none transition-opacity duration-300 opacity-0 hidden">
        <div
            class="whitespace-nowrap bg-black/90 border-2 border-yellow-300 text-yellow-200 p-4 text-center font-bold tracking-widest  md:text-base rounded-lg shadow-[0_0_15px_rgba(253,224,71,0.5)]">
            <span id="game-dialog-text"></span>
        </div>
    </div>
    {{-- room rendering --}}
    <div x-ref="mapContainer" class="absolute left-0 top-0 select-none touch-none" :style="style"
        :class="isDragging ? 'cursor-grabbing' : 'cursor-grab'" @pointerdown="startDrag" @pointermove="onDrag"
        @pointerup="endDrag" @pointercancel="endDrag">
        <div class="h-full w-full [&>svg]:w-full [&>svg]:h-full">
            {!! file_get_contents(public_path($room->image_URL)) !!}
        </div>
    </div>

    {{-- * * * * room rendering styles * * * * --}}
    <script>
        function roomMap(roomType) {
            return {
                roomType,
                x: 0,
                y: 0,
                mapWidth: 0,
                mapHeight: 0,
                isDragging: false,
                startX: 0,
                startY: 0,
                raf: null,
                resizeObserver: null,

                get style() {
                    return `
                transform: translate3d(${this.x}px, ${this.y}px, 0);
                width: ${this.mapWidth}px;
                height: ${this.mapHeight}px;
                will-change: transform;`;
                },

                init() {
                    this.calculateSize();
                    this.centerMap();

                    this.resizeObserver = new ResizeObserver(() => {
                        this.calculateSize();
                        this.centerMap();
                    });

                    this.resizeObserver.observe(this.$root);
                },

                destroy() {
                    if (this.resizeObserver) {
                        this.resizeObserver.disconnect();
                    }
                },

                calculateSize() {
                    const svg = this.$refs.mapContainer.querySelector('svg');
                    if (!svg) return;

                    let vb = svg.viewBox.baseVal;
                    let originalW = vb.width || 3000;
                    let originalH = vb.height || 2000;
                    let ratio = originalW / originalH;

                    let containerW = this.$root.clientWidth;
                    let containerH = this.$root.clientHeight;

                    if (this.roomType === 'hor') {
                        this.mapHeight = containerH;
                        this.mapWidth = containerH * ratio;
                    } else if (this.roomType === 'ver') {
                        this.mapWidth = containerW;
                        this.mapHeight = containerW / ratio;
                    } else {
                        this.mapWidth = Math.max(containerW, originalW);
                        this.mapHeight = Math.max(containerH, originalH);
                    }
                },

                centerMap() {
                    this.x = (this.$root.clientWidth - this.mapWidth) / 2;
                    this.y = (this.$root.clientHeight - this.mapHeight) / 2;
                    this.clamp();
                },

                clamp() {
                    let minX = this.$root.clientWidth - this.mapWidth;
                    let minY = this.$root.clientHeight - this.mapHeight;

                    if (this.mapWidth > this.$root.clientWidth) {
                        this.x = Math.min(0, Math.max(this.x, minX));
                    } else {
                        this.x = (this.$root.clientWidth - this.mapWidth) / 2;
                    }

                    if (this.mapHeight > this.$root.clientHeight) {
                        this.y = Math.min(0, Math.max(this.y, minY));
                    } else {
                        this.y = (this.$root.clientHeight - this.mapHeight) / 2;
                    }
                },

                startDrag(e) {
                    this.isDragging = true;
                    this.startX = e.clientX;
                    this.startY = e.clientY;
                    e.target.setPointerCapture(e.pointerId);
                },

                onDrag(e) {
                    if (!this.isDragging) return;

                    cancelAnimationFrame(this.raf);

                    this.raf = requestAnimationFrame(() => {
                        let dx = e.clientX - this.startX;
                        let dy = e.clientY - this.startY;

                        if (this.roomType === 'all' || this.roomType === 'hor') {
                            this.x += dx;
                        }

                        if (this.roomType === 'all' || this.roomType === 'ver') {
                            this.y += dy;
                        }

                        this.startX = e.clientX;
                        this.startY = e.clientY;

                        this.clamp();
                    });
                },

                endDrag(e) {
                    this.isDragging = false;
                    if (e.pointerId) {
                        e.target.releasePointerCapture(e.pointerId);
                    }
                }
            }
        }
    </script>

    {{-- * * * object visibility & dialog script * * * --}}
    @script
        <script>
            // --- dialog box ------------------------------------------------------------------
            Livewire.on('show-dialog', (data) => {
                const text = Array.isArray(data) ? data[0]?.text : (data.text || data);
                if (!text) return;

                const dialog = document.getElementById('game-dialog');
                const dialogText = document.getElementById('game-dialog-text');

                dialogText.innerText = text;
                dialog.classList.remove('hidden');
                setTimeout(() => dialog.classList.remove('opacity-0'), 10);

                setTimeout(() => {
                    dialog.classList.add('opacity-0');
                    setTimeout(() => dialog.classList.add('hidden'), 300);
                }, 2000);
            });

            // --- room items -----------------------------------------------------------------------
            Livewire.on('room-items-loaded', (data) => {
                const items = Array.isArray(data) ? data[0]?.items : (data.items || data);
                if (!items) return;

                const validItemIds = items.map(item => item.css_id);

                document.querySelectorAll('[data-livewire-initialized="true"]').forEach(el => {
                    if (!validItemIds.includes(el.id)) {
                        el.style.opacity = '0';
                        el.style.pointerEvents = 'none';
                    }
                });

                items.forEach(item => {
                    let svgElement = document.getElementById(item.css_id);
                    if (!svgElement) return;

                    if (!item.is_visible) {
                        svgElement.style.opacity = '0';
                        svgElement.style.pointerEvents = 'none';
                    } else {
                        svgElement.style.opacity = '1';
                        svgElement.style.pointerEvents = '';
                    }

                    if (svgElement.dataset.livewireInitialized) return;
                    svgElement.dataset.livewireInitialized = "true";
                    svgElement.style.cursor = "pointer";

                    svgElement.onpointerdown = (e) => e.stopPropagation();

                    svgElement.onclick = (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        $wire.dispatch("roomItemClicked", {
                            css_id: item.css_id
                        });
                    };
                });
            });

            // ----- display / hide items ------------------------------------------------------
            Livewire.on('show-item', (data) => {
                const css_id = Array.isArray(data) ? data[0]?.css_id : data.css_id;
                let el = document.getElementById(css_id);
                if (el) {
                    el.style.opacity = '1';
                    el.style.pointerEvents = '';
                }
            });

            Livewire.on('hide-item', (data) => {
                const css_id = Array.isArray(data) ? data[0]?.css_id : data.css_id;
                let el = document.getElementById(css_id);
                if (el) {
                    el.style.opacity = '0';
                    el.style.pointerEvents = 'none';
                }
            });
        </script>
    @endscript

</div>
