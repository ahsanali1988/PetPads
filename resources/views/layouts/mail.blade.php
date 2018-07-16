<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> <!-- utf-8 works for most cases -->
        <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
        <title>Email</title> <!-- The title tag shows in email notifications, like Android 4.4. -->
        <style type="text/css">

            /* What it does: Remove spaces around the email design added by some email clients. */
            /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
            html,
            body {
                margin: 0;
                padding: 0;
                height: 100% !important;
                width: 100% !important;
            }

            /* What it does: Stops email clients resizing small text. */
            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            /* What it does: Forces Outlook.com to display emails full width. */
            .ExternalClass {
                width: 100%;
            }  

            /* What it does: Stops Outlook from adding extra spacing to tables. */
            table,
            td {
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
            }

            /* What it does: Fixes webkit padding issue. */
            table {
                border-spacing:0 !important;
            }

            /* What it does: Fixes Outlook.com line height. */
            .ExternalClass,
            .ExternalClass * {
                line-height: 100%;
            }

            /* What it does: Fix for Yahoo mail table alignment bug. */
            table {
                border-collapse: collapse;
                margin: 0 auto;
            }

            /* What it does: Uses a better rendering method when resizing images in IE. */
            img {
                -ms-interpolation-mode:bicubic;
            }

            /* What it does: Overrides styles added when Yahoo's auto-senses a link. */
            .yshortcuts a {
                border-bottom: none !important;
            }

            /* What it does: Overrides blue, underlined link auto-detected by iOS Mail. */
            /* Create a class for every link style needed; this template needs only one for the link in the footer. */
            .mobile-link--footer a {
                color: #666666 !important;
            }

            /* What it does: Overrides styles added images. */
            img {
                border:0 !important;
                outline:none !important;
                text-decoration:none !important;
            }

            .menuzord-brand.red {
                color: #e8282a;
            }

            .menuzord-brand {
                margin: 20px 0 0px;
                font-family: 'cooper_blackregular';
                font-size: 46px;
                color: #fff;
            }


            .menuzord-brand {
                margin: 18px 30px 0 0;
                float: left;
                color: #666;
                text-decoration: none;
                font-size: 24px;
                font-weight: 600;
                line-height: 1.3;
                cursor: pointer;
            }
a{color:#fff; text-decoration: none;}
            /* Media Queries */
            @media screen and (max-device-width: 600px), screen and (max-width: 600px) {

                /* What it does: Overrides email-container's desktop width and forces it into a 100% fluid width. */
                .email-container {
                    width: 100% !important;
                }

                /* What it does: Forces images to resize to the width of their container. */
                img[class="fluid"],
                img[class="fluid-centered"] {
                    width: 100% !important;
                    max-width: 100% !important;
                    height: auto !important;
                    margin: auto !important;
                }
                /* And center justify these ones. */
                img[class="fluid-centered"] {
                    margin: auto !important;
                }

                /* What it does: Forces table cells into full-width rows. */
                td[class="stack-column"],
                td[class="stack-column-center"] {
                    display: block !important;
                    width: 100% !important;
                    direction: ltr !important;
                }
                /* And center justify these ones. */
                td[class="stack-column-center"] {
                    text-align: center !important;
                }

                /* Data Table Styles */
                /* What it does: Hides table headers */
                td[class="data-table-th"] {
                    display: none !important;
                }
                /* What it does: Change the look and layout of the remaining td's */
                td[class="data-table-td"],
                td[class="data-table-td-title"] {
                    display: block !important;
                    width: 100% !important;
                    border: 0 !important;
                }
                /* What it does: Changes the appearance of the first td in each row */
                td[class="data-table-td-title"] {
                    font-weight: bold;
                    color: #333333;
                    padding: 10px 0 0 0 !important;
                    border-top: 2px solid #eeeeee !important;
                }
                /* What it does: Changes the appearance of the other td's in each row */
                td[class="data-table-td"] {
                    padding: 5px 0 0 0 !important
                }
                /* What it does: Provides a visual divider between table rows. In this case, a bit of extra space. */
                td[class="data-table-mobile-divider"] {
                    display: block !important;
                    height: 20px;
                }
                /* END Data Table Styles */

            }

        </style>
    </head>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#fff" style="margin:0; padding:0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none;">
        <table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" bgcolor="#fff" style="border-collapse:collapse;">
            <tr>
                <td>

                    <!-- Email wrapper : BEGIN -->
                    <table border="0" width="596" cellpadding="0" cellspacing="0" align="center" style="width:596px; margin: auto;border:2px solid #48cd4e" class="email-container">
                        <tr>
                            <td>

                                <!-- Logo + Links : BEGIN -->
                                <table border="0" width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td valign="middle" width="100%" style="padding:10px 0; text-align:center; line-height: 1; background-color: #69d9c3;" class="stack-column-center">
                                            <a  style="float:none;" class="menuzord-brand" href="{{ route('homepage') }}">
                                                <img src="{{ asset('images/email_logo.png') }}" alt="PetsWorld" border="0">
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                                <!-- Logo + Links : END -->

                                @yield('content')

                            </td>
                        </tr>

                        <!-- Footer : BEGIN -->
                        <tr>
                            <td style="text-align:center; padding:4% 0; font-family:sans-serif; font-size:13px; line-height:1.2; color:#fff; background:#48cd4e;">
                                <p>&copy; {{ date('Y') }} <a style="color: #fff;" href="{{ route('homepage') }}">{{ config('app.name') }} </a>. All rights reserved.</p> <p style="text-align: center;">&bull; <span class="mobile-link--footer"><a style="color: #fff !important; cursor: pointer !important;">{{ config('app.address') }}</a></span> &bull; <span class="mobile-link--footer"><a style="color: #fff !important; cursor: pointer !important;">{{ config('app.phone_no') }}</a></span></p>
                            </td>
                        </tr>
                        <!-- Footer : END -->

                    </table>
                    <!-- Email wrapper : END -->

                </td>
            </tr>
        </table>
    </body>
</html>

