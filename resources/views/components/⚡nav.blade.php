<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public bool $isAuth = false;

    public function mount(): void
    {
        $this->isAuth = Auth::check();
    }

    #[On('update-auth-status')]
    public function updateAuthStatus(): void
    {
        $this->isAuth = Auth::check();
    }

    #[On('logout')]
    public function logout(): void
    {
        Auth::logout();
        $this->dispatch('update-auth-status');
    }
};
?>

<div>
    <nav class="flex gap-2">
        @if($this->isAuth)
            <x-buttons.nav :link="route('users.profile')">Профиль</x-buttons.nav>
            <x-buttons.nav event="logout">Выход</x-buttons.nav>
        @else
            <x-buttons.nav event="open-register-form">Регистрация</x-buttons.nav>
            <x-buttons.nav event="open-login-form">Вход</x-buttons.nav>
        @endif
    </nav>
</div>
