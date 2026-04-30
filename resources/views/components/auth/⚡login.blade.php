<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    #[Validate]
    public string $phone = '';
    #[Validate]
    public string $password = '';

    protected function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'max:255', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function cancel(): void
    {
        $this->dispatch('close-login-form');
    }

    public function save(): void
    {
        $this->validate();

        if (
            !Auth::attempt([
                'phone' => $this->phone,
                'password' => $this->password,
            ], true)
        ) {
            $this->addError('auth', 'Неверный логин или пароль.');
            return;
        }

        $this->dispatch('close-login-form');
        $this->dispatch('update-auth-status');
        $this->reset();
    }
};
?>

<div>
    <x-forms.modal-form
        event="login"
        :icon="asset('icons/profile.svg')"
        title="Вход в аккаунт"
        end-button-text="Войти"
    >
        <x-inputs.input
            label="Номер телефона"
            type="tel"
            name="phone"
            id="login_phone"
            placeholder="+7 (000) 000-00-00"
        />

        <x-inputs.input
            label="Пароль"
            type="password"
            name="password"
            id="login_password"
            placeholder="Введите пароль"
        />

        @error('auth')
        <div class="text-secondary text-center">{{ $message }}</div>
        @enderror
    </x-forms.modal-form>
</div>
