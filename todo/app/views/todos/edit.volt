<!-- 2020/07/08  Add Todos volt  by todo -->

{{ content() }}
<div class="page-header">
    <h2>Todo</h2>
</div>
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
                    {{ form('todos/register/' ~ id, 'id': 'registerForm', 'onbeforesubmit': 'return false','enctype': 'multipart/form-data') }}
                    <fieldset> 
                        ID: {{ id }}              
                        <div class="form-group">
                            {{ form.label('title', ['class': 'control-label']) }}
                            <div class="controls">
                                {{ form.render('title', ['class': 'form-control']) }}
                                <div class="alert alert-warning" id="password_alert">
                                    <strong>Warning!</strong> Please provide a valid password
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ form.label('detail', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ form.render('detail', ['class': 'form-control']) }}
                                 <div class="alert alert-warning" id="title_alert">
                                    入力してください。
                                 </div>
                                </div>
                        </div>

                        <div class="form-group">
                            {{ form.label('img', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ form.render('img') }}
                                 <div class="alert alert-warning" id="title_alert">
                                    入力してください。
                                 </div>
                                </div>
                        </div>

                        <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>
                        <div class="form-group">
                            {{ submit_button('更新', 'class': 'btn btn-primary', 'onclick': 'return TodoTitle.validate();') }}
                        </div>
                    </fieldset>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
