<?php

namespace App\Enums;

class RedirectUrlEnum
{
    const LINKS = [
        [
            'old' => '/?lang=en',
            'new' => '/?lang=en',
            'code' => 301,
        ],
        [
            'old' => 'installment',
            'new' => 'page/installment',
            'code' => 301,
        ],
        [
            'old' => 'before-and-after-cases',
            'new' => '/',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list',
            'new' => 'list/doctors',
            'code' => 301,
        ],
        [
            'old' => 'فوائد الحناء: عديدة ومتنوعة',
            'new' => 'تعرف-علي-فوائد-الحناء',
            'code' => 301,
        ],
        [
            'old' => 'علاج الصلع عند الرجال',
            'new' => 'الصلع-عند-الرجال',
            'code' => 301,
        ],
        [
            'old' => 'عيون الراكون: مشكلة صحية',
            'new' => 'عيون-الراكون',
            'code' => 301,
        ],
        [
            'old' => 'فوائد واضرار التقشير الكريستالي',
            'new' => 'اضرار-التقشير-الكريستالي',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list/doctor-profile/?id=21325&doctor=dr.-mai-attia',
            'new' => 'د-مي-عطية',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list/doctor-profile/?id=21276&doctor=dr.-doha-muslim',
            'new' => 'د-ضحى-مسلم',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list/doctor-profile/?id=21329&doctor=dr.-jaffrey-nahin',
            'new' => 'د-جافري-ناهين',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list/doctor-profile/?id=21283&doctor=dr.-rima-sawan',
            'new' => 'د-ريما-صوان',
            'code' => 301,
        ],
        [
            'old' => 'all-branches/?lang=en',
            'new' => 'list/branches?lang=en',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list/doctor-profile/?id=21285&doctor=dr.-ahmad-al-baha',
            'new' => 'د-أحمد-البهاء',
            'code' => 301,
        ],
        [
            'old' => 'all-branches',
            'new' => 'list/branches',
            'code' => 301,
        ],
        [
            'old' => 'كل ماتود معرفته عن أمراض اللثة',
            'new' => 'أمراض-اللثة',
            'code' => 301,
        ],
        [
            'old' => 'تنميل-اليدين/',
            'new' => 'أسباب-تنميل-اليدين',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list/doctor-profile/?id=21302&doctor=dr.-muhannad-salama',
            'new' => 'د-مهند-سلامة',
            'code' => 301,
        ],
        [
            'old' => 'doctors-list/doctor-profile/?id=21289&doctor=dr.-moataz-alaa-eddin',
            'new' => 'د-معتز-علاء-الدين',
            'code' => 301,
        ],
    ];
}
