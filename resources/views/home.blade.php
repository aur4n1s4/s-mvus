@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('backend/css/jquery-confirm.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/jquery-fancybox.min.css') }}">
@endsection

@section('content')
<div class="page has-sidebar-left height-full">
    <div class="blue accent-2 p-5">
        <canvas id="myChart" height="300" data-0="{{ $antrian0 }}" data-1="{{ $antrian1 }}" data-2="{{ $antrian2 }}" data-3="{{ $antrian3 }}"></canvas>
    </div>

    <div class="container-fluid animatedParent animateOnce no-p">
        <div class="animated fadeInUpShort">
            <div class="card no-b shadow">
                <div class="card-body p-0">
                    <div class="lightSlider" data-item="{{ count($antrianPolis) }}" data-item-xl="3" data-item-md="2" data-item-sm="1" data-pause="7000" data-pager="false" data-auto="false" data-loop="true">
                        @foreach ($antrianPolis as $key => $poli)
                        <div class="p-5 lighten-3 {{ $key % 2 ? 'light' : '' }}">
                            <h5 class="font-weight-normal s-14"> {{ strtoupper($poli->nama) }}</h5>
                            <span class="s-48 font-weight-normal text-{{ $poli->color }}">
                                {{ sprintf('%03s', $poli->current_antrian) . '/' . sprintf('%03s', $poli->total_antrian) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{ asset('backend/js/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-fancybox.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var ctx = document.getElementById('myChart');
        var antrian0 = Object.values($('#myChart').data('0'));
        var antrian1 = Object.values($('#myChart').data('1'));
        var antrian2 = Object.values($('#myChart').data('2'));
        var antrian3 = Object.values($('#myChart').data('3'));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                        label: 'Menunggu',
                        data: antrian0,
                        fill: false,
                        backgroundColor: '#fff',
                        borderColor: 'rgba(255,255,255,0.5)',
                        pointBorderColor: '#fff',
                        pointBackgroundColor: '#4285f4',
                        pointBorderWidth: '0',
                        pointStyle: 'circle',
                        borderWidth: 2,
                        borderJoinStyle: 'miter',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        lineTension: 0,
                    },
                    {
                        label: 'Dalam proses',
                        data: antrian1,
                        fill: false,
                        borderDash: [5, 5],
                        backgroundColor: '#fff',
                        borderColor: 'rgba(0,0,0,0.1)',
                        pointBorderColor: '#fff',
                        pointBackgroundColor: '#4285f4',
                        pointBorderWidth: '0',
                        pointStyle: 'circle',
                        borderWidth: 2,
                        borderJoinStyle: 'miter',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        lineTension: 0,
                    },
                    {
                        label: 'Selesai',
                        data: antrian2,
                        fill: false,
                        borderDash: [5, 5],
                        backgroundColor: '#fff',
                        borderColor: 'rgba(0,0,0,0.1)',
                        pointBorderColor: '#fff',
                        pointBackgroundColor: '#4285f4',
                        pointBorderWidth: '0',
                        pointStyle: 'circle',
                        borderWidth: 2,
                        borderJoinStyle: 'miter',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        lineTension: 0,
                    },
                    {
                        label: 'Ditolak',
                        data: antrian3,
                        fill: false,
                        borderDash: [5, 5],
                        backgroundColor: '#',
                        borderColor: 'rgba(0,0,0,0.1)',
                        pointBorderColor: '#fff',
                        pointBackgroundColor: '#4285f4',
                        pointBorderWidth: '0',
                        pointStyle: 'circle',
                        borderWidth: 2,
                        borderJoinStyle: 'miter',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        lineTension: 0,
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    labels: {
                        fontColor: 'white',
                    }
                },
                scales: {
                    xAxes: [{
                        display: true,
                        ticks: {
                            fontColor: 'rgba(255,255,255,0.5)',
                        },
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        display: true,
                        ticks: {
                            fontColor: 'rgba(255,255,255,0.5)',
                            stepSize: 20,
                        },
                        gridLines: {
                            zeroLineColor: 'rgba(255,255,255,0.1)',
                            color: 'rgba(255,255,255,0.1)',

                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.4,
                        borderWidth: 1
                    },
                    point: {
                        radius: 2,
                        hitRadius: 10,
                        hoverRadius: 6,
                        borderWidth: 4,
                    }
                }
            }
        });
    });
</script>
@endsection