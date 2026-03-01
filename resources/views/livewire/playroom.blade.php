<div class="relative h-full w-full overflow-hidden bg-black" x-data="roomMap('{{ $roomType }}')" x-init="init()">

    <div x-ref="mapContainer" class="absolute left-0 top-0 select-none touch-none" :style="style"
        :class="isDragging ? 'cursor-grabbing' : 'cursor-grab'" @pointerdown="startDrag" @pointermove="onDrag"
        @pointerup="endDrag" @pointercancel="endDrag">
        <div class="h-full w-full [&>svg]:w-full [&>svg]:h-full">
            {!! file_get_contents(public_path($room->image_URL)) !!}
        </div>
    </div>
</div>

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
