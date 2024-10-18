<?php

namespace App\Helpers\ImageHelper;

use Illuminate\Http\UploadedFile;
use LogicException;

class ImageHelper
{
    /**
     * Create a dummy image with text, size, and position specified.
     *
     * @param  int  $width  The width of the image
     * @param  int  $height  The height of the image
     * @param  string  $hPos  The horizontal position of the text (left, center, right)
     * @param  string  $vPos  The vertical position of the text (top, center, bottom)
     * @param  string|null  $color  The background color of the image (hex color code) or null for grey color or 'random' for random color
     * @param  string  $textSize  The size of the text (small, medium, large)
     */
    public function createDummyImageWithTextSizeAndPosition(
        int $width,
        int $height,
        string $hPos,
        string $vPos,
        ?string $color,
        string $textSize
    ): UploadedFile {
        $img = imagecreatetruecolor($width, $height);

        if ($color) {
            if ($color == 'random') {
                $r = mt_rand(0, 255);
                $g = mt_rand(0, 255);
                $b = mt_rand(0, 255);

                imagefill($img, 0, 0, imagecolorallocate($img, $r, $g, $b));
            } else {
                $color = str_replace('#', '', $color);
                $r = substr($color, 0, 2);
                $g = substr($color, 2, 2);
                $b = substr($color, 4, 2);
                imagefill($img, 0, 0, imagecolorallocate($img, $r, $g, $b));
            }
        } else {
            $greyColor = imagecolorallocate($img, 192, 192, 192);
            imagefill($img, 0, 0, $greyColor);
        }

        $xSize = max($width, $height);

        switch ($textSize) {
            case 'small':
                $fontSize = round($xSize / 30);
                break;
            case 'medium':
                $fontSize = round($xSize / 20);
                break;
            case 'large':
                $fontSize = round($xSize / 10);
                break;
            default:
                throw new LogicException('Invalid text size');
                break;
        }

        $text = $width.' x '.$height;
        $font = __DIR__.'/fonts/arial/ARIAL.TTF';
        $textBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBox[2] - $textBox[0];
        $textHeight = $textBox[1] - $textBox[7];

        $x = 0;
        $y = 0;

        switch ($hPos) {
            case 'left':
                $x = round($width * 0.025);
                break;
            case 'center':
                $x = round($width / 2) - round($textWidth / 2);
                break;
            case 'right':
                $x = round($width * 0.975) - round($textWidth);
                break;
            default:
                throw new LogicException('Invalid horizontal text position');
                break;
        }

        switch ($vPos) {
            case 'top':
                $y = round($height * 0.1) + round($textHeight / 2);
                break;
            case 'center':
                $y = round($height / 2) + round($textHeight / 2);
                break;
            case 'bottom':
                $y = round($height * 0.9) + round($textHeight / 2);
                break;
            default:
                throw new LogicException('Invalid vertical text position');
                break;
        }

        $textColor = imagecolorallocate($img, 255, 255, 255);

        imagettftext($img, $fontSize, 0, $x, $y, $textColor, $font, $text);

        $tempFilePath = tempnam(sys_get_temp_dir(), 'modified_image_');
        imagejpeg($img, $tempFilePath, 100);

        $uploadedFile = new UploadedFile($tempFilePath, 'modified_image.jpg', 'image/jpeg', null, true);

        imagedestroy($img);

        return $uploadedFile;
    }
}
