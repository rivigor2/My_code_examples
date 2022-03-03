jQuery(function($){

    // показать html форму при нажатии кнопки «создать товар»
    $(document).on('click', '.create-comment-button', function() {
        <!-- html форма «Создание комментария» -->
        var create_comment_html=`
            <div class="contact-form">
                <div class="container">
                    <form id="create-comment-form" action="" method="post">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <h1>Написать Комментарий</h1>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 right">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Ваше Имя" name="user_name" required />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" placeholder="YourEmail@email.com" name="email" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Заголовок" name="title" required />
                                </div>
                                <div class="form-group">
                                    <textarea name="comment" class="form-control form-control-lg"></textarea>
                                </div>
                                <input type="submit" class="btn btn-secondary btn-block">
                            </div>
                        </div>
                    </form>
                </div>
            </div>`;

        // вставка html в «page-content» нашего приложения
        $("#page-content").html(create_comment_html);
    });

    // будет работать, если создана форма товара
    $(document).on('submit', '#create-comment-form', function(){
        // получение данных формы
        var form_data=JSON.stringify($(this).serializeObject());

        // отправка данных формы в API
        $.ajax({
            url: REST_API_URL + "comment/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                // продукт был создан, вернуться к списку продуктов
                showComments();
            },
            error: function(xhr, resp, text) {
                // вывести ошибку в консоль
                console.log(xhr, resp, text);
            }
        });

        return false;
    });


});