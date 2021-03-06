{{ content() }}

<h1 class="page-header">タスク</h1>
<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">タスク一覧</div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li role="presentation"{% if status == 0 %} class="active"{% endif %}><a href="/todo/todos/index">all</a></li>
                        <li role="presentation"{% if status == 1 %} class="active"{% endif %}><a href="/todo/todos/index/1">未完了</a></li>
                        <li role="presentation"{% if status == 2 %} class="active"{% endif %}><a href="/todo/todos/index/2">完了</a></li>
                    </ul>
                    {% if page.items %}                                      
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>CreatedAt</th>
                            </tr>
                        </thead>
                        <tbody>
                        {% for todo in page.items %}
                            <tr>
                                <td>{{ todo.id }}</td>
                                <td>{{ todo.title }}</td>
                                <td>{{ todo.created }}</td>
                                <td>
                                    {% if todo.status == 1 %}
                                    <a class="btn btn-success" href="/todo/todos/done/{{ todo.id }}">完了</a>
                                    <a class="btn btn-primary" href="/todo/todos/edit/{{ todo.id }}">編集</a>
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
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">新規作成</div>
                <div class="panel-body">
                    {{ form('todos/insert', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}
                        <fieldset>
                        <div class="control-group">
                            {{ form.label('title', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ form.render('title', ['class': 'form-control']) }}
                                 <div class="alert alert-warning" id="title_alert">
                                    入力してください。
                                 </div>
                                </div>
                        </div>
                        <div class="form-actions">
                        {{ submit_button('登録', 'class': 'btn btn-primary', 'onclick': 'return TodoTitle.validate();') }}
                        </div>
                        </fieldset>
                    </form>                
                </div>
            </div>
        </div>
    </div>
</div>


