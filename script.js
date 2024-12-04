document.getElementById('postButton').addEventListener('click', async () => {
    const title = document.getElementById('title').value;
    const breed = document.getElementById('breed').value;
    const comment = document.getElementById('comment').value;

    if (!title || !breed || !comment) {
        alert('全てのフィールドを入力してください');
        return;
    }

    const formData = new FormData();
    formData.append('title', title);
    formData.append('breed', breed);
    formData.append('comment', comment);

    try {
        const response = await fetch('post.php', {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) {
            const errorText = await response.text();
            alert(`エラーが発生しました: ${errorText}`);
            return;
        }

        const result = await response.json();
        if (result.status === 'success') {
            document.getElementById('postList').insertAdjacentHTML('afterbegin', result.newPost);
            document.getElementById('postForm').reset();
        } else {
            alert('投稿に失敗しました');
        }
    } catch (error) {
        console.error(error);
        alert('ネットワークエラーが発生しました');
    }
});