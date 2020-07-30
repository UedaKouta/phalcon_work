<!-- 2020/07/08  Add Todos volt  by todo -->
{{ content() }}
<div class="page-header">
    <h2>Todo</h2>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">新規作成</div>
                <div class="panel-body">

                    {{ form('todos/insert', 'id': 'registerForm', 'onbeforesubmit': 'return false','enctype': 'multipart/form-data') }}
                        <fieldset>
                        <div class="form-group">
                            {{ form.label('title', ['class': 'control-label']) }}
                                <div class="controls">
                                 {{ form.render('title', ['class': 'form-control']) }}
                                 <div class="alert alert-warning" id="title_alert">
                                    titleを入力してください。
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

                        <!-- <input type="file" name="image"> -->
                        <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"value="<?php echo $this->security->getToken() ?>"/>
                        <div class="form-group">
                        {{ submit_button('登録', 'class': 'btn btn-primary', 'onclick': 'return TodoTitle.validate();') }}
                        </div>
                        </fieldset>
                    </form>                
                </div>
            </div>
        </div>
    </div>
</div>


