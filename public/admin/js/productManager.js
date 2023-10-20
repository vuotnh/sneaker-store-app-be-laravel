function clickButton() {
    document.querySelector("input.newFileField").click();
}

function addNewFile(input) {
    const [file] = input.files;
    const newPreviewFileImg = document.createElement("img");
    newPreviewFileImg.alt = 1;
    newPreviewFileImg.classList.add("image-card");
    const reader = new FileReader();

    reader.onload = (e) => {
        newPreviewFileImg.src = e.target.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    }

    const imageContainer = document.createElement("div");
    imageContainer.classList.add("image-container");
    imageContainer.innerHTML = `
        <div class="overlay">
          <div class="icon" title="User Profile"  onclick="removeThis(this)">
            <i class="fa-solid fa-xmark"></i>
          </div>
        </div>
    `;
    imageContainer.appendChild(newPreviewFileImg);
    document.querySelector("div.list-image").prepend(imageContainer);
}


function removeThis(event) {
    document.querySelector("div.list-image").removeChild(event.parentNode.parentNode);
}

async function getAllProduct() {
    const res = await axiosInstance({
        method: 'GET',
        url: 'http://localhost:8082/product/list',
        headers: {
            'Content-Type': 'application/json',
        }
    })
}

async function getAllCategory() {
    const listCategories = await axiosInstance({
        method: 'GET',
        url: 'http://localhost:8082/category/list',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    let categoryData;
    const categorySelection = document.querySelector("select.category-select");
    categorySelection.innerHTML = "<option value='0' selected>Select category for product</option>"
    if (listCategories.status === 200) {
        categoryData = listCategories.data?.data;
    }
    if (categoryData) {
        categoryData.forEach((item) => {
            const newOptions = document.createElement("option")
            newOptions.value = item.id;
            newOptions.innerText = item.name;
            categorySelection.appendChild(newOptions);
        })
    }
}

async function readFileFromDataURL(dataURL, fileName) {
    const fileBlob = await fetch (dataURL);
    const file = await fileBlob.blob();
    const lastFile = new File([file], fileName, { type: file.type })
    return lastFile;
}

async function onSubmitNewProduct() {
    const form = document.querySelector('.formProduct');
    form.addEventListener("submit", async function createMewProduct(event) {
        event.preventDefault();
        let submitData = {};
        submitData["name"] = document.querySelector("input#productName").value.trim();
        submitData["description"] = document.querySelector("textarea#summernote").value.trim();
        submitData["price"] = document.querySelector("input#productPrice").value.trim();

        const selecteCategory = document.querySelector("select.category-select");
        submitData["category_id"] = selecteCategory[selecteCategory.selectedIndex].value;


        const listImageEl = document.querySelectorAll("div.list-image div.image-container img");
        const formData = new FormData();

        for (let i = 0; i < listImageEl.length; i += 1) {
            const imageEl = listImageEl[i];
            if (imageEl.src.includes('data:image/')) {
                const dataBlob = imageEl.src;
                const fileMime = dataBlob.substring(dataBlob.indexOf(":") + 1, dataBlob.indexOf(";"));
                const fileExtension = fileMime.split('/')[1];
                let fileImg = await readFileFromDataURL(dataBlob, `${i}.${fileExtension}`);

                formData.append('file[]', fileImg);
            }
        }
        formData.append('name', submitData.name);
        formData.append('description', submitData.description);
        formData.append('price', submitData.price);
        formData.append('category_id', submitData.category_id);

        const addNewProduct = await axiosInstance({
            method: 'POST',
            url: `http://localhost:8082/product/store`,
            data: formData,
            headers: {
                'Content-Type': 'multipart/form-data',
            }
        });

        // clear event listener
        form.removeEventListener("submit", createMewProduct);
    })
}

(async () => {
    if (window.location.pathname === '/admin/product/add' || window.location.pathname.includes('edit')) {
        await getAllCategory();
    }

    if (window.location.pathname === '/admin/product') {
        await getAllProduct();
    }
})();

function onFocusPreviewImg(event) {
    const divParent = event.target.parentNode;
    $(divParent.className).siblings(divParent.parentElement.className).removeClass('image-preview-focus');
    if (!divParent.classList.contains('image-preview-focus')) {
        divParent.classList.add('image-preview-focus');
    }
    const imagePreviewEl = document.querySelector(".image-preview");
    imagePreviewEl.src = event.target.src;
}