$(document).ready(function () {
    async function getListUserData() {
        const res = await axiosInstance({
            method: 'GET',
            url: 'http://localhost:8082/user/listUser',
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
            col2.innerText = `${row.firstName} ${row.lastName}`;
            newRow.appendChild(col2);

            let col3 = document.createElement('td');
            col3.innerText = row.email || '';
            newRow.appendChild(col3);

            let col4 = document.createElement('td');
            col4.innerText = row.phone || '';
            newRow.appendChild(col4);

            let col5 = document.createElement('td');
            let editButtonEl = document.createElement("button");
            let deleteButtonEl = document.createElement("button");

            editButtonEl.classList.add("btn")
            editButtonEl.classList.add("btn-primary")
            editButtonEl.innerHTML = `<i class="far fa-eye"></i>`;
            editButtonEl.style.marginRight = '5px';
            editButtonEl.addEventListener('click', function (event) {
                window.location.assign(`/admin/user/${row.id}/edit`)
            })

            deleteButtonEl.classList.add("btn")
            deleteButtonEl.classList.add("btn-danger")
            deleteButtonEl.innerHTML = `<i class="far fa-trash-alt"></i>`;
            deleteButtonEl.addEventListener('click', async function deleteUser(event) {
                await onDeleteUser(row.id);
                deleteButtonEl.removeEventListener('click', deleteUser);
            })

            col5.appendChild(editButtonEl);
            col5.appendChild(deleteButtonEl);


            newRow.appendChild(col5);

            tableBody.appendChild(newRow);
        })
    }

    async function onDeleteUser(userId) {
        try {
            const res = await axiosInstance({
                method: 'DELETE',
                url: `http://localhost:8082/user/deleteUser/${userId}`,
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            if (res.status === 204) {
                await getListUserData();
            }
        } catch (err) {
            console.log(err);
        }

    }

    (async () => {
        await getListUserData();
    })()
});
