$("#exit-btn").submit(function(event){
    event.preventDefault();
    let formData = new FormData(this);

    if (confirm('Точно хотите выйти?')) {
        submit(formData, '../controllers/exitBtn.php');
    }
});

//Функция, запрос для удаления данных пользователя из сессии.
//Принимает объект formData, путь к скрипту обработчику.
//Отправляет ajax запрос, в случае успешного удаления сессии переадресация страницы.
async function submit(formData, path) {

    let response = await fetch(path, {
        method: 'POST',
        body: formData
    });

    if (response.ok) {
        let data = await response.json();
        if (data['result']) {
            window.location.href = '../index.php';
        }
    } else {
        alert("Ошибка HTTP: " + response.status);
    }
}