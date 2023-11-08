@extends('dashboard.layouts.master')
@section('title','Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
       
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script>
    var notificationsWrapper = $('.notification-dropdown');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('span.notification-badge');
    var notificationsToggle2 = notificationsWrapper.find('div.notification-count');
    var notificationsCountElem = notificationsToggle2.find('span.notification-count');

    var notifications = notificationsWrapper.find('span.notification-badge');
    var notifications2 = notificationsWrapper.find('span.notification-count');

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e7c8d21e50a43b683974', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('pop-channel');
    channel.bind('user-notification', function(data) {
        /* var existingNotifications = notifications.html(); */
        var newNotificationHtml =  data.notification_count ;
       
      
      notifications.html(newNotificationHtml);

        var newNotificationHtml2 = `
        <span class="dropdown-item dropdown-header notification-count">
            ` + data.notification_count + ` Notifications
        </span>
        <div class="dropdown-divider"></div>
        <a href="http://127.0.0.1:8000/dashboard/users">
            <i class="fas fa-file mr-2"></i>New order is added
            <span class="float-right text-muted text-sm">about minute ago</span>
        </a>
       `;
        
        notifications2.html(newNotificationHtml2);

    });

</script>
<?php
    Session()->forget('admin');
    Session()->forget('code');
?>
@endsection

