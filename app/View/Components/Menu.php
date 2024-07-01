<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;

class Menu
{
    static public function list(array $list = []): array
    {
        $menu = (object)[
            'default' => [
                'home' => 'Home',
                'feed' => 'Feed',
            ],
            'guest' => [],
            'user' => [
                'feed.posts' => 'Personal',
//                'feed.user-posts' => 'Personal',
            ],
        ];
        return array_merge($menu->default, Auth::guest() ? $menu->guest : $menu->user, $list);
    }

    static public function profileName(): string
    {
        return Auth::guest() ? 'Sign In / Sign Up' : Auth::user()->name;
    }

    static public function profileList(array $list = []): array
    {
        $auth = !Auth::guest();
        $menu = (object)[
            'guest' => [
                'login' => 'Sign In',
                'register' => 'Sign Up',
            ],
            'user' => [
                'profile.edit' => 'Profile',
//                'profile.posts' => 'Own posts',
            ],
        ];
        if ($auth && Auth::user()->is_admin) {
            $menu->user = array_merge($menu->user, [
                'profile.manage-users' => 'Manage users',
            ]);
        }
        return array_merge(Auth::guest() ? $menu->guest : $menu->user, $list);
    }
}
