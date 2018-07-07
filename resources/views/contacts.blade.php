@extends('layouts.app')

@section('content')
    <form method="post" class="form-group" style="margin-left: 20px">
        <div class="form-group">
            <input type="text" placeholder="Add text" name="text" id="text">
        </div>
        <div class="form-group">
            <input type="email" placeholder="Add email" name="email" id="email">
        </div>
        <div class="form-group">
            <textarea name="messadges" id="mess"></textarea>
        </div>

        <input type="submit" value="Send" id="send" class="btn btn-default">
    </form>
    <script>
        window.onload = function () {
            $('form').submit(function (e) {
                e.preventDefault();
                var mess = $('#mess').val();
                var text = $('#text').val();
                var email = $('#email').val();
                var url = "{{route('send_email')}}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {message:mess, text:text, email:email,"_token":"{{ csrf_token() }}"},
                    success: function(data){
                        $("form").append('<p>'+data.status+'</p>');
                        $("form").append('<p>'+data.email+'</p>');
                        $("form").append('<p>'+data.text+'</p>');
                        $("form").append('<p>'+data.mess+'</p>');
                        console.log(data);
                    }
                });
            })
        }
    </script>
@endsection