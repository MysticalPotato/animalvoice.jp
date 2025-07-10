<?php
    /*
    
    REQUIRED:
    $subject, $content, $recipient

    OPTIONAL:
    $preheader

    */

    $homepage = 'https://animalvoice.jp';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">

    <title><?= $subject ?></title>

    <style>
        /* CLIENT-SAFE RESET */
        body, table, td, p {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        /* MOBILE STYLES */
        @media only screen and (max-width: 664px) {
            .container {
                width: 100% !important;
            }
            .content-cell {
                font-size: 12px !important;
                padding: 15px !important;
            }
            .footer-text {
                font-size: 10px !important;
            }
            .social-icon {
                width: 20px !important;
                height: 20px !important;
            }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#EAEAEA; font-family: sans-serif; color:#252a34;">

    <!-- Preheader text (invisible preview snippet) -->
    <?php if(isset($preheader)) : ?>
        <div style="display:none; font-size:1px; color:#ffffff; line-height:1px; max-height:0px; max-width:0px; opacity:0; overflow:hidden;">
            <?= $preheader ?>
        </div>
    <?php endif; ?>

    <center>
        <table width="100%" bgcolor="#EAEAEA" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td align="center">
                    <table class="container" width="664" cellpadding="0" cellspacing="0" border="0" style="width:664px; max-width:664px; background-color:#ffffff;">
                        <!-- Header -->
                        <tr>
                            <td bgcolor="#252a34" align="center" style="padding:20px;">
                                <a href="<?= $homepage ?>">
                                    <img src="<?= $homepage ?>/assets/images/email-logo-animalvoice.png" width="180" height="40" alt="Animal Voice Logo" style="display:block; border:0;">
                                </a>
                            </td>
                        </tr>

                        <!-- Content -->
                        <tr>
                            <td class="content-cell" style="padding:20px; font-size:14px; line-height:1.6;">
                                <?= $content ?>
                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td bgcolor="#252a34" align="center" style="padding:20px; color:#ffffff; font-size:12px;">
                                <!-- Social Icons -->
                                <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin-bottom:30px;">
                                    <tr>
                                        <td style="padding:0 5px;">
                                            <a href="https://www.instagram.com/animalvoice.jp/">
                                                <img class="social-icon" src="<?= $homepage ?>/assets/images/email-icon-instagram.png" width="24" height="24" alt="Instagram" style="display:block; border:0;">
                                            </a>
                                        </td>
                                        <td style="padding:0 5px;">
                                            <a href="<?= $homepage ?>">
                                                <img class="social-icon" src="<?= $homepage ?>/assets/images/email-icon-link.png" width="24" height="24" alt="Website" style="display:block; border:0;">
                                            </a>
                                        </td>
                                    </tr>
                                </table>

                                <!-- Footer Text -->
                                <p class="footer-text" style="margin:0; padding:0;">アニマル・ボイス &copy; <?php echo date('Y'); ?></p>
                                <p class="footer-text" style="margin:10px 0 0 0; padding:0;">このメールは、ニュースレターにご登録いただいた方にお送りしています。</p>
                                <p style="margin:10px 0 0 0;"><a href="<?= $homepage ?>/unsubscribe?email=<?= $recipient ?>" style="color:#ffffff; text-decoration:underline;">配信停止</a></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>

</body>
</html>
