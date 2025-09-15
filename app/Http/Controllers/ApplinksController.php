<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplinksController extends Controller
{
    public function assetLinks()
    {
        $array = [
            [
                'relation' => [
                    'delegate_permission/common.handle_all_urls',
                ],
                'target' => [
                    'namespace' => 'android_app',
                    'package_name' => config('nativephp.app_id'),
                    'sha256_cert_fingerprints' => [
                        config('services.certFingerprint'),
                    ],
                ],
            ],
        ];

        return response()->json($array, headers: ['Content-Type' => 'application/json']);
    }

    public function appSiteAssociation()
    {
        return response()->json([
            'applinks' => [
                'details' => [
                    [
                        'appIDs' => [config('services.apple.app_id')],
                        'paths' => ['*'],
                    ],
                ],
            ],
            'webcredentials' => [
                'apps' => [config('services.apple.webcredentials')],
            ],
        ]);
    }
}
