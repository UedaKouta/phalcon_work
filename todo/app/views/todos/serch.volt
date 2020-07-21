{{ content() }}
<div class="page-header">
    <h2>Todo</h2>
</div>
<ul class="pager">
    <li class="previous">
        {{ link_to("todos", "&larr; Go Back") }}
    </li>
</ul>
{% for todo in page.items %}
    {% if loop.first %}
<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>status</th>
            <th>title</th>
            <th>CreatedAt</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
{% endif %}
        <tr>
            <td>{{ todo.id }}</td>
            {% if todo.status == TODO_STATUS_ACTIVE %}
            <td>未完了</td>
            {% elseif todo.status == TODO_STATUS_DONE %}
            <td>完了</td>
            {% endif %}
            <td>{{ todo.title }}</td>
            <td>{{ todo.created }}</td>
            {% if todo.status == TODO_STATUS_ACTIVE %}
            <td>
                <!-- <a class="btn btn-success" href="/todo/todos/done/{{ todo.id }}">完了</a> -->
                <a class="btn btn-primary" href="/todo/todos/details/{{ todo.id }}">詳細</a>
            </td>
            {% else %}
            <td>
            </td>
            {% endif %}

        </tr>
    {% if loop.last %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("todos/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
                    {{ link_to("todos/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn") }}
                    {{ link_to("todos/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn") }}
                    {{ link_to("todos/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn") }}
                    <span class="help-inline">{{ page.current }} of {{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
    {% endif %}
{% else %}
    No products are recorded
{% endfor %}
