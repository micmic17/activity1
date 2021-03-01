let fileButton = document.getElementById('my_file');
let uploadButton = document.getElementById('upload_logo');
let file_name = document.getElementById('file_name')
let img = document.getElementsByClassName('card-img-top')[0];

uploadButton.onclick = () => {
  fileButton.click();
  fileButton.addEventListener('change', (event) => {
    let filename = fileButton.value.split("\\");

    img.src = URL.createObjectURL(event.target.files[0]);;
    file_name.innerHTML = filename[filename.length - 1];
  });
};