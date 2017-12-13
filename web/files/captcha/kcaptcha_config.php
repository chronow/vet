<?php
# KCAPTCHA configuration file

$alphabet = "0123456789abcdefghijklmnopqrstuvwxyz"; # do not change without changing font files!

# symbols used to draw CAPTCHA
$allowed_symbols = "0123456789"; #alphabet without similar symbols (o=0, 1=l, i=j, t=f)

# folder with fonts
$fontsdir = 'fonts';	

# CAPTCHA string length
$length = 4;

# CAPTCHA image size (you do not need to change it, whis parameters is optimal)
$width = 110;
$height = 70;

# symbol's vertical fluctuation amplitude divided by 2
$fluctuation_amplitude = 10;

# increase safety by prevention of spaces between symbols
$no_spaces = true;

# show credits
$show_credits = false; # set to false to remove credits line. Credits adds 12 pixels to image height

# CAPTCHA image colors (RGB, 0-255)
$foreground_color = array(0, 0, 0);
$background_color = array(255, 255, 255);

$foreground_color = array(mt_rand(0,100), mt_rand(0,100), mt_rand(0,100));
$background_color = array(255,255, 255);


# JPEG quality of CAPTCHA image (bigger is better quality, but larger file size)
$jpeg_quality = 100;
?>