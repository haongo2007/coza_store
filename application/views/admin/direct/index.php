
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var pusher = new Pusher('101d71ba1f48fc65f0f8', {
          cluster: 'ap1',
          forceTLS: true
        });
        /* even get mess*/
        var channel = pusher.subscribe('ci_load');
        channel.bind('my-event', function(data) {
          $('.contacts-list').append('<li>'+
                '<a href="#">'+
                  '<img class="contacts-list-img" src="<?php echo public_url('admin/LTE/dist/img/user1-128x128.jpg') ?>" alt="User Image">'+
                      '<div class="contacts-list-info">'+
                          '<span class="contacts-list-name">'+
                            (data.ip)+
                            '<small class="contacts-list-date pull-right">2/28/2015</small>'+
                          '</span>'+
                              '<span class="contacts-list-msg">How have you been? I was...</span>'+
                            '</div>'+
                          '</a>'+
                        '</li>')
          });

        var channel = pusher.subscribe('chat_client');
        channel.bind('my-event', function(data) {
            $('.direct-chat-messages').append('<div class="direct-chat-msg">'+
              '<div class="direct-chat-info clearfix">'+
                '<span class="direct-chat-name pull-left">Alexander Pierce</span>'+
                '<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>'+
              '</div>'+
              '<img class="direct-chat-img" src="<?php echo public_url('admin/LTE/dist/img/user1-128x128.jpg') ?>" alt="Message User Image">'+
              '<div class="direct-chat-text">'
              +data.message+
              '</div>'+
              '</div>');
        });



        /* event send mess*/
        $("#myvoteform").submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            var vl = _this.find('input[name="message"]').val();
            var action = _this.attr('action');
            $.post(action, {data: 'admin',value : vl}, function(data, textStatus, xhr) {
                _this.find('input[name="message"]').val('');
                $('.direct-chat-messages').animate({scrollTop: $('.direct-chat-messages')[0].scrollHeight}, 500);
            });
        });
        var channel = pusher.subscribe('chat_admin');
        channel.bind('my-event', function(data) {
            $('.direct-chat-messages').append('<div class="direct-chat-msg right">'+
              '<div class="direct-chat-info clearfix">'+
                '<span class="direct-chat-name pull-left">Alexander Pierce</span>'+
                '<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>'+
              '</div>'+
              '<img class="direct-chat-img" src="<?php echo public_url('admin/LTE/dist/img/user1-128x128.jpg') ?>" alt="Message User Image">'+
              '<div class="direct-chat-text">'
              +data.message+
              '</div>'+
              '</div>');
            $('.direct-chat-messages').animate({scrollTop: $('.direct-chat-messages')[0].scrollHeight}, 500);
        });
    })
</script>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-xs-12">
              <div class="box-body">
                    <!-- DIRECT CHAT SUCCESS -->
                    <div class="box box-success direct-chat direct-chat-success">
                      <div class="box-header with-border">
                        <h3 class="box-title">Direct Chat</h3>

                        <div class="box-tools pull-right">
                          <span data-toggle="tooltip" title="" class="badge bg-green" data-original-title="3 New Messages">3</span>
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                            <i class="fa fa-comments"></i></button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages" style="height: 61vh">


                        </div>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts" style="width: 25%;height: 100%;right: 0">
                          <ul class="contacts-list">
                            
                            <!-- End Contact Item -->
                          </ul>
                          <!-- /.contatcts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <form action="<?php echo base_url('pusher') ?>" method="post" id="myvoteform">
                          <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                                  <button type="submit" class="btn btn-success btn-flat">Send</button>
                                </span>
                          </div>
                        </form>
                      </div>
                      <!-- /.box-footer-->
                    </div>
                    <!--/.direct-chat -->
              </div>
          </div>
      </div>
    </section>
</div>