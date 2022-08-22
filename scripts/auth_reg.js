//Функция, авторизирует (регистрирует и авторизует) пользователя.
//Принимает объект formData, путь к скрипту обработчику.
//Отправляет ajax запрос, выводит предупреждение в случае
//не прохождения валидации.
function submit(formData, path) {
    $.ajax({
        url: path,
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data['result']) {
                window.location.href = 'views/user.php';
            } else {
                let arr = data['errors'];
                alert(arr);
                arr.forEach(function (data) {
                    let field = Object.getOwnPropertyNames(data);
                    let value = data[field];
                    let div = $(`#${field[0]}`);
                    div.addClass('has-danger');
                    div.next().html(value).css("color", "red").css("margin", "0px 7px");
                });
            }
        }
    });
}
//fetch почему-то в данном случае ругается на неожиданный
//конец ввода JSON при отправке.
// async function submit(formData, path) {
//
//     let response = await fetch(path, {
//         method: 'POST',
//         body: formData
//     });
//
//     if (response.ok) {
//         console.log(response.text);
//         let data = await response.json();
//         if (data['result']) {
//             window.location.href = 'views/user.php';
//         } else {
//             let arr = data['errors'];
//             alert(arr);
//             arr.forEach(function (data) {
//                 let field = Object.getOwnPropertyNames(data);
//                 let value = data[field];
//                 let div = $(`#${field[0]}`);
//                 div.addClass('has-danger');
//                 div.next().html(value).css("color", "red").css("margin", "0px 7px");
//             });
//         }
//     } else {
//         alert("Ошибка HTTP: " + response.status);
//     }
// }

$("#registration").submit(function(event){
    event.preventDefault();
    let formData = new FormData(this);

    submit(formData, 'controllers/regForm.php');
});
$("#authorization").submit(function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    submit(formData, 'controllers/authForm.php');
});

$(".btn-reg").click(function (){
    $("#auth").addClass("hidden");
    $("#reg").removeClass("hidden");
});
$(".btn-auth").click(function (){
    $("#reg").addClass("hidden");
    $("#auth").removeClass("hidden");
});

$("input[type='text'], input[type='email'], input[type='password']").bind('focus', function(){
    $(this).removeClass('has-danger');
    $(this).next().empty();
    $("#result").next().empty();
});