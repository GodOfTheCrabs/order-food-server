<?php

namespace App\View\Components;

use Auth;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoleButton extends Component
{
    public $roles;
    public $buttonText;
    public $buttonClass;
    public $route;
    public $icon;
    public $method;
    public function __construct($roles, $route, $buttonText = null, $buttonClass = "btn btn-primary", $icon = null, $method = null)
    {
        $this->roles = $roles; 
        $this->route = $route; 
        $this->buttonText = $buttonText; 
        $this->buttonClass = $buttonClass; 
        $this->icon = $icon;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (Auth::check() && $this->userHasRole($this->roles)) {
            return view('components.role-button');
        }

        return '';
    }

    public function userHasRole($roles)
    {
        $user = Auth::user();
        return $user && $user->roles->pluck('name')->intersect($roles)->isNotEmpty();
    }
}
