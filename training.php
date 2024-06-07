<?php
    include_once 'navigation.php';
    include_once 'includes/dbh2.inc.php';


?>

        <div class="training" id="training">
            <div id="table-wrapper3">
            <h4 style="text-align:center;">訓練</h4>
                <div id="table-scroll3">
                    <table id="trainingTable" class="table trainingT table-hover table-bordered rounded-3 overflow-auto">
                        <thead class="theadstyle">
                            <tr id="firstrow">
                                <th style="width:10%">No</th>
                                <th style="width:25%">ファイル名</th>
                                <th style="width:25%">Description</th>
                                <th style="width:20%">Training Materials</th>
                                <th style="width:25%">Completion</th>
                            </tr>
                        </thead>
                        <tbody id="post_list">

                        </tbody>     
                    </table>

                    
                </div>
            </div>
        </div>
    </div> <!--mainwrapper-->
</div> <!--full-->

<script type="text/javascript">


$(document).ready(function() {

contents_data();


function contents_data() {
    //$('#post_list').html();
    var action = 'fetch_data';
    var shift = get_filter('shift');
    var process = get_filter('process');
    var building = get_filter('building');

    $.ajax({
        url: "includes/fetch_data_training.inc.php",
        method: "POST",
        data: {action:action,shift:shift,process:process,building:building},
        success:function(data){
          $('#post_list').html(data);
        }
    });
}

function get_filter(class_name)
{
  var filter = [];
  $('.'+class_name+':checked').each(function(){
      filter.push($(this).val());
  });

  return filter;
}

$('.common_selector').click(function(){
    filter_data();
});
});



</script>

</body>
</html>

