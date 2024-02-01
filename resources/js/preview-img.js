const previewImgElem = document.getElementById('img_preview')

const imgInput = document.getElementById('cover_img')

if(imgInput) {
    imgInput.addEventListener('change', function() {
        const image = this.files[0];
        
        if(image) {
            const reader = new FileReader();
            reader.addEventListener('load', function(){
                previewImgElem.src = reader.result
            })
            reader.readAsDataURL(image);
        }
    })
}