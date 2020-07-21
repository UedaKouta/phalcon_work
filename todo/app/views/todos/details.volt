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
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">タスク一覧</div>
                <div class="panel-body">

                    
                    {% if page.items %}                                      
             
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                           
                                <th>Title</th>
                                <th>detail</th>
                                <th>CreatedAt</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for todo in page.items %}
                            <tr>
                                <td>{{ todo.id }}</td>
                                <td>{{ todo.title }}</td>
                                <td>{{ todo.detail }}</td>
                                <td>{{ todo.created }}</td>
                  
                                <td>
                                    {% if todo.status == TODO_STATUS_ACTIVE %}
                                    <a class="btn btn-success" href="/todo/todos/done/{{ todo.id }}">完了</a>
                                    <a class="btn btn-primary" href="/todo/todos/edit/{{ todo.id }}">編集</a>
                                    <!-- <a class="btn btn-primary" href="/todo/todos/details/{{ todo.id }}">詳細</a> -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#testModal"style="float: right;">削除</button>
                                    {% endif %}
                                </td>
                            </tr>
                        {% endfor %}
                        </tbody>
                    </table>
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