// $(document).ready(function () {});

async function getListCategoryData() {
    const res = await axiosInstance({
        method: 'GET',
        url: 'http://localhost:8082/category/list',
        headers: {
            'Content-Type': 'application/json',
        }
    })
    const tableBody = document.getElementById('table-body');
    tableBody.innerHTML = '';
    res?.data?.data?.forEach((row, index) => {
        let newRow = document.createElement("tr");
        let col1 = document.createElement('td');
        col1.innerText = index + 1;
        newRow.appendChild(col1);

        let col2 = document.createElement('td');
        col2.innerText = row.name || '';
        newRow.appendChild(col2);

        let col4 = document.createElement('td');
        col4.innerText = row.code || '';
        newRow.appendChild(col4);

        let col3 = document.createElement('td');
        let editButtonEl = document.createElement("button");
        let deleteButtonEl = document.createElement("button");

        editButtonEl.classList.add("btn")
        editButtonEl.classList.add("btn-primary")
        editButtonEl.innerHTML = `<i class="far fa-eye"></i>`;
        editButtonEl.style.marginRight = '5px';
        editButtonEl.addEventListener('click', function (event) {
            window.location.assign(`/admin/category/${row.id}/edit`)
        })

        deleteButtonEl.classList.add("btn")
        deleteButtonEl.classList.add("btn-danger")
        deleteButtonEl.innerHTML = `<i class="far fa-trash-alt"></i>`;
        deleteButtonEl.addEventListener('click', async function (event) {
            await onDeleteCategory(row.id);
        })

        col3.appendChild(editButtonEl);
        col3.appendChild(deleteButtonEl);


        newRow.appendChild(col3);

        tableBody.appendChild(newRow);
    })
}

async function getCategoryDetail() {
    try {
        const categoryId = window.location.href.split('/').reverse()[1];
        const categoryDetailRes = await axiosInstance({
            method: 'GET',
            url: `http://localhost:8082/category/show/${categoryId}`,
            headers: {
                'Content-Type': 'application/json',
            }
        })

        const nameTag = document.querySelector("input#name");
        const codeTag = document.querySelector("input#code");

        if (categoryDetailRes.status === 200) {
            const categoryData = categoryDetailRes.data?.data;
            nameTag.value = categoryData.name;
            codeTag.value = categoryData.code;
        }
    } catch (err) {
        console.log(err);
    }
}

(async () => {
    if (window.location.pathname === '/admin/category') {
        await getListCategoryData();
    }

    if (window.location.pathname.includes('edit')) {
        await getCategoryDetail();
    }
})()

async function onSubmit() {
    const form = document.querySelector('.editForm');
    form.addEventListener("submit", async function createUpdateCategory(event) {
        event.preventDefault();
        let submitData = {};
        submitData['name'] = document.querySelector('#name').value.trim();
        submitData['code'] = document.querySelector('#code').value.trim();
        const action = window.location.href.split('/').reverse()[0];
    
        if (action === 'add') {
            const addNewCategory = await axiosInstance({
                method: 'POST',
                url: `http://localhost:8082/category/store`,
                data: submitData,
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            console.log(addNewCategory);
            if (addNewCategory.status === 201) {
                window.location.assign('/admin/category');
            }
        }
    
        if (action === 'edit') {
            const categoryId = window.location.href.split('/').reverse()[1];
            const updatedCategory = await axiosInstance({
                method: 'PATCH',
                url: `http://localhost:8082/category/update/${categoryId}`,
                data: submitData,
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            if (updatedCategory.status === 200) {
                window.location.assign('/admin/category');
            }
        }

        // clear event listener
        form.removeEventListener("submit", createUpdateCategory)
    });
}


async function onDeleteCategory(categoryId) {
    try {
        const res = await axiosInstance({
            method: 'DELETE',
            url: `http://localhost:8082/category/delete/${categoryId}`,
            headers: {
                'Content-Type': 'application/json',
            }
        })
        if (res.status === 204) {
            await getListCategoryData();
        }
    } catch (err) {
        console.log(err);
    }

}
