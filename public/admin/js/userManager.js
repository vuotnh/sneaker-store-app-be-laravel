
// $(document).ready(function () { });
async function getUserDetail() {
    try {
        const userId = window.location.href.split('/').reverse()[1];
        const userDetailRes = await axiosInstance({
            method: 'GET',
            url: `http://localhost:8082/user/detailInfo/${userId}`,
            headers: {
                'Content-Type': 'application/json',
            }
        })

        const firstNameTag = document.querySelector("form div input#firstName");
        const lastNameTag = document.querySelector("form div input#lastName");
        const phoneTag = document.querySelector("form div input#phone");
        const emailTag = document.querySelector("form div input#email");
        const avatarTag = document.querySelector("div.avatar-group img.img-preview");
        if (userDetailRes.status === 200) {
            const userData = userDetailRes.data?.data;
            console.log(userData)
            firstNameTag.value = userData.firstName;
            lastNameTag.value = userData.lastName;
            phoneTag.value = userData.phone;
            emailTag.value = userData.email;
            if (userData.avatar.length > 0) {
                avatarTag.src = `http://localhost:8082/storage/images/${userData?.avatar[0]?.name}`;
            }
        }
    } catch (err) {
        console.log(err);
    }
}



function validateOnSubmit(form, fields) {
    form.addEventListener("submit", async function submitLogin(event) {
        event.preventDefault();
        let updatedData = {};
        fields.forEach((field) => {
            const input = document.querySelector(`#${field}`);
            updatedData[field] = input.value.trim();
        })
        const avatar = document.querySelector('input.attachment_upload');
        if (avatar.value !== '') {
            const newAvatarFile = avatar.files[0];
            const formData = new FormData();
            formData.append('file', newAvatarFile);
            const uploadedAvatar = await axiosInstance({
                method: 'POST',
                url: 'http://localhost:8082/file/upload',
                data: formData,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            if (uploadedAvatar.status === 200) {
                updatedData['avatar_id'] = uploadedAvatar.data?.file?.id;
            }
        }

        const userId = window.location.href.split('/').reverse()[1];

        const updatedUser = await axiosInstance({
            method: 'PATCH',
            url: `http://localhost:8082/user/updateInfo/${userId}`,
            data: updatedData,
            headers: {
                'Content-Type': 'application/json',
            }
        })
        if (updatedUser.status === 200) {
            form.removeEventListener("submit", submitLogin);
            window.location.assign('/admin/user');
        }
    })
}


function onSubmitEdit() {
    const form = document.querySelector('.editForm');
    if (form) {
        const fields = ['firstName', 'lastName', 'phone', 'email'];
        validateOnSubmit(form, fields);
    }
}

(async () => {
    await getUserDetail();
})()





