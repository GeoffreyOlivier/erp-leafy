<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div>
        <!-- Boutons de sélection du mode -->
        <div style="display: flex; gap: 10px;">
            <button type="button" onclick="toggleMode('camera', '{{ $getId() }}')"
                    style="padding: 5px 10px; background-color: #ffffff; color: #000000; border-radius: 10px;">
                Photo
            </button>
            <div id="pickerMode{{ $getId() }}">
                <input type="color" id="colorPicker{{ $getId() }}"
                       value="{{ $getState() ?? '#ffffff' }}"
                       style="width: 50px; height: 50px; border: none; border-radius:10px; cursor: pointer;">
            </div>
{{--            <button type="button" onclick="toggleMode('picker', '{{ $getId() }}')"--}}
{{--                    style="padding: 5px 10px; background-color: green; color: white; border-radius: 5px;">--}}
{{--                🎨 Sélectionner une couleurs--}}
{{--            </button>--}}
        </div>



        <!-- Mode Appareil Photo -->
        <div id="cameraMode{{ $getId() }}" style="display: none;">
            <input type="file" id="cameraInput{{ $getId() }}" accept="image/*" capture="environment">
            <canvas id="canvas{{ $getId() }}" style="display: none;"></canvas>
        </div>


        <h4>Couleur choisi : </h4>
        <!-- Prévisualisation de la couleur -->
        <div id="colorPreview{{ $getId() }}"
             style="width: 50px; height: 50px;
             border-radius: 50%; border: 1px solid #333;
             margin-top: 8px;
             background-color: {{ $getState() ?? '#ffffff' }};">
        </div>

        <!-- Mode Color Picker -->

    </div>
</x-dynamic-component>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let id = "{{ $getId() }}";
        let colorPicker = document.getElementById('colorPicker' + id);
        let cameraInput = document.getElementById('cameraInput' + id);
        let colorPreview = document.getElementById('colorPreview' + id);
        let canvas = document.getElementById('canvas' + id);

        function updateColor(value) {
            colorPreview.style.backgroundColor = value;
            colorPicker.value = value;
        @this.set('{{ $getStatePath() }}', value); // Met à jour Filament
        }

        // Color Picker Mode
        colorPicker.addEventListener('input', function () {
            updateColor(this.value);
        });

        // Camera Mode - Capture couleur au centre de l'image
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

                // Prendre la couleur au centre de l'image
                const pixel = ctx.getImageData(img.width / 2, img.height / 2, 1, 1).data;
                const color = rgbToHex(pixel[0], pixel[1], pixel[2]);

                updateColor(color);
            };
        });
    });

    function rgbToHex(r, g, b) {
        return "#" + [r, g, b].map(x => {
            const hex = x.toString(16);
            return hex.length === 1 ? "0" + hex : hex;
        }).join("");
    }

    function toggleMode(mode, id) {
        if (mode === 'camera') {
            document.getElementById('cameraMode' + id).style.display = 'block';
            // document.getElementById('pickerMode' + id).style.display = 'none';
            document.getElementById('cameraInput' + id).value = "";

            document.getElementById('cameraInput' + id).click();
        } else {
            document.getElementById('cameraMode' + id).style.display = 'none';
            document.getElementById('pickerMode' + id).style.display = 'block';
        }
    }
</script>
