<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>二维码</title>

    <link rel="stylesheet" type="text/css" href="/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/index/init.css" />
    <link rel="stylesheet" type="text/css" href="/css/index/common.css" />
    <script type="text/javascript" src="/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function commit() {
            var url = $("textarea[name='url']").val().trim();
            if (url.length == 0) {
                alert("原文不能为空");
                $("textarea[name='url']").focus();
                return;
            }
            $.ajax({
                type: "POST",
                url: "<?php echo \liansu\core\Helper::url('qrcode', 'mk_qrcode'); ?>",
                async: false,
                data: {
                    "url": url
                },
                success: function(res) {
                    let img = res.data.img;
                    $(".result").html(img);
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

            <div>
                <div>
                    <h2>二维码</h2>
                    <div class="form-group">
                        <label for="">原文</label>
                        <textarea class="form-control" name="url" style="height: 10rem;"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" onclick="commit()">生成二维码</button>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="">结果</label>
                        <div class="result" style="text-align:center;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>