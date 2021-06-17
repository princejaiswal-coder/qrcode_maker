<?php

class QRcdr extends QRcode
{
    /**
     * Create SVG
     *
     * @param string $text         text
     * @param bool   $outfile      outfile
     * @param num    $level        level
     * @param num    $size         size
     * @param num    $margin       margin
     * @param bool   $saveandprint save and print
     * @param string $back_color   back_color
     * @param string $fore_color   fore_color
     * @param bool   $style        style
     *
     * @return SVG
     */
    public static function svg($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4, $saveandprint = false, $back_color = 0xFFFFFF, $fore_color = 0x000000, $style = false)
    {
        $enc = QRencdr::factory($level, $size, $margin, $back_color, $fore_color);
        return $enc->encodeSVG($text, $outfile, false, $style);
    }
}

class QRencdr extends QRencode
{

    public static function factory($level = QR_ECLEVEL_L, $size = 3, $margin = 4, $back_color = 0xFFFFFF, $fore_color = 0x000000, $cmyk = false)
    {
        $enc = new QRencdr();
        $enc->size = $size;
        $enc->margin = $margin;
        $enc->fore_color = $fore_color;
        $enc->back_color = $back_color;
        $enc->cmyk = $cmyk;

        switch ($level.'') {
        case '0':
        case '1':
        case '2':
        case '3':
                $enc->level = $level;
            break;
        case 'l':
        case 'L':
                $enc->level = QR_ECLEVEL_L;
            break;
        case 'm':
        case 'M':
                $enc->level = QR_ECLEVEL_M;
            break;
        case 'q':
        case 'Q':
                $enc->level = QR_ECLEVEL_Q;
            break;
        case 'h':
        case 'H':
                $enc->level = QR_ECLEVEL_H;
            break;
        }
        return $enc;
    }

    //----------------------------------------------------------------------
    public function encodeSVG($intext, $outfile = false, $saveandprint = false, $style = false)
    {
        try {
        
            ob_start();
            $tab = $this->encode($intext);
            $err = ob_get_contents();
            ob_end_clean();
            
            if ($err != '') {
                QRtools::log($outfile, $err);
            }
            
            $maxSize = (int)(QR_PNG_MAXIMUM_SIZE / (count($tab)+2*$this->margin));

            return QRvct::svg($tab, $outfile, min(max(1, $this->size), $maxSize), $this->margin, $saveandprint, $this->back_color, $this->fore_color, $style);
        
        } catch (Exception $e) {
        
            QRtools::log($outfile, $e->getMessage());
        
        }
    }

}


class QRvct extends QRvect
{
    //----------------------------------------------------------------------
    public static function svg($frame, $filename = false, $pixelPerPoint = 4, $outerFrame = 4, $saveandprint=FALSE, $back_color, $fore_color, $style = false)
    {
        $vect = self::vectSVG($frame, $pixelPerPoint, $outerFrame, $back_color, $fore_color, $style);
        return QRtools::save($vect, $filename);
        // if ($filename === false) {
        //     header("Content-Type: image/svg+xml");
        //     //header('Content-Disposition: attachment, filename="qrcode.svg"');
        //     echo $vect;
        // } else {
        //     if ($saveandprint===true) {
        //         QRtools::save($vect, $filename);
        //         header("Content-Type: image/svg+xml");
        //         //header('Content-Disposition: filename="'.$filename.'"');
        //         echo $vect;
        //     } else {
        //         return QRtools::save($vect, $filename);
        //     }
        // }
    }

