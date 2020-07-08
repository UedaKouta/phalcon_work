<!-- 2020/07/08  Add Todos volt  by todo -->

{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("todos/index", "&larr; Go Back") }}
    </li>
</ul>

<h1 class="page-header">タスク</h1>
<div class="row">
    <div class="col-sm-8">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">更新</div>
                <div class="panel-body">
                    {{ form('todos/register/' ~ id, 'id': 'registerForm', 'onbeforesubmit': 'return false') }}
                    <fieldset>               
                        <div class="control-group">
                            {{ form.label('title', ['class': 'control-label']) }}
                            <div class="controls">
                                {{ form.render('title', ['class': 'form-control']) }}
                                <div class="alert alert-warning" id="password_alert">
                                    <strong>Warning!</strong> Please provide a valid password
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            {{ submit_button('更新', 'class': 'btn btn-primary', 'onclick': 'return TodoTitle.validate();') }}
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#testModal"style="float: right;">削除</button>
                        </div>
                    </fieldset>
                    </form>               
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