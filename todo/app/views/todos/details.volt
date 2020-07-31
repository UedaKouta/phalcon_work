<!-- 2020/07/08  Add Todos volt  by todo -->
{{ content() }}
<div class="page-header">
    <h2>Todo</h2>
</div>
<ul class="pager">
    <li class="previous">
        {{ link_to("todos", "&larr; Go Back") }}
    </li>
</ul>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">タスク詳細</div>
                <div class="panel-body">
                    {% if page.items %}                                                                
                    {% for todo in page.items %}
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="subject-task">Id</h4>
                            <p>{{ todo.id }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="subject-task">title</h4>
                            <p>{{ todo.title }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="subject-task">detail</h4>
                            <p>{{ todo.detail }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="subject-task">created</h4>
                            <p>{{ todo.created }} </p>
                        </div>
                    </div>
                    {% if todo.imgname %}  
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="subject-task">image</h4>
                            {{ image("files/"~ todo.imgname,'width': '300') }}
                        </div>
                    </div>
                    {% endif %}

                    <a class="btn btn-success" href="/todo/todos/done/{{ todo.id }}">完了</a>
                    <a class="btn btn-primary" href="/todo/todos/edit/{{ todo.id }}">編集</a>
                    <!-- <a class="btn btn-primary" href="/todo/todos/details/{{ todo.id }}">詳細</a> -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#testModal">削除</button>
                    {% endfor %}
                    {% else %}
                    <div class="panel-body">
                        <p>タスクがありません</p>
                    </div>
                    {% endif %}
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>削除確認画面</h4></h4>
            </div>
            <div class="modal-body">
                <label> ID:{{ id }}のデータを削除しますか？</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                <a class="btn btn-danger" href="/todo/todos/delete/{{ id }}">はい</a> 
            </div>
        </div>
    </div>
</div>