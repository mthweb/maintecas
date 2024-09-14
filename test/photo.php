<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importer ou Prendre une Photo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            padding-top: 50px;
        }
        .upload-container {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .upload-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .custom-file-input {
            margin-bottom: 20px;
        }
        .preview {
            margin-top: 20px;
            display: none;
        }
        .preview img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 15px;
        }
        #take-photo {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="upload-container">
    <h2>Importer une image ou Prendre une photo</h2>
    
    <!-- Importer une image -->
    <div class="mb-3">
        <label for="fileInput" class="form-label">Importer une image</label>
        <input type="file" class="form-control" id="fileInput" accept="image/*">
    </div>
    
    <div class="preview">
        <h5>Prévisualisation :</h5>
        <img id="imagePreview" src="" alt="Prévisualisation">
    </div>

    <!-- Prendre une photo -->
    <div class="mb-3">
        <button class="btn btn-primary" id="openCamera">Prendre une photo</button>
        <video id="camera" width="100%" height="auto" autoplay></video>
        <button class="btn btn-success" id="takePhoto" style="display:none;">Capturer</button>
    </div>

    <canvas id="take-photo" width="500" height="400"></canvas>

    <button class="btn btn-secondary mt-3" id="uploadImage">Téléverser l'image</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fonction de prévisualisation de l'image
    $('#fileInput').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $('#imagePreview').attr('src', event.target.result);
                $('.preview').show();
            }
            reader.readAsDataURL(file);
        }
    });

    // Ouverture de la caméra pour prendre une photo
    $('#openCamera').click(function() {
        const video = document.getElementById('camera');
        const constraints = { video: true };

        navigator.mediaDevices.getUserMedia(constraints)
            .then(function(stream) {
                video.srcObject = stream;
                $('#takePhoto').show();
            })
            .catch(function(err) {
                console.log("Erreur d'accès à la caméra : " + err);
            });
    });

    // Capturer la photo
    $('#takePhoto').click(function() {
        const video = document.getElementById('camera');
        const canvas = document.getElementById('take-photo');
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        const dataURL = canvas.toDataURL('image/png');
        $('#imagePreview').attr('src', dataURL);
        $('.preview').show();
        $('#camera').hide();
    });

    
    $('#uploadImage').click(function() {
    const fileInput = $('#fileInput')[0];
    const file = fileInput.files[0];
    const canvas = document.getElementById('take-photo');
    const imageData = canvas.toDataURL('image/png'); // Image capturée

    let formData = new FormData();
    if (file) {
        // Image importée
        formData.append('image', file);
    } else {
        // Image capturée
        formData.append('imageData', imageData);
    }

    $.ajax({
        url: 'upload_image.php', // Le script PHP pour gérer l'upload
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            alert('Image téléversée avec succès !');
        },
        error: function() {
            alert('Erreur lors du téléversement de l\'image.');
        }
    });
});

</script>

</body>
</html>
