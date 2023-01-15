const imageInput = document.querySelector("#image-input");


imageInput.addEventListener("change", (e) => {
  uploadImage(imageInput.files[0]);
});

async function uploadImage(file) {
  if (!["image/png", "image/jpeg"].includes(file.type)) {
    console.log("Only png or jpeg required");
    return;
  }

  if (file.size > 10 * 1024 * 1024) {
    console.log("File is greater than 2MB");
    return;
  }

  const formData = new FormData();
  formData.append("image_file", file);

  const response = await fetch(`${window.location.href}php/upload.php`, {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  console.log(data);
}
