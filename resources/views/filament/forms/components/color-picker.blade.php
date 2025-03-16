<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div>
        <!-- Boutons de sélection du mode -->
        <div style="display: flex; gap: 10px;">
            <button type="button" onclick="toggleMode('camera', '{{ $getId() }}')"
                style="padding: 5px 10px; background-color: #ffffff; color: #000000; border-radius: 10px;">
                Photo
            </button>

            <!-- Mode Appareil Photo -->
            <div id="cameraMode{{ $getId() }}" style="display: none;">
                <input type="file" id="cameraInput{{ $getId() }}" accept="image/*" capture="environment">
                <canvas id="canvas{{ $getId() }}" style="display: none;"></canvas>
            </div>

            <!-- Mode Color Picker -->
            <div x-data x-init="
                $nextTick(() => {
                    let el = document.querySelector('#colorPicker');
                    if (!el) {
                        console.error('Élément Pickr introuvable.');
                        return;
                    }

                    let pickr = Pickr.create({
                        el: el,
                        theme: 'classic',
                        default: '{{ $getState() ?? '#ffffff' }}',
                        swatches: ['000000', 'A0AEC0', 'F56565', 'ED8936', 'ECC94B', '48BB78', '38B2AC', '4299E1', '667EEA', '9F7AEA', 'ED64A6', 'FFFFFF'],
                        components: {
                            preview: true,
                            opacity: true,
                            hue: true,
                            interaction: {
                                hex: true,
                                rgba: true,
                                input: true,
                                clear: true,
                                save: true
                            }
                        }
                    });

                    pickr.on('save', (color) => {
                        let currentColor = color ? color.toHEXA().toString() : '';

                        // Met à jour la valeur dans Filament
                        @this.set('{{ $getStatePath() }}', currentColor);

                        pickr.hide();
                    });
                });
            ">
                <div id="colorPicker"></div>
            </div>
        </div>

        <h4>Couleur choisie :</h4>
        <!-- Prévisualisation de la couleur sélectionnée -->
        <div id="colorPreview{{ $getId() }}"
            style="width: 50px; height: 50px;
            border-radius: 50%; border: 1px solid #333;
            margin-top: 8px;
            background-color: {{ $getState() ?? '#ffffff' }};">
        </div>
    </div>
</x-dynamic-component>

<script>
    /**
     * Permet de basculer entre le mode appareil photo et le mode color picker
     */
    function toggleMode(mode, id) {
        if (mode === 'camera') {
            document.getElementById('cameraMode' + id).style.display = 'block';
            document.getElementById('cameraInput' + id).value = "";
            document.getElementById('cameraInput' + id).click();
        } else {
            document.getElementById('cameraMode' + id).style.display = 'none';
            document.getElementById('pickerMode' + id).style.display = 'block';
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        let id = "{{ $getId() }}";
        let cameraInput = document.getElementById('cameraInput' + id);
        let colorPreview = document.getElementById('colorPreview' + id);
        let colorPicker = document.getElementById('colorPicker');
        let canvas = document.getElementById('canvas' + id);

        /**
         * Met à jour l'affichage et la valeur de la couleur sélectionnée
         */
        function updateColor(value) {
            colorPreview.style.backgroundColor = value;
            colorPicker.value = value;
        @this.set('{{ $getStatePath() }}', value); // Met à jour Filament
        }

        /**
         * Gestion de la capture de couleur à partir de l'image prise avec la caméra
         */
        cameraInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            const img = new Image();
            img.src = URL.createObjectURL(file);
            img.onload = function () {
                const ctx = canvas.getContext('2d');
                if (!ctx) {
                    console.error("Impossible d'obtenir le contexte du canvas.");
                    return;
                }

                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0, img.width, img.height);

                // Capture la couleur au centre de l'image
                const pixel = ctx.getImageData(img.width / 2, img.height / 2, 1, 1).data;
                const color = rgbToHex(pixel[0], pixel[1], pixel[2]);

                updateColor(color);
            };
        });

        /**
         * Convertit une couleur RGB en code hexadécimal
         */
        function rgbToHex(r, g, b) {
            return "#" + [r, g, b].map(x => {
                const hex = x.toString(16);
                return hex.length === 1 ? "0" + hex : hex;
            }).join("");
        }
    });
</script>
