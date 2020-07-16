<!-- 2020/07/08  Add Todos volt  by todo -->
{{ content() }}

<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">タスク一覧</div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li role="presentation"{% if status == TODO_STATUS_ALL %} class="active"{% endif %}><a href="/todo/todos/index">all</a></li>
                        <li role="presentation"{% if status == TODO_STATUS_ACTIVE %} class="active"{% endif %}><a href="/todo/todos/index/1">未完了</a></li>
                        <li role="presentation"{% if status == TODO_STATUS_DONE %} class="active"{% endif %}><a href="/todo/todos/index/2">完了</a></li>
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
                                    {% if todo.status == TODO_STATUS_ACTIVE %}
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
                        <div class="form-group">
                            {{ form.label('title', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ form.render('title', ['class': 'form-control']) }}
                                 <div class="alert alert-warning" id="title_alert">
                                    入力してください。
                                 </div>
                                </div>
                        </div>
                        <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>
                        <div class="form-group">
                        {{ submit_button('登録', 'class': 'btn btn-primary', 'onclick': 'return TodoTitle.validate();') }}
                        </div>
                        </fieldset>
                    </form>                
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">検索</div>
                <div class="panel-body">
                    {{ form('todos/serch', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}
                        <fieldset>
                        <div class="form-group">
                            {{ serchform.label('id', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ serchform.render('id', ['class': 'form-control']) }}
                                </div>
                        </div>
                        <div class="form-group">
                            {{ serchform.label('title', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ serchform.render('title', ['class': 'form-control']) }}
                                </div>
                        </div>
                        <div class="form-group">
                            {{ serchform.label('status', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ serchform.render('status', ['class': 'form-control']) }}
                                </div>
                        </div>
                        <div class="form-group">
                        {{ submit_button('検索', 'class': 'btn btn-primary') }}
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


