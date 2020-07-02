{{ content() }}

<h1 class="page-header">タスク</h1>
<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">タスク一覧</div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    　　　　　　　　　       <li role="presentation"{% if status == 0 %} class="active"{% endif %}><a href="/todo/index/index">all</a></li>
                                          <li role="presentation"{% if status == 1 %} class="active"{% endif %}><a href="/todo/index/index?status=1">未完了</a></li>
                                          <li role="presentation"{% if status == 2 %} class="active"{% endif %}><a href="/todo/index/index?status=2">完了</a></li>
                                      </ul>

                                        <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>CreatedAt</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
          
                                                    </tbody>
                    </table>

                                        </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">新規作成</div>
                <div class="panel-body">
                    <form method="get" action="/ConfirmationTodo" enctype="multipart/form-data" name="intodo1"><div class="form-group"><input id="title1" type="text" name="todo[title]" class="form-control" value="" size="20">
</div>
<input type="submit" name="submit" value="確認" class="btn btn-primary" onclick="return checkForm();">
</form>
                </div>
            </div>
        </div>
    </div>



        </div>



<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js" integrity="sha256-tcqPYPyxU+Fsv5sVdvnxLYJ7Jq9wWpi4twZbtZ0ubY8=" crossorigin="anonymous"></script>



