{{--<div>--}}

{{--    <!-- Boutons de sélection du mode -->--}}
{{--    <div style="margin-bottom: 10px;">--}}
{{--        <button type="button" onclick="toggleMode('camera')" id="cameraBtn" style="padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px;">--}}
{{--            📸 Prendre une photo--}}
{{--        </button>--}}
{{--        <button type="button" onclick="toggleMode('picker')" id="pickerBtn" style="padding: 10px; background: #28a745; color: white; border: none; border-radius: 5px;">--}}
{{--            🎨 Sélectionner une couleur--}}
{{--        </button>--}}
{{--    </div>--}}

{{--    <!-- Mode Appareil Photo -->--}}
{{--    <div id="cameraMode">--}}
{{--        <input type="file" id="cameraInput" accept="image/*" capture="environment" style="display: none;">--}}
{{--        <canvas id="canvas" style="display: none;"></canvas>--}}
{{--        <div id="colorPreview" style="width: 50px; height: 50px; border-radius: 50%; border: 1px solid #000; margin-top: 10px; background-color: {{ $color ?? '#ffffff' }};">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Mode Color Picker -->--}}
{{--    <div id="pickerMode" style="display: none;">--}}
{{--        <input type="color" id="colorPicker" value="{{ $color ?? '#ffffff' }}" style="width: 100%; height: 40px; border: none;">--}}
{{--    </div>--}}

{{--    <!-- Champ hidden pour stocker la couleur -->--}}
{{--    <input style="color: #0000cc" id="color" name="color" value="" >--}}
{{--    <script src="{{ asset('vendor/livewire/livewire.js') }}" defer></script>--}}

{{--    <script>--}}

{{--        function toggleMode(mode) {--}}
{{--            if (mode === 'camera') {--}}
{{--                document.getElementById('cameraMode').style.display = 'block';--}}
{{--                document.getElementById('pickerMode').style.display = 'none';--}}

{{--                // Ouvrir l'appareil photo automatiquement--}}
{{--                document.getElementById('cameraInput').click();--}}
{{--            } else {--}}
{{--                document.getElementById('cameraMode').style.display = 'none';--}}
{{--                document.getElementById('pickerMode').style.display = 'block';--}}
{{--            }--}}
{{--        }--}}

{{--        document.getElementById('cameraInput').addEventListener('change', function (event) {--}}
{{--            const file = event.target.files[0];--}}
{{--            if (!file) return;--}}

{{--            const img = new Image();--}}
{{--            img.src = URL.createObjectURL(file);--}}
{{--            img.onload = function () {--}}
{{--                const canvas = document.getElementById('canvas');--}}
{{--                const ctx = canvas.getContext('2d');--}}
{{--                canvas.width = img.width;--}}
{{--                canvas.height = img.height;--}}
{{--                ctx.drawImage(img, 0, 0, img.width, img.height);--}}

{{--                // Récupérer la couleur au centre de l'image--}}
{{--                const pixel = ctx.getImageData(img.width / 2, img.height / 2, 1, 1).data;--}}
{{--                const color = `rgb(${pixel[0]}, ${pixel[1]}, ${pixel[2]})`;--}}

{{--                // Afficher la couleur--}}
{{--                document.getElementById('colorPreview').style.backgroundColor = color;--}}
{{--                document.getElementById('color').value = color;--}}

{{--                // Mettre à jour Livewire--}}
{{--                console.log(color)--}}
{{--                // Livewire.emit('updateColor', color);--}}

{{--            };--}}
{{--        });--}}

{{--        document.getElementById('colorPicker').addEventListener('input', function (event) {--}}
{{--            const color = event.target.value;--}}
{{--            document.getElementById('colorPreview').style.backgroundColor = color;--}}
{{--            document.getElementById('colorHidden').value = color;--}}

{{--            console.log(color) // #c01616--}}
{{--        });--}}
{{--    </script>--}}
{{--</div>--}}
