<?php

namespace App\Services;

use App\SiteMeta;
use App\CustomField;

class SiteMetaView
{
    public static function title()
    {
        try {
            return SiteMeta::all()->first()['title'];
        } catch (\Exception $e) {
            return 'CyberHolic';
        }
    }

    public static function shortcut()
    {
        try {
            return SiteMeta::all()->first()['shortcut'];
        } catch (\Exception $e) {
            return '/favicon.ico';
        }
    }

    public static function keyword()
    {
        try {
            return SiteMeta::all()->first()['keyword'];
        } catch (\Exception $e) {
            return 'keyword';
        }
    }

    public static function description()
    {
        try {
            return SiteMeta::all()->first()['description'];
        } catch (\Exception $e) {
            return 'description';
        }
    }

    public static function album()
    {
        try {
            return json_decode(SiteMeta::all()->first()['index_album']);
        } catch (\Exception $e) {
            return array();
        }
    }

    public static function pageTopLink()
    {
        try {
            return SiteMeta::all()->first()['pageTopLink'];
        } catch (\Exception $e) {
            return json_decode(array());
        }
    }

    public static function pageTopButton()
    {
        try {
            return SiteMeta::all()->first()['pageTopButton'];
        } catch (\Exception $e) {
            return json_decode(array());
        }
    }

    public static function pageTopContent()
    {
        try {
            return SiteMeta::all()->first()['pageTopContent'];
        } catch (\Exception $e) {
            return json_decode(array());
        }
    }

    public static function ecNotice()
    {
        try {
            return CustomField::where('type', 'ECNOTICE')->first()['content'];
        } catch (\Exception $e) {
            return '';
        }
    }

    public static function ecPrivacy()
    {
        try {
            return CustomField::where('type', 'PRIVACY')->first()['content'];
        } catch (\Exception $e) {
            return '';
        }
    }

    public static function ecRemind()
    {
        try {
            return CustomField::where('type', 'REMIND')->first()['content'];
        } catch (\Exception $e) {
            return '';
        }
    }

    public static function noticeService()
    {
        try {
            $content = json_decode(CustomField::where('type', 'OTHER')->first()['content']);
            return $content->service;
        } catch (\Exception $e) {
            return '';
        }
    }

    public static function noticeShipping()
    {
        try {
            $content = json_decode(CustomField::where('type', 'OTHER')->first()['content']);
            return $content->shipping;
        } catch (\Exception $e) {
            return '';
        }
    }

    public static function noticeReturn()
    {
        try {
            $content = json_decode(CustomField::where('type', 'OTHER')->first()['content']);
            return $content->return;
        } catch (\Exception $e) {
            return '';
        }
    }

    public static function noticeAntiFraud()
    {
        try {
            $content = json_decode(CustomField::where('type', 'OTHER')->first()['content']);
            return $content->antiFraud;
        } catch (\Exception $e) {
            return '';
        }
    }
}
