<?php

namespace App\Helpers;

class JobHelpers
{
    // Get Gender
    public static function rank($rank)
    {
        if ($rank >= 1 && $rank <= 300) {
            return "<img src='" . asset('assets/imgjob/copo.png') . "' alt='Male' title='Male' />";
        } else if ($rank >= 1 && $rank <= 150) {
            return "<img src='" . asset('assets/imgjob/best.gif') . "' alt='Female' title='Female' />";
        } else if ($rank >= 1 && $rank <= 19) {
            return "<img src='" . asset('assets/imgjob/copo.png') . "' alt='Female' title='Female' />";
        }
    }
    public static function getjobAsset($job)
    {
        switch ($job) {
            case '0':
                return asset('assets/imgjob/vagrant.png');
            case '11':
            case '21':
            case '31':
                return asset('assets/imgjob/sword.png');
            case '12':
            case '22':
            case '32':
                return asset('assets/imgjob/spear.png');
            case '13':
            case '23':
            case '33':
                return asset('assets/imgjob/axe.png');
            case '14':
            case '24':
            case '34':
                return asset('assets/imgjob/gun.png');
            case '15':
            case '25':
            case '35':
                return asset('assets/imgjob/bow.png');
            case '16':
            case '26':
            case '36':
                return asset('assets/imgjob/cannon.png');
            case '17':
            case '27':
            case '37':
                return asset('assets/imgjob/staff.png');
            case '18':
            case '28':
            case '38':
                return asset('assets/imgjob/instru.png');
            case '19':
            case '29':
            case '39':
                return asset('assets/imgjob/saw.png');
            case '2301':
            case '2311':
                return asset('assets/imgjob/sword.png');
            case '2302':
            case '2312':
                return asset('assets/imgjob/spear.png');
            case '2303':
            case '2313':
                return asset('assets/imgjob/axe.png');
            case '2304':
            case '2314':
                return asset('assets/imgjob/gun.png');
            case '2305':
            case '2315':
                return asset('assets/imgjob/bow.png');
            case '2306':
            case '2316':
                return asset('assets/imgjob/cannon.png');
            case '2307':
            case '2317':
                return asset('assets/imgjob/staff.png');
            case '2308':
            case '2318':
                return asset('assets/imgjob/instru.png');
            case '2309':
            case '2319':
                return asset('assets/imgjob/saw.png');
            case '2320':
                return asset('assets/imgjob/dual_sword.png');
            default:
                return '';
        }
    }
}
