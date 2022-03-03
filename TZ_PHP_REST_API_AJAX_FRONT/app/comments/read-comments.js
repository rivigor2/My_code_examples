$(function($){
    // показать список комментариев при первой загрузке
    showComments();
});

// функция для показа списка товаров
function showComments(){
    // получить список товаров из API
    $.getJSON(REST_API_URL + "comment/read.php", function(data){
        var read_comments_html=`
        <!-- при нажатии загружается форма создания комментария -->
        <div id='create-comment' class='btn btn-primary pull-right m-b-15px create-comment-button'>Добавить комментарий</div>
        <div class="comment_content">`;
        // перебор списка возвращаемых данных
            $.each(data, function(key, val) {
            // создание новой строки таблицы для каждой записи
            read_comments_html+=`
                <div class = "comment_item">
                    <div>` + val.title + ` </div>
                    <div>` + val.user_name + ` </div>
                    <div>` + val.email + ` </div>
                    <div>` + val.created + ` </div>
                    <div>` + val.comment + ` </div>
                </div>`;
            });
        read_comments_html+=`</div>`;
        // вставка в 'page-content' нашего приложения
        $("#page-content").html(read_comments_html);
    });
}