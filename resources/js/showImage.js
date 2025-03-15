let imageInput = document.querySelector('#imageInput')

imageInput.addEventListener('change', showImage);

function showImage(event) {
    const imagePreview = document.querySelector('#imagePreview')
    const file = event.target.files[0]

    console.log(file)

    if(file) {
        const reader = new FileReader()

        reader.onload = function(e) {
            imagePreview.src = e.target.result
            imagePreview.style.display = 'block'
        }

        reader.readAsDataURL(file);
    } else {
        imagePreview.src = ''
        imagePreview.style.display = 'none'
    }
}