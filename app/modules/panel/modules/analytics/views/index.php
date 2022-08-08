<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <!-- Title ROW -->
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <!-- Head -->
                    <div class="flex-btw flex-vc mob_fc">
                        <h1 class="page_title">Google Analytics</h1>

                        <a class="btn btn-primary" href="{URL:panel/analytics/config}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            Configure
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- View -->
        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="flex-btw flex-vc mob_fc">
                    <h4>View</h4>

                    <style>
                        #button-holder > button {
                            margin-bottom: 8px;
                        }
                    </style>

                    <div id="control-container">
                        <div id="button-holder">
                            <button class="btn btn-outline-info" id="sources_btn" onclick="sources_chart();">
                                <i class="fas fa-chart-pie"></i> Traffic Sources
                            </button>
                            <button class="btn btn-outline-info" id="country_btn" onclick="country_chart();">
                                <i class="fas fa-chart-pie"></i> Countries
                            </button>
                            <button class="btn btn-outline-info" id="devices_btn" onclick="devices_chart();">
                                <i class="fas fa-chart-pie"></i> Devices
                            </button>
                            <button class="btn btn-outline-info" id="new_users_btn" onclick="new_users_chart();">
                                <i class="fas fa-chart-line"></i> New Users Per Day
                            </button>
                            <button class="btn btn-outline-info" id="pageviews_btn" onclick="pageviews_chart();">
                                <i class="fas fa-chart-line"></i> Page Views Per Day
                            </button>
                            <button class="btn btn-outline-info" id="users_btn" onclick="users_chart();">
                                <i class="fas fa-chart-line"></i> Users Per Day
                            </button>
                            <button class="btn btn-outline-info" id="sessions_btn" onclick="sessions_chart();">
                                <i class="fas fa-chart-line"></i> Sessions Per Day
                            </button>
                            <div class="clr"></div>
                        </div>

                        <div class="form-section">
                            <div class="full_column">
                                <div id="chart">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    <div id="canvas"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script src="<?= _SITEDIR_; ?>public/js/backend/apexcharts.min.js"></script>

<script>
    function sources_chart() {
        $('.view-btn').removeClass('active-btn');
        $('#sources_btn').addClass('active-btn');
        bar_chart('sources', 'Traffic Sources');
    }

    function country_chart() {
        $('.view-btn').removeClass('active-btn');
        $('#country_btn').addClass('active-btn');
        bar_chart('country', 'Countries');
    }

    function devices_chart() {
        $('.view-btn').removeClass('active-btn');
        $('#devices_btn').addClass('active-btn');
        bar_chart('devices', 'Devices');
    }

    function bar_chart(source, title) {
        $('#chart').html(
            '<i class="fas fa-spinner fa-spin"></i>' +
            '<div id="canvas"></div>'
        );

        $.get('{URL:panel/analytics/ajax/}' + source, {}, function (json) {
            $('#chart').find('i').hide();
            $('#chart').find('#canvas').show();

            if (!json.error) {
                var data = [];
                var labels = [];
                $(json).each(function (i, row) {
                    labels.push(row['base']);
                    data.push(row['ga:visits']);
                });

                var chart = new ApexCharts(
                    document.querySelector("#canvas"),
                    {
                        chart: {
                            height: 350,
                            type: 'bar',
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        series: [{
                            data: data
                        }],
                        xaxis: {
                            categories: labels,
                        }
                    }
                );

                chart.render();
            } else {
                $('#chart').text(json.error);
            }
        });
    }

    function sessions_chart() {
        $('.view-btn').removeClass('active-btn');
        $('#sessions_btn').addClass('active-btn');
        line_chart('sessions', 'Sessions');
    }

    function users_chart() {
        $('.view-btn').removeClass('active-btn');
        $('#users_btn').addClass('active-btn');
        line_chart('users', 'Users');
    }

    function new_users_chart() {
        $('.view-btn').removeClass('active-btn');
        $('#new_users_btn').addClass('active-btn');
        $('#chart').html(
            '<i class="fas fa-spinner fa-spin"></i>' +
            '<div id="canvas"></div>'
        );

        $.get('{URL:panel/analytics/ajax/new_users}', {}, function (json) {
            $('#chart').find('i').hide();
            $('#chart').find('#canvas').show();

            if (!json.error) {
                var datetime = [], data_new_users = [], data_returning_users = [], date_string = "";
                $(json).each(function (i, row) {
                    date_string = moment(row.date, "YYYYMMDD").toISOString();
                    if (row['user_type'] === "New Visitor") {
                        data_new_users.push(row['new_users']);
                        if (datetime.indexOf(date_string) === -1)
                            datetime.push(date_string);
                    } else if (row['user_type'] === "Returning Visitor") {
                        data_returning_users.push(row['users']);
                        if (datetime.indexOf(date_string) === -1)
                            datetime.push(date_string);
                    }
                });

                var chart = new ApexCharts(
                    document.querySelector("#canvas"),
                    {
                        chart: {
                            height: 350,
                            type: 'area',
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        series: [{
                            name: 'New Visitor',
                            data: data_new_users
                        }, {
                            name: 'Returning Visitor',
                            data: data_returning_users
                        }],

                        xaxis: {
                            type: 'datetime',
                            categories: datetime,
                        },
                        tooltip: {
                            x: {
                                format: 'dd/MM/yy'
                            },
                        }
                    }
                );

                chart.render();
            } else {
                $('#chart').text(json.error);
            }
        });
    }

    function pageviews_chart() {
        $('.view-btn').removeClass('active-btn');
        $('#pageviews_btn').addClass('active-btn');
        line_chart('pageviews', 'Page Views');
    }

    function line_chart(source, title) {
        $('#chart').html(
            '<i class="fas fa-spinner fa-spin"></i>' +
            '<div id="canvas"></div>'
        );

        $.get('{URL:panel/analytics/ajax/}' + source, {}, function (json) {
            $('#chart').find('i').hide();
            $('#chart').find('#canvas').show();

            if (!json.error) {
                var dates = [];
                var data = [];
                $(json).each(function (i, row) {
                    dates.push(moment(row.date, "YYYYMMDD").toISOString());
                    data.push(row[source]);
                });

                var chart = new ApexCharts(
                    document.querySelector("#canvas"),
                    {
                        chart: {
                            height: 350,
                            type: 'area',
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        series: [{
                            name: title,
                            data: data
                        }],

                        xaxis: {
                            type: 'datetime',
                            categories: dates,
                        },
                        tooltip: {
                            x: {
                                format: 'dd/MM/yy'
                            },
                        }
                    }
                );

                chart.render();
            } else {
                $('#chart').text(json.error);
            }
        });
    }

    $(function () {
        sessions_chart();
    });
</script>