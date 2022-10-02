<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>加密</title>

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
    </style>
    <script type="text/javascript">
        function commit() {
            var string = $("input[name='string']").val().trim();
            var type = $("select[name='type']").val();
            $.ajax({
                type: "POST",
                url: "<?php echo \liansu\core\Helper::url('encrypt', 'encrypt'); ?>",
                async: false,
                data: {
                    "string": string,
                    "type": type
                },
                success: function(res) {
                    let result = res.data.result;
                    $(".result label").html(result);
                },
                error: function(e) {
                    alert("网络错误");
                }
            });
        }
    </script>
</head>

<body>
    <div class="_content">
        <div class="content">

            <div class="form-inline">
                <div>
                    <h2>加密</h2>
                    <div class="form-group">
                        <label for="">原文</label>
                        <input type="text" class="form-control" name="string" value="">
                    </div>
                    <div class="form-group">
                        <label for="">加密方式</label>
                        <select class="form-control" name="type" id="">
                            <option value="md5" selected>md5</option>
                            <option value="sha1">sha1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" onclick="commit()">加密</button>
                    </div>
                    <div class="form-group result">
                        <label for="">------</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>