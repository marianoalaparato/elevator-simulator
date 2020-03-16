$(document).ready(function(){

    $("#change_f_e").click(function(){
        var num_floors = $('#floors_num').val();
        var num_elevators = $('#elevators_num').val();
        
        var change_f_e = {floors: num_floors, elevators: num_elevators};
        
        $.ajax({
            type:'POST',
            url: 'controller/index_controller.php',
            data: {change_f_e: JSON.stringify(change_f_e)},
            success:function(data){
                console.log(data);
                $('#view').remove();
                $(data).insertBefore("#prompt");
            },
            error:function(data){
                $('#prompt_txt').text('Error');
            }
        });
        
    });
    
    $("#generate_report").click(function(){
        var report_data = {report_name: 'report_0001', work_time: '11', num_elevators: '3'}
        $.ajax({
            type:'POST',
            url: 'controller/index_controller.php',
            data: {generate_report: JSON.stringify(report_data)},
            success:function(data){
                var text_in_prompt = $('#prompt').text();
                $('#prompt_txt').text(text_in_prompt + data);
            },
            error:function(data){
                $('#prompt_txt').text('Error');
            }
        });

    });
    
});



