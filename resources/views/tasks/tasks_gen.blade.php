@extends('main')

@section('title','Quick Task Gen')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class='card mt-4'>
                <div class='card-body'>
                    {{ Form::open(array('url' => 'tasks.gen.store')) }}
                        <div class="task__list">
                            <label for="task--1" class="task"><input class="task__check" type="checkbox" id="task--1" /> <div class="task__field task--row"> Task number one<button class="task__important"><i class="fa fa-check" aria-hidden="true"></i></button></div></label>
                            <label for="task--2" class="task"><input class="task__check" type="checkbox" id="task--2" /> <div class="task__field task--row"> Second Task<button class="task__important"><i class="fa fa-check" aria-hidden="true"></i></button></div></label>
                            <label for="task--3" class="task"><input class="task__check" type="checkbox" id="task--3" /> <div class="task__field task--row"> Third task<button class="task__important"><i class="fa fa-check" aria-hidden="true"></i></button></div></label>
                            <label for="task--4" class="task"><input class="task__check" type="checkbox" id="task--4" /> <div class="task__field task--row"> Task number four<button class="task__important"><i class="fa fa-check" aria-hidden="true"></i></button></div></label>
                        </div>
                        <div class="task--row task__footer">

                            <input class="input_noout task__add" type="text" value="It doesn't work yet)">
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
$('.task__add').on('focus',function(){
  $(this).val('');
});

$('.task__add').on('blur',function(){
  $(this).val('+ add new task');
});

$('form').on('submit', function(event){
  event.preventDefault();
  
  var taskText = $('.task__add').val();
  var tasksN = $('.task').length + 1;
  
  var newTask = '<label for="task--' + tasksN + '" class="task task--new"><input class="task__check" type="checkbox" id="task--' + tasksN + '" /> <div class="task__field task--row">' + taskText + '<button class="task__important"><i class="fa fa-check" aria-hidden="true"></i></button></div></label>'

  
  $('.task__list').append(newTask);

  $('.task__add').val('');
  checkList();
});

var lastDeletedTask = '';


function checkList() {
  
  
  $('.task').each(function(){

    var $field = $(this).find('.task__field');
    var mousedown = false;


    $field.on('mousedown', function(){
        mousedown = true;
        $field.addClass('shaking');
        setTimeout(deleteTask,1000)
    });

    $field.on('mouseup', function(){
        mousedown = false;
        $field.removeClass('shaking');
    });

    function deleteTask(){
      if(mousedown) {
        $field.addClass('delete');
        lastDeletedTask = $field.text();
        console.log(lastDeletedTask);
        
        setTimeout(function(){
           $field.remove();
        }, 200);
       } else {return;}
    }

  });
}

checkList();

</script>
@endsection
