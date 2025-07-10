<?php
    /*
    
    REQUIRED:
    $content

    */

    $admin_dashboard = 'https://animalvoice.jp/admin';
?>
<html>
    <body style="font-family: sans-serif; font-size: 16px; color: #000;">
        <?= $content ?>
        <br>
        <em>
            このメッセージはすべての管理者に自動的に送信されました。
            <br><br>
            <strong>管理ページへ移動:</strong>
            <br>
            <a href="<?= $admin_dashboard ?>"><?= $admin_dashboard ?></a>
        </em>
    </body>
</html>