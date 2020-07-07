{{ content() }}

<h1 class="page-header">タスク</h1>
<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">タスク一覧</div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    　　　　　　　　　       <li role="presentation"{% if status == 0 %} class="active"{% endif %}><a href="/todo/about/index">all</a></li>
                                          <li role="presentation"{% if status == 1 %} class="active"{% endif %}><a href="/todo/about/index/1">未完了</a></li>
                                          <li role="presentation"{% if status == 2 %} class="active"{% endif %}><a href="/todo/about/index/2">完了</a></li>
                                      </ul>
                                      {% if page.items %}
                                      
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
          


                            {% for todo in page.items %}
                            
                                <tr>
                                    <td>{{ todo.id }}</td>
                                    <td>{{ todo.title }}</td>
                                    <!-- {# <td>{{ todo.created|date("Y/m/d H:i:s") }}</td> #} -->
                                    <td>{{ todo.created }}</td>
                                    <td>
                                        {% if todo.status == 1 %}
                                            <a class="btn btn-success" href="/todo/todos/done/{{ todo.id }}">完了</a>
                                            <!-- {# <a class="btn btn-danger" href="/delete?id={{ todo.id }}">削除</a> #} -->
                                              <!-- {# <a class="btn btn-danger" onClick="kakunin({{ todo.id }})">削除</a>                                             #} -->
                                            <a class="btn btn-primary" href="/todo/about/edit/{{ todo.id }}">編集</a>
                                            <!-- {# <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#testModal">削除</button>
                                            
                                            <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4>削除確認画面</h4></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label> ID:{{ todo.id }}のデータを削除しますか？</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                                                            <a class="btn btn-danger" href="/delete?id={{ todo.id }}">はい</a> 
                                                        </div>

                                                    </div>
                                                </div>
                                           </div> #} -->

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

                    <!-- {{ form('about/insert', 'id': 'registerForm', 'onbeforesubmit': 'return false') }} -->
                    {{ form('todos', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}
                    <fieldset>
                

                        <div class="control-group">
                            {{ form.label('title', ['class': 'control-label']) }}
                            <div class="controls">
                                {{ form.render('title', ['class': 'form-control']) }}
                                <!-- <p class="help-block">(minimum 8 characters)</p> -->
                                <div class="alert alert-warning" id="password_alert">
                                    <strong>Warning!</strong> Please provide a valid password
                                </div>
                            </div>
                        </div>
                        
                   
                        <div class="form-actions">
                            {{ submit_button('登録', 'class': 'btn btn-primary', 'onclick': 'return SignUp.validate();') }}
                            <!-- <p class="help-block">By signing up, you accept terms of use and privacy policy.</p> -->
                        </div>
                
                    </fieldset>
                </form>
                


                </div>
            </div>
        </div>
    </div>



        </div>


