document.addEventListener('DOMContentLoaded', () => {

    const ajaxSend = async (formData) => {
        const fetchResp = await fetch('/src/send_request.php', {
            method: 'POST',
            body: formData
        });
        if (!fetchResp.ok) {
            throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
        }
        return await fetchResp.text();
    };
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            ajaxSend(formData)
                .then((response) => {
                    console.log(response);
                    if(response !== ''){
                        document.querySelector('.form__controls').innerHTML += `<a href="${response}" class="card__button  card__button--enter btn btn--secondary">Войти в конференцию</a>`;
                        document.querySelector('.card__form').innerHTML += `<div class = "form__url"><label for = "url"><h3>Ссылка для входа</h3></label>
                                                                    <input required type = "text" value = "${response}" class="card__input" id = "url"></div>`;
                    }
                    form.reset(); // очищаем поля формы 
                })
                .catch((err) => console.error(err))
        });
    });

});
