<?php

namespace App\Http\Controllers\Oauth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Exception;

class GithubController
{
    public function callback()
    {
        $code = request()->input('code');
        $url = "https://github.com/login/oauth/access_token";
        $params = [
            'client_id' => getenv('GITHUB_CLIENT_ID'),
            'client_secret' => getenv('GITHUB_SECRETS'),
            'code' => $code,
            'redirect_uri' => getenv('GITHUB_REDIRECT_URI'),
        ];
        $url .= '?' . http_build_query($params);
        $response = Http::post($url);
        if (!$response->ok()) {
            throw new Exception('error');
        }
        parse_str($response->body(), $data);
        if (!$data['access_token']) {
            throw new Exception('error token');
        }

        $user = Http::withHeaders([
            'Authorization' => 'Bearer ' . $data['access_token'],
        ])->get('https://api.github.com/user');

        return $this->createUser($user->json());
    }

    private function createUser($userInfo)
    {
        if (!isset($userInfo['email'])) {
            return redirect()->route('login');
        }

        $user = User::where('email', $userInfo['email'])->first();
        if(empty($user)){
            $user = User::create([
                'name' => $userInfo['login'],
                'email' => $userInfo['email'],
                'role_name' => 'customer',
                'password' => Hash::make($userInfo['id']."_".$userInfo['node_id']),
            ]);
        }
        Auth::login($user);
        return redirect()->route('admin.panel');
    }
}
