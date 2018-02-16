<div class="col-md-3" data-gid="{{$group->id}}" style="margin-bottom:3%;">

    <div class="prod-info">
        <p>{{ substr($group->group_name,0,30) }}</p>
        <p>Product contain: {{ count( json_decode($group->group_content) ) }} </p>
    </div>
</div>