    //----------------------------------------------------------------------
    private static function vectSVG($frame, $pixelPerPoint = 4, $outerFrame = 4, $back_color = 0xFFFFFF, $fore_color = 0xFFFFFF, $style = false)
    {
        $watermark = isset($style['optionlogo']) && $style['optionlogo'] !== 'none' ? $style['optionlogo'] : false;
        $markerOut = isset($style['marker_out']) ? $style['marker_out'] : false;
        $markerIn = isset($style['marker_in']) ? $style['marker_in'] : false;
        $markerOutColor = isset($style['marker_out_color']) ? $style['marker_out_color'] : false;
        $markerInColor = isset($style['marker_in_color']) ? $style['marker_in_color'] : false;
        $pattern = isset($style['pattern']) ? $style['pattern'] : false;

        $gradient = isset($style['gradient']) ? $style['gradient'] : false;
        $gradient_color = isset($style['gradient_color']) ? $style['gradient_color'] : false;
        $radial = isset($style['radial']) ? $style['radial'] : false;

        $markers_color = isset($style['markers_color']) ? $style['markers_color'] : false;

        $backgroundcolor = '#'.str_pad(dechex($back_color), 6, "0", STR_PAD_LEFT);
        $frontcolor = '#'.str_pad(dechex($fore_color), 6, "0", STR_PAD_LEFT);

        $h = count($frame);
        $w = strlen($frame[0]);

        $imgW = $w + $outerFrame*2;
        $imgH = $h + $outerFrame*2;

        $realimgSize = ($imgW * $pixelPerPoint);

        $marker_size = $pixelPerPoint*7;
        $marker_margin = $pixelPerPoint*2;
        $opposite_pos = ($realimgSize - $marker_size - $marker_margin);

        $marker_size_in = $pixelPerPoint*3;
        $marker_margin_in = $pixelPerPoint*4;
        $opposite_pos_in = ($realimgSize - $marker_size_in - $marker_margin_in);

        include dirname(__FILE__).'/markers.php';

        $markerOutPath = $markerOut && isset($markers[$markerOut]) ? $markers[$markerOut] : $markers['default'];
        $markerInPath = $markerIn && isset($markersIn[$markerIn]) ? $markersIn[$markerIn] : $markersIn['default'];
        $patternPath = $pattern && isset($markersIn[$pattern]) ? $markersIn[$pattern] : $markersIn['default'];

        $rotate_tr_out = $markerOutPath['rotate'] ? ' rotate(90 7 7)' : '';
        $rotate_bl_out = $markerOutPath['rotate'] ? ' rotate(-90 7 7)' : '';
        $rotate_tr_in = $markerInPath['rotate'] ? ' rotate(90 3 3)' : '';
        $rotate_bl_in = $markerInPath['rotate'] ? ' rotate(-90 3 3)' : '';

        $output = '<?xml version="1.0" encoding="utf-8"?>'."\n".
        '<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">'."\n".
        '<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" width="'.$realimgSize.'" height="'.$realimgSize.'" viewBox="0 0 '.$realimgSize.' '.$realimgSize.'">'."\n";
        // .'<desc>$h: '.$pixelPerPoint.' - $w: '.$w.'</desc>'."\n";

        $output .= '<defs>'."\n";

        $fill = 'fill="'.$frontcolor.'"';

        if ($gradient) {
            if ($radial) {
                $output .= '<radialGradient id="pattern-gradient" cx="50%" cy="50%" r="50%" fx="50%" fy="50%" gradientUnits="userSpaceOnUse">';
                $output .= '<stop offset="0%" stop-color="'.$frontcolor.'" />';
                $output .= '<stop offset="100%" stop-color="'.$gradient_color.'" /></radialGradient>'."\n";
            } else {
                $output .= '<linearGradient id="pattern-gradient" x1="0%" y1="0%" x2="12%" y2="100%" gradientUnits="userSpaceOnUse">';
                 $output .= '<stop offset="0%" stop-color="'.$frontcolor.'" />';
                 $output .= '<stop offset="100%" stop-color="'.$gradient_color.'" /></linearGradient>'."\n";
            }
            $fill = 'fill="url(#pattern-gradient)"';
        }

        $output .= '<mask id="qrmask">';
        $output .= '<g fill="#ffffff">'."\n";

        for ($i=0; $i<$h; $i++) {
            for ($j=0; $j<$w; $j++) {
                if ($frame[$i][$j] == '1') {
                    $y = ($i + $outerFrame) * $pixelPerPoint;
                    $x = ($j + $outerFrame) * $pixelPerPoint;
                    $output .= '<g transform="translate('.$x.','.$y.') scale('.($pixelPerPoint/6).')">' . $patternPath['path'].'</g>'."\n";
                }
            }
        }

        if (!$markers_color) {

            $output .= '<g transform="translate('.$marker_margin.','.$marker_margin.')"><g transform="scale('.($pixelPerPoint/2).')">'.$markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos.','.$marker_margin.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_out.'">'.$markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin.','.$opposite_pos.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_out.'">'.$markerOutPath['path'].'</g></g>'."\n";

            $output .= '<g transform="translate('.$marker_margin_in.','.$marker_margin_in.')"><g transform="scale('.($pixelPerPoint/2).')">'.$markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos_in.','.$marker_margin_in.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_in.'">'.$markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin_in.','.$opposite_pos_in.')"><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_in.'">'.$markerInPath['path'].'</g></g>'."\n";
        }
        $output .= '</g>';
        $output .= '</mask>';
        $output .= '</defs>'."\n";

        if (!empty($back_color) && $back_color !== 'transparent') {
            $output .= '<rect width="'.$realimgSize.'" height="'.$realimgSize.'" fill="'.$backgroundcolor.'" x="0" y="0" />'."\n";
        }

        $output .= '<rect x="0" y="0" width="'.$realimgSize.'" height="'.$realimgSize.'" mask="url(#qrmask)" '.$fill.' />'."\n";

        if ($markers_color) {

            $marker_in_fill = $markerInColor ? ' fill="'.$markerInColor.'"' : ' fill="'.$frontcolor.'"';
            $marker_out_fill = $markerOutColor ? ' fill="'.$markerOutColor.'"' : ' fill="'.$frontcolor.'"';

            $output .= '<g transform="translate('.$marker_margin.','.$marker_margin.')" '.$marker_out_fill.'><g transform="scale('.($pixelPerPoint/2).')">' . $markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos.','.$marker_margin.')" '.$marker_out_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_out.'">' . $markerOutPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin.','.$opposite_pos.')" '.$marker_out_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_out.'">' . $markerOutPath['path'].'</g></g>'."\n";

            $output .= '<g transform="translate('.$marker_margin_in.','.$marker_margin_in.')" '.$marker_in_fill.'><g transform="scale('.($pixelPerPoint/2).')">' . $markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$opposite_pos_in.','.$marker_margin_in.')" '.$marker_in_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_tr_in.'">' . $markerInPath['path'].'</g></g>'."\n";
            $output .= '<g transform="translate('.$marker_margin_in.','.$opposite_pos_in.')" '.$marker_in_fill.'><g transform="scale('.($pixelPerPoint/2).')'.$rotate_bl_in.'">' . $markerInPath['path'].'</g></g>'."\n";
        }

        if ($watermark) {

            $base64 = false;
            $basemark = 'data:image/';

            if (substr($watermark, 0, strlen($basemark)) === $basemark) {
                $base64 = $watermark;
            } else {
                $path = dirname(dirname(__FILE__)).'/'.$watermark;
                if (file_exists($path)) {
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }
            }

            if ($base64) {
                $watermark_size = $realimgSize/4;
                $watermark_pos = $realimgSize/2 - $watermark_size/2;

                $output .= '<image xlink:href="'.$base64.'" width="25%" height="25%" x="'.$watermark_pos.'" y="'.$watermark_pos.'" />'."\n";
            }
        }
        $output .= '</svg>';

        return $output;
    }
}
