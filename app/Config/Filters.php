<?php

namespace Config;

use App\Filters\Cors;
use App\Filters\FilterJwt;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'login'         => \Myth\Auth\Filters\LoginFilter::class,
        'role'          => \Myth\Auth\Filters\RoleFilter::class,
        'permission'    => \Myth\Auth\Filters\PermissionFilter::class,
        'loginrestapi'  => FilterJwt::class,
        // 'cors'          => Cors::class
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'cors'
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'login' => [
            'before' => [
                '/',
                'data-admin/*',
                'data-divisi/*',
                'data-pegawai/*',
                'tambah-admin/',
                'tambah-divisi/',
                'tambah-pegawai/',
                'edit-admin/*',
                'edit-divisi/*',
                'edit-pegawai/*',
                'update-pegawai/*',
                'update-divisi/*',
                'update-admin/*',
                'hapus-admin/*',
                'hapus-divisi/*',
                'hapus-pegawai/*',
                'profile/',
                'profile/*',
                'ubah-password/',
                'password-changed/*',
            ]
        ],
        'loginrestapi' => [
            'before' => [
                'restapipegawai/',
                'restapipegawai/*',
                'restapiuserpegawai/',
                'restapiuserpegawai/*',
            ]
        ]
    ];
}
