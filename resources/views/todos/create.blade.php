<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/ja.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js"></script>
</head>

<body>

    <div class="mt-5 px-5">

        <div class="mb-5">

            <div>
                <h1 class="text-center mb-5">新しいタスクを追加</h1>
            </div>

            <form action="{{ route('todos.store') }}" method="post">
                {{ csrf_field() }}
                <div>
                    <div class="col-lg-6 mx-auto d-block">
                        <label for="" class="mb-4">タスクを入力してください</label>
                        <input type="text" class="form-control mb-4" name="newTodo">
                    </div>
                    <!-- エラー -->
                    @if ($errors->has('newTodo'))
                    <p class="alert alert-danger">{{ $errors->first('newTodo') }}</p>
                    @endif

                    <div class="col-lg-6 mx-auto d-block">
                        <label for="" class="mb-4">日時を選択してください</label>
                        <input type="text" class="form-control mb-4" id="date-time" placeholder="" name="newDeadline">
                    </div>
                    <!-- エラー -->
                    @if ($errors->has('newDeadline'))
                    <p class="alert alert-danger">{{ $errors->first('newDeadline') }}</p>
                    @endif


                    <div class="text-center">
                        <input type="submit" class="btn btn-primary mt-5" value="新規追加">
                    </div>

                </div>
            </form>
        </div>

        <div class="text-center">
            <a href="{{ url('/home') }}" class="btn btn-primary mt-2">ホーム画面へ</a>
        </div>

    </div>

    <script>
        $(function() {
            $('#date-time').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm',
                nowButton: true,
                clearButton: true,
                lang: 'ja',
                cancelText: '×',
                okText: '決定',
                clearText: 'クリアー',
                nowText: '現在'
            });
        });
    </script>


</body>

</html>
