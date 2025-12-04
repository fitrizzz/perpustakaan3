<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner</title>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        video { width: 600px; height: 400px; border: 1px solid gray; }
        select { margin-top: 10px; padding: 5px; }
    </style>
</head>
<body>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        video { width: 100%; max-width: 600px; height: auto; border: 1px solid gray; }
        select, button { margin-top: 10px; padding: 8px; font-size: 16px; }
    </style>
</head>
<body>

<?php
include "conn.php"; // Pastikan ada koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qr_data = $_POST['qr_data'];  // Ambil hasil QR Code dari JavaScript

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO scan_results (qr_data) VALUES (?)");
    $stmt->bind_param("s", $qr_data);
    
    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Gagal menyimpan data!";
    }

    $stmt->close();
}
?>


</body>
</html>

<!-- 
    <h1>Scan Barcode</h1>

    <video id="video"></video>
    
    <br>
    <label for="sourceSelect">Pilih Kamera:</label>
    <select id="sourceSelect"></select>

    <br><br>
    <button id="startButton">Mulai Scan</button>
    <button id="resetButton">Reset</button>

    <h3>Hasil Scan:</h3>
    <pre><code id="result">Belum ada hasil</code></pre>

    <script>
        window.addEventListener('load', async function () {
            let selectedDeviceId;
            const codeReader = new ZXing.BrowserBarcodeReader();
            console.log('ZXing code reader initialized');

            try {
                const videoInputDevices = await codeReader.getVideoInputDevices();
                const sourceSelect = document.getElementById('sourceSelect');

                if (videoInputDevices.length === 0) {
                    alert("Tidak ada kamera terdeteksi!");
                    return;
                }

                // Tambahkan kamera ke dropdown dengan nama yang lebih jelas
                videoInputDevices.forEach((device) => {
                    const option = document.createElement('option');

                    if (device.label.includes("Infinix NOTE 12")) {
                        option.text = "Kamera HP Infinix";
                    } else if (device.label.includes("HP True Vision")) {
                        option.text = "Kamera Laptop";
                    } else {
                        option.text = device.label; // Nama asli jika tidak ada penggantian
                    }

                    option.value = device.deviceId;
                    sourceSelect.appendChild(option);
                });

                // Pilih kamera pertama sebagai default
                selectedDeviceId = videoInputDevices[0].deviceId;

                // Ubah kamera jika pengguna memilih yang lain
                sourceSelect.addEventListener('change', () => {
                    selectedDeviceId = sourceSelect.value;
                });

                // Mulai scan ketika tombol ditekan
                document.getElementById('startButton').addEventListener('click', async () => {
                    try {
                        const result = await codeReader.decodeOnceFromVideoDevice(selectedDeviceId, 'video');
                        console.log(result.text);
                        document.getElementById('result').textContent = result.text;
                    } catch (err) {
                        console.error(err);
                        document.getElementById('result').textContent = "Gagal membaca barcode!";
                    }
                });

                // Reset scanner
                document.getElementById('resetButton').addEventListener('click', () => {
                    document.getElementById('result').textContent = 'Belum ada hasil';
                    codeReader.reset();
                    console.log('Reset scanner.');
                });

            } catch (err) {
                console.error("Error mendapatkan kamera: ", err);
            }
        });
    </script> -->

</body>
</html>
