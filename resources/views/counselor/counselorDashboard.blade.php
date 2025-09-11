@extends('layouts.counselor-master')

<style>
    .ibox-content {
        min-height: 100px;
        overflow: hidden;
        color: #fff;
    }

    .ibox.accepted .ibox-title,
    .ibox.accepted .ibox-content {
        background: #ffffff;
        color: #676a6c;
    }

    .ibox.pending .ibox-title,
    .ibox.pending .ibox-content {
        background: #ffffff;
        color: #676a6c;
    }

    .ibox.rejected .ibox-title,
    .ibox.rejected .ibox-content {
        background: #ffffff;
        color: #676a6c;
    }

    .ibox {
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        border-radius: 12px !important;
    }

    .ibox:hover {
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }
</style>

@section('body')

<section class="content-header">
    <div class="row">
        <div class="col-lg-9 ">
            <div class="ibox">
                <div class="ibox-content">
                    <div>
                        <span class="float-right text-right">
                            <small>
                                <strong>SafeSupport Appointment Overview</strong>
                            </small>
                            <br />
                            Total Appointments: {{ $acceptedCount + $pendingCount + $rejectedCount }}
                        </span>
                        <h3 class="font-bold no-margins">
                            Accepted Appointments
                        </h3>
                        <small>Accepted: {{ $acceptedCount }} | Pending: {{ $pendingCount }} | Rejected: {{ $rejectedCount }}</small>
                    </div>
                    <div id="legend" style="text-align:center; margin-left:13rem; margin-bottom:10px;"></div>
                    <div id="morris-area-chart" style="height: 250px;"></div>

                    <div class="m-t-md">
                        <small class="float-right">
                            <i class="fa fa-clock-o"> </i>
                            Last updated: {{ now()->format('d M Y, h:i A') }}
                        </small>
                        <small>
                            <strong>SafeSupport Analysis:</strong> Trends of appointment statuses (Accepted, Pending,
                            Rejected) over time.
                        </small>
                    </div>
                </div>
            </div>


            {{-- box --}}
            <div class="row mt-3">
                <div class="col-lg-4">
                    <div class="ibox accepted">
                        <div class="ibox-title">
                            <h5>Accepted Appointments</h5>
                        </div>
                        <div class="ibox-content d-flex align-items-center justify-content-between no-top-border">
                            <div class="ibox-data text-left">
                                <h1 class="no-margins">{{ $acceptedCount }}</h1>
                                <small>Appointments Accepted</small>
                            </div>
                            <div class="ibox-icon">
                                <i class="fa fa-check" style="font-size:40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="ibox pending">
                        <div class="ibox-title">
                            <h5>Pending Appointments</h5>
                        </div>
                        <div class="ibox-content d-flex align-items-center justify-content-between no-top-border">
                            <div class="ibox-data text-left">
                                <h1 class="no-margins">{{ $pendingCount }}</h1>
                                <small>Appointments Pending</small>
                            </div>
                            <div class="ibox-icon">
                                <i class="fa fa-clock-o" style="font-size:40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="ibox rejected">
                        <div class="ibox-title">
                            <h5>Rejected Appointments</h5>
                        </div>
                        <div class="ibox-content d-flex align-items-center justify-content-between no-top-border">
                            <div class="ibox-data text-left">
                                <h1 class="no-margins">{{ $rejectedCount }}</h1>
                                <small>Appointments Rejected</small>
                            </div>
                            <div class="ibox-icon">
                                <i class="fa fa-times" style="font-size:40px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Timeline</h5>
                    <span class="label label-primary">Meeting today</span>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content inspinia-timeline">
                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-3 date">
                                <i class="fa fa-briefcase"></i>
                                6:00 am
                                <br />
                                <small class="text-navy">2 hour ago</small>
                            </div>
                            <div class="col-7 content no-top-border">
                                <p class="m-b-xs"><strong>Meeting</strong></p>
                                <p>Conference on the sales results for the previous year. Monica please examine
                                    sales
                                    trends in marketing and products.</p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-3 date">
                                <i class="fa fa-file-text"></i>
                                7:00 am
                                <br />
                                <small class="text-navy">3 hour ago</small>
                            </div>
                            <div class="col-7 content">
                                <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-3 date">
                                <i class="fa fa-coffee"></i>
                                8:00 am
                            </div>
                            <div class="col-7 content">
                                <p class="m-b-xs"><strong>Coffee Break</strong></p>
                                <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the
                                    printing industry.</p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="row">
                            <div class="col-3 date">
                                <i class="fa fa-phone"></i>
                                11:00 am
                                <br />
                                <small class="text-navy">21 hour ago</small>
                            </div>
                            <div class="col-7 content">
                                <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                <p>Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
@endsection


@section('scripts')
<script>
    var config = {
        element: 'morris-area-chart',
        data: @json($appointments),
        xkey: 'week', 
        ykeys: ['accepted', 'pending', 'rejected'],
        labels: ['Accepted', 'Pending', 'Rejected'],
        lineColors: ['#1ab394', '#28a745', '#2ecc71'], 
        hideHover: 'auto',
        resize: true,
        xLabels: 'week',
        behaveLikeLine: true,
        fillOpacity: 0.2,
    };

    var chart = new Morris.Area(config);
    var active = config.ykeys.map(() => true);

    var legend = document.getElementById('legend');
    config.labels.forEach(function(label, i) {
        var span = document.createElement('span');
        span.innerHTML = '<span style="color:' + config.lineColors[i] + '">■</span> ' + label;
        span.style.marginRight = '15px';
        span.style.fontWeight = 'bold';
        span.style.cursor = 'pointer';
        span.style.color = '#676a6c'; 
        span.dataset.index = i;

        span.onclick = function() {
            var idx = this.dataset.index;
            active[idx] = !active[idx];

            config.ykeys = [];
            config.labels = [];
            config.lineColors = [];
            active.forEach(function(isActive, j) {
                if (isActive) {
                    config.ykeys.push(['accepted','pending','rejected'][j]);
                    config.labels.push(['Accepted','Pending','Rejected'][j]);
                    config.lineColors.push(['#1ab394','#28a745','#2ecc71'][j]);
                }
            });

            document.getElementById('morris-area-chart').innerHTML = '';
            chart = new Morris.Area(config);
            this.style.textDecoration = active[idx] ? 'none' : 'line-through';
        };

        legend.appendChild(span);
    });
</script>
@endsection