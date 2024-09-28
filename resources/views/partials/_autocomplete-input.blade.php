<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>jQuery UI</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/sunny/jquery-ui.css">
    <script type="text/javascript">
        $(function() {

            var flowers = ["Астра", "Нарцисс", "Роза", "Пион", "Примула",
                "Подснежник", "Мак", "Первоцвет", "Петуния", "Фиалка"];

            $('#acInput').autocomplete({
                source: flowers
            })
        });
    </script>
</head>
<body>
<form>
    <div class="ui-widget">
        <label for="acInput">Выберите название цветка: </label>
        <input id="acInput"/>
    </div>
</form>
</body>
</html>
