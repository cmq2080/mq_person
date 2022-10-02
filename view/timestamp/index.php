<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>时间</title>

    <link rel="stylesheet" type="text/css" href="/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/index/init.css" />
    <link rel="stylesheet" type="text/css" href="/css/index/common.css" />
    <script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        .form-group.result {
            margin-left: 2rem;
        }

        .form-group.result label {
            color: #ff0000;
        }

        #time2 .form-group input {
            width: 8rem;
        }
    </style>
    <script type="text/javascript">
        function timestampToTime() {
            var timestamp = $("#timestamp").val();
            var date = new Date(timestamp * 1000);
            var year = date.getFullYear(),
                month = date.getMonth() + 1,
                day = date.getDate(),
                hour = date.getHours(),
                minute = date.getMinutes(),
                second = date.getSeconds();
            var timeStr = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
            $("#time1 .result label").html(timeStr);
        }

        function timeToTimestamp() {
            var year = $("#year").val(),
                month = $("#month").val(),
                day = $("#day").val(),
                hour = $("#hour").val(),
                minute = $("#minute").val(),
                second = $("#second").val();
            var timeStr = year + "/" + month + "/" + day + " " + hour + ":" + minute + ":" + second; // 年月日之间应该用/隔开
            var date = new Date(timeStr);
            var timestamp = date.getTime() / 1000;
            $("#time2 .result label").html(timestamp);
        }

        $(function() {
            var timestamp = <?php echo $timestamp ?? 0; ?>;
            $("#timestamp").val(timestamp);
            var date = new Date(timestamp * 1000); // 这是毫秒级
            $("#year").val(date.getFullYear());
            $("#month").val(date.getMonth() + 1); //月份范围0-11
            $("#day").val(date.getDate());
            $("#hour").val(date.getHours());
            $("#minute").val(date.getMinutes());
            $("#second").val(date.getSeconds());

            $("#time1 input").on('blur', function() {
                timestampToTime();
            });
            $("#time2 input").on('blur', function() {
                timeToTimestamp();
            });
        });
    </script>
</head>

<body>
    <div class="_content">
        <div class="content">

            <div class="form-inline">
                <div id="time1">
                    <h2>时间戳转时间</h2>
                    <div class="form-group">
                        <label for="">时间戳</label>
                        <input type="text" class="form-control" id="timestamp" value="" maxlength="10">
                    </div>
                    <div class="form-group result">
                        <label for="">------</label>
                    </div>
                </div>
                <div id="time2">
                    <h2>时间转时间戳</h2>
                    <div class="form-group">
                        <label for="">时间</label>
                        <input type="text" class="form-control" id="year">
                    </div>
                    <div class="form-group">
                        <label for="">-</label>
                        <input type="text" class="form-control" id="month">
                    </div>
                    <div class="form-group">
                        <label for="">-</label>
                        <input type="text" class="form-control" id="day">
                    </div>
                    <div class="form-group">
                        <label for="">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="text" class="form-control" id="hour">
                    </div>
                    <div class="form-group">
                        <label for="">:</label>
                        <input type="text" class="form-control" id="minute">
                    </div>
                    <div class="form-group">
                        <label for="">:</label>
                        <input type="text" class="form-control" id="second">
                    </div>
                    <div class="form-group result">
                        <label for="">------</label>
                    </div>
                </div>
                <div id="time3">
                    <h2>日期-零时时间戳对照表</h2>
                    <div id="time-table" class="col-md-6 ">
                        <table class="table" class="">
                            <tr>
                                <th>日期</th>
                                <th>时间戳</th>
                            </tr>
                            <?php foreach ($times as $time) : ?>
                                <tr>
                                    <td><?php echo $time['date']; ?></td>
                                    <td><?php echo $time['timestamp']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>