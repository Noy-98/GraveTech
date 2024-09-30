document.getElementById('uploadButton').addEventListener('click', function() {
    document.getElementById('profilePictureInput').click();
});

document.getElementById('profilePictureInput').addEventListener('change', function() {
    document.getElementById('uploadForm').submit();
});