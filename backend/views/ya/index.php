<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {

        $('#myForm').submit(function() {
            var key = 'trnsl.1.1.20140308T143234Z.59fae7871cc77928.599b5f35451d772b532de617643d40ae0c7fc9f5';
            var text = $('input[name=in]').val();
            var formData = $(this).serialize();
            var detectUrl = 'https://translate.yandex.net/api/v1.5/tr.json/detect?key=' + key + '&text=' + text;
            $.post(detectUrl, formData, processDetect);
            function processDetect(data) {
                lang = data.lang;
                $('textarea[name=out]').val(lang);
            }
            ;
            var lang = $('textarea[name=out]').val();
            var url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20140308T143234Z.59fae7871cc77928.599b5f35451d772b532de617643d40ae0c7fc9f5&text=' + text + '&lang=' + lang;
            $.post(url, formData, processResponse);
            function processResponse(data) {
                var text = data.text;
                $('textarea[name=out]').val(text);
            };
            return false;
        });
    });
</script>
<div id="posts">

</div>
<div class="form-inline-block" style="text-align: center;">

    <p>Переводчик</p>
    <form id="myForm" class="form-group">
        <a href="#">загрузиться</a>
        <input name="in">
        <input type="submit" value="Translate >" name="submit"><br>
        <textarea name="out"></textarea>
    </form>
    <?PHP
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

    /**
     * START FORM
     */
//    $form = ActiveForm::begin([
//                'id' => 'translate',
//                'errorCssClass' => 'has-error has-feedback',
//                'method' => 'POST',
//                    ]
//    );
//
//    echo Html::input('input', 'input') . "<br/";
//    echo Html::input('input', 'input') . "<br/";
//    echo Html::submitInput('РћС‚РїСЂР°РІРёС‚СЊ', ['name' => 'submit', 'style' => 'background:red;']);
//    echo Html::input('output', 'output');
//    /**
//     * END FORM
//     */
//    ActiveForm::end();
//    
    ?>
</div>
